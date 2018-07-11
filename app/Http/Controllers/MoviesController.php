<?php

namespace App\Http\Controllers\Api;

use App\Movie;
use Tmdb\Helper\ImageHelper;
use Illuminate\Http\Request;
use Tmdb\Repository\MovieRepository;
use Tmdb\Repository\SearchRepository;
use App\Http\Controllers\Controller;
use Tmdb\Model\Search\SearchQuery\MovieSearchQuery;

class MoviesController extends Controller
{
    public function __construct(MovieRepository $movies, SearchRepository $search, ImageHelper $helper)
    {
        $this->movies = $movies;
        $this->search = $search;
        $this->helper = $helper;
    }


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

    public function loadDb()
    {
        $movies = $this->movies->getPopular();

        foreach ($movies as $movie) {
            $movie = $this->movies->load($movie->getId());
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
