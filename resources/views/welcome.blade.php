@inject('image', 'Tmdb\Helper\ImageHelper')
@extends('layouts.app')

@section('content')
<div class="container">
    <section class="movies" id="movies">
        <h2>Popular Movies</h2>
        <div class="row">
            @foreach($movies as $movie)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <article class="card">
                        <header class="title-header">
                            <h3>{{ $movie->title }}</h3>
                        </header>
                        <div class="card-block">
                            <div class="img-card">
                                {!! $image->getHtml($movie->poster, 'w200', 300, 450) !!}
                            </div>
                            <p class="tagline card-text text-xs-center">{{ $movie->overview }}</p>
                            <a href="#" class="btn btn-primary btn-block"><i class="fa fa-eye"></i> Watch Now</a>
                        </div>
                    </article>
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
