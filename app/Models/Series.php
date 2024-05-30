<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Series extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'name',
        'origin_name',
        'description',
        'poster',
        'year',
        'quality',
        'imdb_rating',
        'kinopoisk_rating',
        'kinopoisk_id',
        'iframe_url',
    ];
}
