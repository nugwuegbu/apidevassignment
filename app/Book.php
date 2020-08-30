<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Book extends Model
{
    //
    use HasApiTokens;
    protected $fillable = ['name','isbn','number_of_pages','publisher','country','release_date'];

    public function author(){
        return $this->hasOne(Author::class);
    }
}
