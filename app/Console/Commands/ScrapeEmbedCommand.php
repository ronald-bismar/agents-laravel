<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ScraperService;
use App\Services\EmbeddingService;
use App\Models\Embedding;

class ScrapeEmbedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:embed {--url=* : One or more URLs to scrape (use --url=URL multiple times)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape URLs and store embeddings into the embeddings table';

    public function handle(ScraperService $scraper, EmbeddingService $embedder)
    {
        $urls = $this->option('url') ?: config('ai.scrape_urls', []);

        if (empty($urls)) {
            $this->error('No URLs provided. Use --url= or set config ai.scrape_urls.');
            return 1;
        }

        $this->info('Starting scraping for ' . count($urls) . ' URL(s)');

        foreach ($urls as $url) {
            $this->info("Fetching: $url");

            $content = $scraper->fetchContent($url);

            if (empty($content)) {
                $this->warn("No content fetched for: $url");
                continue;
            }

            // Optionally truncate or chunk content before embedding
            $textForEmbedding = mb_substr($content, 0, 3000);

            $vector = $embedder->createEmbedding($textForEmbedding);

            if (empty($vector)) {
                $this->warn("Embedding failed for: $url");
                continue;
            }

            Embedding::create([
                'url' => $url,
                'content' => $content,
                'embedding' => $vector,
            ]);

            $this->info("Saved embedding for: $url");
        }

        $this->info('Done.');
        return 0;
    }
}
