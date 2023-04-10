<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AuthorType extends Model
{
    protected $table = "author_types";

    public function author()
    {
        return $this->hasOne(Author::class, 'authors','id','type');
    }
}
