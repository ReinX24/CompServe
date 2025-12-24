<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class CheckupChatbotController extends Controller
{
    /**
     * Display the chatbot interface
     */
    public function index()
    {
        return view('chatbot.index');
    }

    /**
     * Handle chatbot conversation
     */
    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'conversation_history' => 'nullable|array'
        ]);

        $userMessage = $request->input('message');
        $conversationHistory = $request->input('conversation_history', []);

        // Build the system prompt for the troubleshooting assistant
        $systemPrompt = $this->getSystemPrompt();

        // Prepare messages for OpenAI
        $messages = [
            ['role' => 'system', 'content' => $systemPrompt]
        ];

        // Add conversation history
        foreach ($conversationHistory as $msg) {
            $messages[] = $msg;
        }

        // Add current user message
        $messages[] = ['role' => 'user', 'content' => $userMessage];

        try {
            // Call OpenAI API
            $result = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => $messages,
                'max_tokens' => 500,
                'temperature' => 0.7,
            ]);

            $assistantMessage = $result->choices[0]->message->content;

            // Check if troubleshooting is complete
            $isComplete = $this->checkIfComplete($assistantMessage);

            return response()->json([
                'success' => true,
                'message' => $assistantMessage,
                'is_complete' => $isComplete,
                'conversation_history' => array_merge(
                    $conversationHistory,
                    [
                        ['role' => 'user', 'content' => $userMessage],
                        ['role' => 'assistant', 'content' => $assistantMessage]
                    ]
                )
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
    private function getSystemPrompt()
    {
        return "You are a helpful technical support assistant for CompServe, a freelancing platform for technicians.

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

    /**
     * Check if the troubleshooting is complete
     */
    private function checkIfComplete($message)
    {
        $completionPhrases = [
            'RECOMMENDATION: Post a job listing',
            'you should post a job listing',
            'recommend posting a job',
            'problem is resolved',
            'issue is fixed',
            'glad it\'s working'
        ];

        foreach ($completionPhrases as $phrase) {
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
        return response()->json([
            'success' => true,
            'message' => "Hi! I'm here to help troubleshoot your technical issue. Can you describe the problem you're experiencing?"
        ]);
    }
}