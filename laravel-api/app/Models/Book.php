<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'author',
        'birth_date',
        'death_date',
        'language',
        'generos',
        'downloads',
        'pdf_path',
        'image_path'

    ];

    protected $casts = [
        'author' => 'array',
        'generos' => 'array',
        'language' => 'array',
    ];
}
