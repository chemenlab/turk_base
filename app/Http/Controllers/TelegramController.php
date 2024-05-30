<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Series;
use Telegram\Bot\Api;

class TelegramController extends Controller
{
    public function index()
    {
        return view('telegram.index');
    }

    public function search(Request $request)
    {
        $query = Series::query();

        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->has('year')) {
            $query->where('year', $request->year);
        }

        if ($request->has('imdb_rating')) {
            $query->where('imdb_rating', '>=', $request->imdb_rating);
        }

        if ($request->has('kinopoisk_rating')) {
            $query->where('kinopoisk_rating', '>=', $request->kinopoisk_rating);
        }

        if ($request->has('quality')) {
            $query->where('quality', $request->quality);
        }

        return response()->json($query->get());
    }

    public function show($id)
    {
        $series = Series::findOrFail($id);
        return response()->json($series);
    }

    public function webhook(Request $request)
    {
        $telegram = new Api(env('TELEGRAM_BOT_TOKEN'));
        $update = $telegram->getWebhookUpdates();

        $chatId = $update->getMessage()->getChat()->getId();
        $text = $update->getMessage()->getText();

        if ($text === '/start') {
            $telegram->sendMessage([
                'chat_id' => $chatId,
                'text' => 'Добро пожаловать! Используйте кнопку ниже для открытия веб-приложения.',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => 'Открыть приложение', 'web_app' => ['url' => url('/telegram')]]
                        ]
                    ]
                ])
            ]);
        }

        return response('OK', 200);
    }
}
