<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; 


class Writer extends Model
{
    use HasUuids; 
    protected $table = 'writer';
    protected $primaryKey = 'idwriter';
    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'name',
        'username',
        'password',
        'biography',
        'photo'
    ];
        protected $hidden = [
         'password'
        ];
    public function books()
    {
        return $this->hasMany(Book::class, 'idwriter', 'idwriter');
    }

}
