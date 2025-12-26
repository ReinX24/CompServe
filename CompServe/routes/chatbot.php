<?php

use App\Http\Controllers\CheckupChatbotController;
use Gemini\Laravel\Facades\Gemini;
use OpenAI\Laravel\Facades\OpenAI;

// Chatbot routes - accessible to authenticated clients
// TODO: add ai functionality where it summarizes the profile of the client or freelancer
// TODO: test chatbot for client and freelancer
Route::middleware(['auth'])->group(function () {
    Route::get('/chatbot', [CheckupChatbotController::class, 'index'])->name('chatbot.index');
    Route::post('/chatbot/chat', [CheckupChatbotController::class, 'chat'])->name('chatbot.chat');
    Route::post('/chatbot/start-new', [CheckupChatbotController::class, 'startNew'])->name('chatbot.start-new');
});

Route::get('/test-openai', function () {
    try {
        OpenAI::responses()->create([
            'model' => 'gpt-4.1-mini',
            'input' => 'ping',
        ]);

        return 'Connected (unexpected success)';
    } catch (\OpenAI\Exceptions\ErrorException $e) {
        return response()->json([
            'status' => $e->getCode(),   // 429 or 403 is GOOD here
            'message' => $e->getMessage(),
        ]);
    }
});

Route::get('/test-gemini', function () {
    try {
        $model = config('gemini.model', 'gemini-2.5-flash');

        $result = Gemini::generativeModel(model: $model)
            ->generateContent('How many bones are in a human body?');

        return 'Connected! Response: ' . $result->text() . ' Model: ' . $model;
    } catch (\Exception $e) {
        return response()->json([
            'status' => 500,
            'message' => $e->getMessage(),
        ], 500);
    }
});

Route::get('/list-gemini-models', function () {
    try {
        $apiKey = config('gemini.api_key');

        $response = Http::get("https://generativelanguage.googleapis.com/v1beta/models?key={$apiKey}");

        if ($response->successful()) {
            $models = $response->json('models');

            // Filter only models that support generateContent
            $availableModels = collect($models)
                ->filter(function ($model) {
                    return in_array('generateContent', $model['supportedGenerationMethods'] ?? []);
                })
                ->map(function ($model) {
                    return [
                        'name' => str_replace('models/', '', $model['name']),
                        'display_name' => $model['displayName'] ?? 'N/A',
                        'description' => $model['description'] ?? 'N/A',
                    ];
                })
                ->values();

            return response()->json([
                'status' => 'success',
                'count' => $availableModels->count(),
                'models' => $availableModels
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to fetch models',
            'error' => $response->json()
        ], $response->status());

    } catch (\Exception $e) {
        return response()->json([
            'status' => 500,
            'message' => $e->getMessage(),
        ], 500);
    }
});