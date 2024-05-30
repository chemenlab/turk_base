<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $series->name }}</title>
</head>
<body>
    <h1>{{ $series->name }}</h1>
    <img src="{{ $series->poster }}" alt="{{ $series->name }}">
    <p><strong>Год выпуска:</strong> {{ $series->year }}</p>
    <p><strong>Качество:</strong> {{ $series->quality }}</p>
    <p><strong>Рейтинг IMDb:</strong> {{ $series->imdb_rating }}</p>
    <p><strong>Рейтинг Кинопоиск:</strong> {{ $series->kinopoisk_rating }}</p>
    <p>{{ $series->description }}</p>
    <iframe src="https://api.linktodo.ws/embed/kp/{{ $series->kinopoisk_id }}" width="640" height="360" allow="autoplay *" allowfullscreen="" webkitallowfullscreen="" mozallowfullscreen="" oallowfullscreen="" msallowfullscreen=""></iframe>
    <br><br>
    <a href="{{ url('/') }}">Назад к списку</a>
</body>
</html>
