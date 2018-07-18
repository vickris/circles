<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Movie extends Model
{
    use Searchable;

    protected $fillable = [
        'movie_id',
        'backdrop',
        'poster',
        'title',
        'description',
        'genre',
        'release_year',
        'release_date',
        'director',
        'cast',
        'overall_rating',
        'runtime',
        'country',
        'trailer',
    ];

    public function getRouteKeyName()
    {
        return 'title';
    }

    protected $casts = [
        'genre' => 'array',
        'cast' => 'array',
        'country' => 'array',
    ];


    protected static function getMovieDirector($movie)
    {
        $crew = $movie->getCredits()->getCrew();
        if(count($crew) > 0) {
            $crew = reset($crew);
            return reset($crew)->getName();
        };

        return "Director unavailable at the moment";
    }

    protected static function getFiveCastMembers($movie)
    {
        $cast_array = [];
        $cast = $movie->getCredits()->getCast();
        if(count($cast) > 0) {
            $cast = reset($cast);
            array_splice($cast, 5);
            foreach ($cast as $key => $member) {
                $cast_array[] = $member->getName();
            }
            return serialize($cast_array);
        };

        return serialize(["Could not load any actors at the moment"]);
    }

    protected static function getOfficialtrailer($movie)
    {
        foreach ($movie->getVideos() as $trailer) {
            return $trailer->getUrl();
        }
    }

    protected static function serializeGenres($movie)
    {
        $genre_arr = [];
        if(count($movie->getGenres()) > 0) {
            foreach ($movie->getGenres() as $genre) {
                $genre_arr = $genre->getName();
            }
            return serialize($genre_arr);
        }

        return serialize(["No genres Available"]);
    }


    protected static function serializeCountries($movie)
    {
        $country_arr = [];
        foreach($movie->getProductionCountries() as $country) {
            $country_arr[] = $country->getName();
         }

        if(count($country_arr) > 0) {
            return serialize($country_arr);
        } else {
            return serialize(["No countries available at the moment"]);
        }

    }

    // public function director()
    // {
    //     return $this->hasMany('App\Movie');
    // }

    // public function genres()
    // {
    //     return $this->belongsToMany('App\Genre');
    // }

    // public function cast()
    // {
    //     return $this->belongsToMany('App\Cast');
    // }

    public function circles()
    {
        return $this->belongsToMany('App\Circle');
    }

    public function backdropUrl($size = 300)
    {
        return 'https://image.tmdb.org/t/p/w' . $size . $this->backdrop;
    }

    public function toSearchableArray()
    {
        $properties = $this->toArray();
        $properties['backdrop_url'] = $this->backdropUrl();

        return $properties;
    }
}
