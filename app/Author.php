<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    //
    protected $fillable = ['name','book_id'];
    public function book(){
        return $this->belongsTo(Book::class);
    }
}
