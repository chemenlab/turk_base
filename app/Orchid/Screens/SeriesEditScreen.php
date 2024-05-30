<?php

namespace App\Orchid\Screens;

use App\Models\Series;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Alert;
use Illuminate\Http\Request;

class SeriesEditScreen extends Screen
{
    public $name = 'Редактирование сериала';
    public $description = 'Добавление и редактирование сериалов';

    private $series;

    public function query(Series $series): array
    {
        $this->series = $series;
        return [
            'series' => $series,
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Сохранить')
                ->icon('check')
                ->method('save'),
            Button::make('Удалить')
                ->icon('trash')
                ->method('delete')
                ->canSee($this->series->exists),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('series.name')
                    ->title('Название')
                    ->placeholder('Введите название сериала')
                    ->required(),
                Input::make('series.origin_name')
                    ->title('Оригинальное название')
                    ->placeholder('Введите оригинальное название сериала'),
                TextArea::make('series.description')
                    ->title('Описание')
                    ->rows(5)
                    ->placeholder('Введите описание сериала'),
                Picture::make('series.poster')
                    ->title('Постер'),
                Input::make('series.year')
                    ->title('Год выпуска')
                    ->type('number')
                    ->placeholder('Введите год выпуска сериала'),
                Input::make('series.quality')
                    ->title('Качество')
                    ->placeholder('Введите качество видео'),
                Input::make('series.imdb_rating')
                    ->title('Рейтинг IMDb')
                    ->type('number')
                    ->step(0.1)
                    ->placeholder('Введите рейтинг IMDb'),
                Input::make('series.kinopoisk_rating')
                    ->title('Рейтинг Кинопоиск')
                    ->type('number')
                    ->step(0.1)
                    ->placeholder('Введите рейтинг Кинопоиск'),
                Input::make('series.iframe_url')
                    ->title('Iframe URL')
                    ->placeholder('Введите URL для iframe'),
            ]),
        ];
    }

    public function save(Series $series, Request $request)
    {
        $series->fill($request->get('series'))->save();
        Alert::info('Сериал сохранен.');
        return redirect()->route('platform.series');
    }

    public function delete(Series $series)
    {
        $series->delete();
        Alert::info('Сериал удален.');
        return redirect()->route('platform.series');
    }
}
