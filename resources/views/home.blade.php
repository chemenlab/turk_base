<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список сериалов</title>
    <style>
        .series-list {
            display: flex;
            flex-wrap: wrap;
        }
        .series-item {
            width: 45%;
            margin: 2.5%;
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        .series-item img {
            max-width: 100%;
        }
    </style>
</head>
<body>
    <h1>Список сериалов</h1>
    <form method="GET" action="/">
        <input type="text" name="name" placeholder="Поиск по названию" value="{{ request('name') }}">
        <input type="number" name="year" placeholder="Год выпуска" value="{{ request('year') }}">
        <input type="text" name="quality" placeholder="Качество" value="{{ request('quality') }}">
        <button type="submit">Поиск</button>
    </form>
    <div class="series-list">
        @foreach($series as $item)
            <div class="series-item">
                <a href="{{ url('/series', $item->id) }}">
                    <img src="{{ $item->poster }}" alt="{{ $item->name }}">
                    <h3>{{ $item->name }}</h3>
                </a>
            </div>
        @endforeach
    </div>
</body>
</html>
