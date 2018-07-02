<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Laravel\Scout\Searchable;

class Circle extends Model
{
    // use Searchable;

    protected $fillable = ['title', 'user_id'];


    public function members()
    {
        return $this->belongsToMany('App\User', 'circle_members');
    }

    public function owner()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    // public function movies()
    // {
    //     return $this->belongsToMany('App\Movie', 'circle_movies');
    // }

    public function getRouteKeyName()
    {
        return 'title';
    }

}
