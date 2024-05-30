<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Series;

class ParseSeries extends Command
{
    protected $signature = 'parse:series';
    protected $description = 'Парсинг турецких сериалов';

    public function handle()
    {
        $response = Http::get('https://api.bhcesh.me/list', [
            'token' => 'eded453cdcb926332547d370f20b1cd5',
            'type' => 'serials',
            'country_id' => 36,
            'limit' => 500,
        ]);

        $seriesList = $response->json();

        if (!isset($seriesList['results'])) {
            $this->error('Ошибка: Ключ "results" отсутствует в ответе API.');
            return;
        }

        foreach ($seriesList['results'] as $item) {
            $iframeUrl = 'https://api.linktodo.ws/embed/kp/' . $item['kinopoisk_id'];
            Series::updateOrCreate(
                ['kinopoisk_id' => $item['kinopoisk_id']],
                [
                    'name' => $item['name'],
                    'origin_name' => $item['origin_name'] ?? '',
                    'description' => $item['description'] ?? '',
                    'poster' => $item['poster'] ?? '',
                    'year' => $item['year'],
                    'quality' => $item['quality'] ?? '',
                    'imdb_rating' => $item['imdb'] ?? null,
                    'kinopoisk_rating' => $item['kinopoisk'] ?? null,
                    'iframe_url' => $iframeUrl,
                ]
            );
        }

        $this->info('Парсинг завершен успешно.');
    }
}
