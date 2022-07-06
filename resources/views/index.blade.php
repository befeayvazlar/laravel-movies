@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 pt-16">
        <div class="popular-movies"></div>
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Movies / Popüler Filmler</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
            @foreach($popularMovies as $movie)
                <x-movie-card :movie="$movie" :genres="$genres"/>
            @endforeach
        </div>
        <!-- End Popular Movies -->
        <div class="now-playing-movies py-24"></div>
        <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Now Playing / Vizyondakiler</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
            @foreach($nowPlayingMovies as $movie)
                <x-movie-card :movie="$movie" :genres="$genres"/>
            @endforeach
        </div>
    </div><!-- End Now Playing Movies -->
@endsection
