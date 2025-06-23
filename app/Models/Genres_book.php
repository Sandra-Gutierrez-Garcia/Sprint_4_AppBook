<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genres_book extends Model
{
    protected $table='genres_book';
    protected $primaryKey = 'idgenrebook';

    protected $fillable=[
        'idbook',
        'idgenre'

    ];

     public function book()
    {
        return $this->belongsTo(Book::class, 'idbook');
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class, 'idgenre');
    }
}
