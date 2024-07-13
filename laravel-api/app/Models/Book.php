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
        'birth_year',
        'death_year',
        'language',
        'genres',
        'downloads',
        'pdf_path',
        'image_path'

    ];
}
