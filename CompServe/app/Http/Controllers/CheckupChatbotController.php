<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class CheckupChatbotController extends Controller
{
    // Constants for better maintainability
    private const MAX_MESSAGE_LENGTH = 1000;
    private const MAX_CONVERSATION_HISTORY = 50;
    private const GEMINI_TIMEOUT = 30;

    private const ROLE_CLIENT = 'client';
    private const ROLE_FREELANCER = 'freelancer';

    // Action types
    private const ACTION_POST_JOB = 'post_job';
    private const ACTION_SHOW_GIGS = 'show_gigs';
    private const ACTION_FIND_FREELANCER = 'find_freelancer';
    private const ACTION_NONE = 'none';

    /**
     * Display the chatbot interface
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Please log in to access the chatbot.');
        }

        $mode = $user->role;

        // Validate role
        if (!in_array($mode, [self::ROLE_CLIENT, self::ROLE_FREELANCER])) {
            abort(403, 'Invalid user role for chatbot access.');
        }

        return view('chatbot.index', compact('mode'));
    }

    /**
     * Handle chatbot conversation with streaming
     */
    public function chat(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'message' => ['required', 'string', 'max:' . self::MAX_MESSAGE_LENGTH],
                'conversation_history' => ['nullable', 'array', 'max:' . self::MAX_CONVERSATION_HISTORY],
                'conversation_history.*.role' => ['required', 'string', 'in:user,assistant'],
                'conversation_history.*.content' => ['required', 'string'],
                'mode' => ['required', 'in:' . self::ROLE_CLIENT . ',' . self::ROLE_FREELANCER]
            ]);

            $userMessage = trim($validated['message']);
            $conversationHistory = $validated['conversation_history'] ?? [];
            $mode = $validated['mode'];

            // Validate mode matches user role
            if ($mode !== Auth::user()->role) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mode mismatch with user role.'
                ], 403);
            }

            // Check if user wants to post a job directly (before AI processing)
            $directAction = $this->detectDirectAction($userMessage, $mode);

            if ($directAction !== self::ACTION_NONE) {
                return $this->handleDirectAction($directAction, $userMessage, $conversationHistory);
            }

            // Build conversation context
            $fullConversation = $this->buildConversationContext($mode, $conversationHistory, $userMessage);

            // Get Gemini model
            $model = config('gemini.model', 'gemini-2.0-flash');

            // Stream response
            return $this->streamGeminiResponse($model, $fullConversation, $conversationHistory, $userMessage, $mode);

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid request data.',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('Chatbot error: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'user_id' => Auth::id()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error processing your request. Please try again.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    /**
     * Detect if user message contains a direct action request
     */
    private function detectDirectAction(string $message, string $mode): string
    {
        $lowerMessage = strtolower($message);

        // Check for job posting intent (clients only)
        if ($mode === self::ROLE_CLIENT) {
            // ADD THIS NEW BLOCK FIRST (check hiring intent before job posting)
            $hireFreelancerPhrases = [
                'i want to hire a technician',
                'want to hire a technician',
                'i want to hire a freelancer',
                'want to hire a freelancer',
                'i need to hire',
                'need to hire',
                'find a technician',
                'find a freelancer',
                'find a nearby technician',
                'find a nearby freelancer'
            ];

            foreach ($hireFreelancerPhrases as $phrase) {
                if (stripos($lowerMessage, $phrase) !== false) {
                    return self::ACTION_FIND_FREELANCER;
                }
            }

            $postJobPhrases = [
                'post a gig',
                'post a contract',
                'post a job',
                'create a gig',
                'create a contract',
                'create a job',
                'want to post',
                'need to post',
                'i want to post a gig',
                'i want to post a contract',
                'hire a freelancer',
                'hire someone',
                'looking to hire',
            ];

            foreach ($postJobPhrases as $phrase) {
                if (stripos($lowerMessage, $phrase) !== false) {
                    return self::ACTION_POST_JOB;
                }
            }
        }

        // Check for gig browsing intent (freelancers only)
        if ($mode === self::ROLE_FREELANCER) {
            $browseGigPhrases = [
                'show me gigs',
                'find gigs',
                'browse jobs',
                'view opportunities',
                'available gigs',
                'looking for work'
            ];

            foreach ($browseGigPhrases as $phrase) {
                if (stripos($lowerMessage, $phrase) !== false) {
                    return self::ACTION_SHOW_GIGS;
                }
            }
        }

        return self::ACTION_NONE;
    }

    /**
     * Handle direct action requests without AI processing
     */
    private function handleDirectAction(string $action, string $userMessage, array $history)
    {
        $response = match ($action) {
            self::ACTION_POST_JOB => [
                'message' => "Great! Let me help you create a job posting. Click the button below to get started with posting your gig or contract.",
                'action' => [
                    'type' => 'redirect',
                    'label' => 'Create Gig / Contract Posting',
                    'url' => route('client.jobs.create') . '?type=gig',
                    'icon' => '💼'
                ]
            ],
            self::ACTION_FIND_FREELANCER => [
                'message' => "Perfect! Let me help you find qualified freelancers in your area. Click the button below to browse available technicians.",
                'action' => [
                    'type' => 'redirect',
                    'label' => 'Find a Freelancer Near Me',
                    'url' => route('client.find-freelancer'),
                    'icon' => '🔍'
                ]
            ],
            self::ACTION_SHOW_GIGS => [
                'message' => "Perfect! Let me show you available gigs that match your skills. Click the button below to browse opportunities.",
                'action' => [
                    'type' => 'redirect',
                    'label' => 'Browse Available Gigs',
                    'url' => route('freelancer.gigs.index'),
                    'icon' => '🔍'
                ]
            ],
            default => ['message' => 'How can I help you today?']
        };

        // Build updated conversation history
        $updatedHistory = array_merge(
            $history,
            [
                ['role' => 'user', 'content' => $userMessage],
                ['role' => 'assistant', 'content' => $response['message']]
            ]
        );

        // Limit history size
        if (count($updatedHistory) > self::MAX_CONVERSATION_HISTORY) {
            $updatedHistory = array_slice($updatedHistory, -self::MAX_CONVERSATION_HISTORY);
        }

        return response()->json([
            'success' => true,
            'message' => $response['message'],
            'action' => $response['action'] ?? null,
            'is_complete' => true,
            'conversation_history' => $updatedHistory,
            'metadata' => [
                'action_type' => $action,
                'timestamp' => now()->toIso8601String()
            ]
        ]);
    }

    /**
     * Build full conversation context for Gemini
     */
    private function buildConversationContext(string $mode, array $history, string $currentMessage): string
    {
        $systemPrompt = $this->getSystemPrompt($mode);
        $conversation = $systemPrompt . "\n\n";

        // Add conversation history
        foreach ($history as $msg) {
            $role = $msg['role'] === 'user' ? 'User' : 'Assistant';
            $content = $this->sanitizeMessage($msg['content']);
            $conversation .= "{$role}: {$content}\n\n";
        }

        // Add current message
        $sanitizedMessage = $this->sanitizeMessage($currentMessage);
        $conversation .= "User: {$sanitizedMessage}\n\nAssistant:";

        return $conversation;
    }

    /**
     * Stream Gemini API response
     */
    private function streamGeminiResponse(string $model, string $conversation, array $history, string $userMessage, string $mode)
    {
        $stream = Gemini::generativeModel(model: $model)
            ->streamGenerateContent($conversation);

        return response()->stream(function () use ($stream, $history, $userMessage, $mode) {
            $fullText = '';
            $chunkCount = 0;

            try {
                foreach ($stream as $response) {
                    $text = $response->text();
                    $fullText .= $text;
                    $chunkCount++;

                    // Send chunk to client
                    echo "data: " . json_encode([
                        'chunk' => $text,
                        'done' => false
                    ]) . "\n\n";

                    $this->flushOutput();
                }

                // Trim and validate response
                $fullText = trim($fullText);

                if (empty($fullText)) {
                    throw new \Exception('Empty response from AI model');
                }

                // Check if conversation is complete and detect action
                $isComplete = $this->checkIfComplete($fullText);
                $action = $this->detectActionInResponse($fullText, $mode);

                // Build updated conversation history
                $updatedHistory = array_merge(
                    $history,
                    [
                        ['role' => 'user', 'content' => $userMessage],
                        ['role' => 'assistant', 'content' => $fullText]
                    ]
                );

                // Limit history size
                if (count($updatedHistory) > self::MAX_CONVERSATION_HISTORY) {
                    $updatedHistory = array_slice($updatedHistory, -self::MAX_CONVERSATION_HISTORY);
                }

                // Send completion message
                echo "data: " . json_encode([
                    'chunk' => '',
                    'done' => true,
                    'full_text' => $fullText,
                    'is_complete' => $isComplete,
                    'action' => $action,
                    'conversation_history' => $updatedHistory,
                    'metadata' => [
                        'chunks_received' => $chunkCount,
                        'timestamp' => now()->toIso8601String()
                    ]
                ]) . "\n\n";

                $this->flushOutput();

            } catch (\Exception $e) {
                Log::error('Streaming error: ' . $e->getMessage());

                echo "data: " . json_encode([
                    'error' => true,
                    'message' => 'An error occurred while generating response.'
                ]) . "\n\n";

                $this->flushOutput();
            }
        }, 200, [
            'Cache-Control' => 'no-cache',
            'Content-Type' => 'text/event-stream',
            'X-Accel-Buffering' => 'no',
            'Connection' => 'keep-alive'
        ]);
    }

    /**
     * Detect if AI response contains an action recommendation
     */
    private function detectActionInResponse(string $message, string $mode): ?array
    {
        // Check for job posting recommendation (clients)
        if ($mode === self::ROLE_CLIENT) {
            $postJobPhrases = [
                'RECOMMENDATION: Post a gig or contract listing',
                'post a gig or contract listing for professional assistance',
                'you should post a gig or contract listing',
                'recommend posting a gig or contract',
                'hire a qualified technician',
                'time to hire a professional',
                'consider hiring a technician',
            ];

            foreach ($postJobPhrases as $phrase) {
                if (stripos($message, $phrase) !== false) {
                    return [
                        'type' => 'redirect',
                        'label' => 'Post a Gig or Contract Listing',
                        'url' => route('client.jobs.create'),
                        'icon' => '💼'
                    ];
                }
            }
        }

        // Check for gig browsing recommendation (freelancers)
        if ($mode === self::ROLE_FREELANCER) {
            $showGigsPhrases = [
                'RECOMMENDATION: Show matching gigs',
                'you can now search for gigs',
                'browse available contracts',
                'start applying to gigs',
                'ready to view opportunities',
                'here are your matches'
            ];

            foreach ($showGigsPhrases as $phrase) {
                if (stripos($message, $phrase) !== false) {
                    return [
                        'type' => 'redirect',
                        'label' => 'Browse Available Gigs',
                        'url' => route('freelancer.jobs.index'),
                        'icon' => '🔍'
                    ];
                }
            }
        }

        return null;
    }

    /**
     * Flush output buffers
     */
    private function flushOutput(): void
    {
        if (ob_get_level() > 0) {
            ob_flush();
        }
        flush();
    }

    /**
     * Sanitize message content
     */
    private function sanitizeMessage(string $message): string
    {
        return htmlspecialchars(trim($message), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Get the system prompt based on mode
     */
    private function getSystemPrompt(string $mode): string
    {
        return match ($mode) {
            self::ROLE_FREELANCER => $this->freelancerPrompt(),
            self::ROLE_CLIENT => $this->clientPrompt(),
            default => $this->clientPrompt()
        };
    }

    /**
     * Client troubleshooting prompt
     */
    private function clientPrompt(): string
    {
        return <<<PROMPT
You are CompBot, CompServe's Client Technical Support Assistant.
Your mission is to help clients troubleshoot technical issues before they hire a technician.

Your conversation flow:
1. Greet the client warmly and ask them to describe their technical problem
2. Ask ONE clarifying question at a time to understand the issue
3. Provide simple, step-by-step troubleshooting based on the problem
4. After each solution, ask: "Did that resolve the issue?"
5. If successful after any step, congratulate them and confirm they saved time and money
6. If problem persists after 3-4 attempts OR issue is clearly complex, recommend professional help
7. When recommending a job post, output EXACTLY: "RECOMMENDATION: Post a gig or contract listing for professional assistance."

Common issues you can help with:
- Hardware (won't power on, overheating, physical damage, component failures)
- Software (slow performance, crashes, error messages, freezing)
- Connectivity (Wi-Fi, Bluetooth, network, internet issues)
- Peripherals (printer, keyboard, mouse, monitor, external devices)
- Basic fixes (restarts, updates, cable checks, driver issues)

Communication style:
- Keep responses concise (2-3 sentences maximum)
- Be friendly, patient, and encouraging
- Use simple, non-technical language when possible
- Show empathy for their frustration
- Celebrate when problems are solved
- Be honest when professional help is needed

Remember: Your goal is to help, not to prevent job postings. If DIY fixes don't work, confidently recommend they hire a qualified technician.
PROMPT;
    }

    /**
     * Freelancer job matching prompt
     */
    private function freelancerPrompt(): string
    {
        return <<<PROMPT
You are CompBot, CompServe's Freelancer Assistant.
Your goal is to help freelancers discover relevant gigs and contracts that match their skills.

Your conversation flow:
1. Greet the freelancer warmly and professionally
2. Ask about their primary technical skills (hardware repair, networking, software development, mobile apps, etc.)
3. Inquire about their experience level (beginner, intermediate, or expert)
4. Ask their preferred job type (short-term gig or long-term contract)
5. Confirm their availability (urgent/immediate start or flexible timeline)
6. Summarize their profile to confirm understanding
7. Recommend 3-5 suitable opportunities based on their profile
8. Encourage them to apply with confidence

When ready to show recommendations, output EXACTLY:
"RECOMMENDATION: Show matching gigs."

Communication style:
- Keep responses concise (2-3 sentences maximum)
- Be professional, encouraging, and opportunity-focused
- Use clear, action-oriented language
- Show enthusiasm about helping them find great opportunities
PROMPT;
    }

    /**
     * Check if the conversation should be marked as complete
     */
    private function checkIfComplete(string $message): bool
    {
        $role = Auth::user()->role ?? self::ROLE_CLIENT;

        $completionPhrases = [
            self::ROLE_CLIENT => [
                'RECOMMENDATION: Post a job listing',
                'post a job listing for professional assistance',
                'you should post a job listing',
                'recommend posting a job',
                'hire a qualified technician',
                'problem is resolved',
                'issue is fixed',
                'glad it\'s working',
                'problem solved'
            ],
            self::ROLE_FREELANCER => [
                'RECOMMENDATION: Show matching gigs',
                'you can now search for gigs',
                'browse available contracts',
                'start applying to gigs',
                'ready to view opportunities',
                'here are your matches',
                'session complete'
            ]
        ];

        $phrases = $completionPhrases[$role] ?? $completionPhrases[self::ROLE_CLIENT];

        foreach ($phrases as $phrase) {
            if (stripos($message, $phrase) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get initial greeting message
     */
    public function getGreeting(): array
    {
        $role = Auth::user()->role;

        $greetings = [
            self::ROLE_CLIENT => [
                'message' => "Hi! 👋 I'm CompBot, your technical support assistant. I'm here to help troubleshoot your issue before you hire a technician. Can you describe the problem you're experiencing?",
                'suggestions' => [
                    'My computer won\'t turn on',
                    'Internet is not working',
                    'Printer won\'t print',
                    'Computer is running slow',
                    'I want to post a gig or contract'
                ]
            ],
            self::ROLE_FREELANCER => [
                'message' => "Hi! 👋 I'm CompBot, your freelancer assistant. I'm here to help you find the perfect gigs and contracts that match your skills. What kind of work are you looking for?",
                'suggestions' => [
                    'Hardware repair jobs',
                    'Software development contracts',
                    'Networking projects',
                    'Mobile app development',
                    'Show me available gigs'
                ]
            ]
        ];

        return $greetings[$role] ?? $greetings[self::ROLE_CLIENT];
    }

    /**
     * Start a new conversation
     */
    public function startNew()
    {
        $greeting = $this->getGreeting();

        return response()->json([
            'success' => true,
            'message' => $greeting['message'],
            'suggestions' => $greeting['suggestions'] ?? [],
            'conversation_history' => []
        ]);
    }
}