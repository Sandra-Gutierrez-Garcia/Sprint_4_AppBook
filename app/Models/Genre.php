<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    protected $table='genre';
    protected $primaryKey='idgenre';

    protected $fillable=[
        'namegenre'
    ];
    //

    public function books()
    {
        return $this->belongsToMany(Book::class, 'genres_book', 'idgenre', 'idbook');
    }
}
