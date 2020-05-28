<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category'];

    public function words()
    {
        return $this->hasMany('App\Word', 'category_id', 'id');
    }
}
