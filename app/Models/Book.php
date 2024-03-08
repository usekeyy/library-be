<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        "name", 
        "genre_id", 
        "tahun", 
        "penerbit", 
        "deskripsi",
        "created_by", 
        "updated_by"
    ];

    public function scopeDataTable($query)
    {
        $res = $query
        ->leftJoin('genre', 'genre.id', 'books.genre_id')
        ->select('books.*', 'genre.genre_name');
    }

}
