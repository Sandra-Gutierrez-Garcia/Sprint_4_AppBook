<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    
    protected $table = 'book';
    protected $primaryKey = 'idbook';
    public $timestamps = true; 

    protected $fillable = [
        'idwriter',
        'title',
        'description',
        'publish_date',
        'photo',
        'content'
    ];

    

    // define the relationship with the writer model
    public function writer()
    {
    return $this->belongsTo(Writer::class, 'idwriter', 'idwriter');
    }
    // define the relationship with the writer model
    public function genres()
{
    return $this->belongsToMany(Genre::class, 'genres_book', 'idbook', 'idgenre');
}
   
   

  
   

}
