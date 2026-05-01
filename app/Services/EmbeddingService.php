<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class EmbeddingService
{
    protected string $apiKey;
    protected string $model;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_KEY', '') ?: env('OPENAI_API_KEY', '');
        $this->model = env('OPENAI_EMBEDDING_MODEL', 'text-embedding-3-small');
    }

    /**
     * Create an embedding for given text using OpenAI embeddings API.
     * Returns embedding vector as array, or empty array on failure.
     */
    public function createEmbedding(string $text): array
    {
        if (empty($this->apiKey) || empty(trim($text))) {
            return [];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.openai.com/v1/embeddings', [
                'model' => $this->model,
                'input' => $text,
            ]);
        } catch (\Throwable $e) {
            return [];
        }

        if (! $response->successful()) {
            return [];
        }

        $body = $response->json();

        if (! isset($body['data'][0]['embedding'])) {
            return [];
        }

        return $body['data'][0]['embedding'];
    }
}
