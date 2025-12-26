<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gemini\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Auth;

class CheckupChatbotController extends Controller
{
    /**
     * Display the chatbot interface
     */
    public function index(Request $request)
    {
        $mode = Auth::user()->role;

        return view('chatbot.index', compact('mode'));
    }

    /**
     * Handle chatbot conversation with streaming
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'conversation_history' => 'nullable|array',
            'mode' => 'required|in:client,freelancer'
        ]);

        $userMessage = $request->input('message');
        $conversationHistory = $request->input('conversation_history', []);

        // Build the system prompt for the troubleshooting assistant
        $systemPrompt = $this->getSystemPrompt($request->mode);

        // Prepare the full conversation for Gemini
        $fullConversation = $systemPrompt . "\n\n";

        // Add conversation history
        foreach ($conversationHistory as $msg) {
            $role = $msg['role'] === 'user' ? 'User' : 'Assistant';
            $fullConversation .= "{$role}: {$msg['content']}\n\n";
        }

        // Add current user message
        $fullConversation .= "User: {$userMessage}\n\nAssistant:";

        try {
            $model = config('gemini.model', 'gemini-2.5-flash');

            // Call Gemini API with streaming
            $stream = Gemini::generativeModel(model: $model)
                ->streamGenerateContent($fullConversation);

            // Return streaming response
            return response()->stream(function () use ($stream, $conversationHistory, $userMessage) {
                $fullText = '';

                foreach ($stream as $response) {
                    $text = $response->text();
                    $fullText .= $text;

                    echo "data: " . json_encode([
                        'chunk' => $text,
                        'done' => false
                    ]) . "\n\n";

                    if (ob_get_level() > 0) {
                        ob_flush();
                    }
                    flush();
                }

                // Check if complete
                $isComplete = $this->checkIfComplete($fullText);

                // Send final message with metadata
                echo "data: " . json_encode([
                    'chunk' => '',
                    'done' => true,
                    'full_text' => trim($fullText),
                    'is_complete' => $isComplete,
                    'conversation_history' => array_merge(
                        $conversationHistory,
                        [
                            ['role' => 'user', 'content' => $userMessage],
                            ['role' => 'assistant', 'content' => trim($fullText)]
                        ]
                    )
                ]) . "\n\n";

                if (ob_get_level() > 0) {
                    ob_flush();
                }
                flush();
            }, 200, [
                'Cache-Control' => 'no-cache',
                'Content-Type' => 'text/event-stream',
                'X-Accel-Buffering' => 'no'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error processing your request. Please try again.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get the system prompt for the chatbot
     */
    private function getSystemPrompt(string $mode = 'client')
    {
        return $mode === 'freelancer'
            ? $this->freelancerPrompt()
            : $this->clientPrompt();
    }

    public function clientPrompt()
    {
        return "You are CompServe's Client Assistant name CompBot.

You are a helpful technical support assistant for CompServe, a freelancing platform for technicians.

Your job is to help clients troubleshoot their technical issues before they post a job listing.

Follow these guidelines:
1. Greet the user warmly and ask them to describe their technical problem
2. Ask clarifying questions one at a time to understand the issue better
3. Provide simple troubleshooting steps based on common issues
4. If the issue seems simple, guide them through basic fixes (restart device, check connections, update software, etc.)
5. After each suggestion, ask if it worked
6. If the problem is resolved, congratulate them and suggest they don't need to post a job
7. If the problem persists after 3-4 troubleshooting attempts, or if it's clearly complex, recommend they post a job listing for professional help
8. Keep responses concise (2-3 sentences max)
9. Be friendly, patient, and professional
10. When recommending they post a job, say exactly: 'RECOMMENDATION: Post a job listing for professional assistance.'

Focus on common computer/device issues like:
- Hardware problems (won't turn on, overheating, physical damage)
- Software issues (slow performance, crashes, errors)
- Connectivity problems (Wi-Fi, Bluetooth, network issues)
- Peripheral issues (printer, keyboard, mouse, monitor)
- Basic troubleshooting (restart, updates, cables)";
    }

    public function freelancerPrompt()
    {
        return "
You are CompServe's Freelancer Assistant name CompBot.

Your goal is to help freelancers find relevant gigs or contracts.

Your behavior:
1. Greet the freelancer professionally.
2. Ask about their primary skills (hardware, networking, software, mobile, etc).
3. Ask about experience level (beginner, intermediate, expert).
4. Ask preferred job type (gig or contract).
5. Ask availability (urgent, flexible).
6. Summarize their profile.
7. Recommend suitable gigs or contracts.
8. Encourage them to apply.

When ready to recommend gigs, say EXACTLY:
'RECOMMENDATION: Show matching gigs.'

Keep responses concise (2–3 sentences).
Be professional and opportunity-focused.";
    }

    /**
     * Check if the troubleshooting is complete
     */
    private function checkIfComplete(string $message): bool
    {
        $role = Auth::user()->role ?? 'client';

        $completionPhrasesByRole = [
            'client' => [
                'RECOMMENDATION: Post a job listing',
                'you should post a job listing',
                'recommend posting a job',
                'post a job listing',
                'post a job',
                'find a freelancer',
                'problem is resolved',
                'issue is fixed',
                'glad it\'s working',
            ],

            'freelancer' => [
                'RECOMMENDATION: Search for available gigs',
                'you can now search for gigs',
                'browse available contracts',
                'apply to this job',
                'start applying to gigs',
                'this contract matches your skills',
                'you are ready to accept work',
                'session complete',
            ],
        ];

        $phrases = $completionPhrasesByRole[$role]
            ?? $completionPhrasesByRole['client'];

        foreach ($phrases as $phrase) {
            if (stripos($message, $phrase) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Start a new conversation
     */
    public function startNew()
    {
        if (Auth::user()->role === "freelancer") {
            return response()->json([
                'success' => true,
                'message' => "Hi! 👋 I'm here to support you as a freelancer. Need help finding jobs, managing projects, or boosting your profile?"
            ]);
        } else if (Auth::user()->role === "client") {
            return response()->json([
                'success' => true,
                'message' => "Hi! I'm here to help troubleshoot your technical issue. Can you describe the problem you're experiencing?"
            ]);
        }
    }
}