<?php

namespace App\Http\Controllers;

use App\Movie;
use Tmdb\Helper\ImageHelper;
use Illuminate\Http\Request;
use Tmdb\Repository\MovieRepository;
use Tmdb\Repository\SearchRepository;
use App\Http\Controllers\Controller;
use Tmdb\Model\Search\SearchQuery\MovieSearchQuery;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        return view('welcome', compact('movies'));
    }

    public function search()
    {
        return view('search');
    }

    public function show(Request $request, Movie $movie)
    {
        return view('show', compact('movie'));
    }

    public function loadDb(MovieRepository $movies)
    {
        $movies_ = $movies->getPopular();

        foreach ($movies_ as $movie) {
            $movie = $movies->load($movie->getId());
            Movie::create([
                'movie_id' => $movie->getId(),
                'backdrop' => $movie->getBackdropPath(),
                'poster' => $movie->getPosterPath(),
                'title' => $movie->getTitle(),
                'description' => $movie->getOverview(),
                'genre' => Movie::serializeGenres($movie),
                'release_year' => $movie->getReleaseDate(),
                'release_date' => $movie->getReleaseDate(),
                'director' => Movie::getMovieDirector($movie),
                'cast' => Movie::getFiveCastMembers($movie),
                'overall_rating' => $movie->getVoteAverage(),
                'runtime' => $movie->getRuntime(),
                'country' => Movie::serializeCountries($movie),
                'trailer' => Movie::getOfficialtrailer($movie),
            ]);
        }
    }


}
