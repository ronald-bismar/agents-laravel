<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ScraperService
{
    /**
     * Fetch page and return cleaned text content.
     */
    public function fetchContent(string $url): string
    {
        try {
            $response = Http::timeout(30)->get($url);
        } catch (\Throwable $e) {
            return '';
        }

        if (! $response->successful()) {
            return '';
        }

        $html = $response->body();

        // Strip scripts/styles and tags, keep readable text
        // Remove script/style contents
        $html = preg_replace('#<script.*?>.*?</script>#is', '', $html);
        $html = preg_replace('#<style.*?>.*?</style>#is', '', $html);

        // Strip tags and decode entities
        $text = html_entity_decode(strip_tags($html), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

        // Normalize whitespace
        $text = preg_replace('/\s+/', ' ', $text);

        return trim($text);
    }
}
