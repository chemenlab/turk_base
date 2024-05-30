<?php

namespace App\Orchid\Screens;

use App\Models\Series;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\TD;

class SeriesScreen extends Screen
{
    public $name = 'Управление сериалами';
    public $description = 'Добавление, редактирование и удаление сериалов';

    public function query(): array
    {
        return [
            'series' => Series::paginate(),
        ];
    }

    public function commandBar(): array
    {
        return [
            Link::make('Добавить сериал')
                ->icon('plus')
                ->route('platform.series.create'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::table('series', [
                TD::make('name', 'Название')
                    ->render(function (Series $series) {
                        return Link::make($series->name)
                            ->route('platform.series.edit', $series);
                    }),
                TD::make('origin_name', 'Оригинальное название'),
                TD::make('year', 'Год'),
                TD::make('quality', 'Качество'),
                TD::make('imdb_rating', 'Рейтинг IMDb'),
                TD::make('kinopoisk_rating', 'Рейтинг Кинопоиск'),
            ]),
        ];
    }
}
