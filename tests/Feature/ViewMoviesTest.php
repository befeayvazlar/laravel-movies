<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class ViewMoviesTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_correct_info()
    {
                Http::fake([
                    'https://api.themoviedb.org/3/movie/popular?language=tr-TR' => $this->fakePopularMovies(),
                    'https://api.themoviedb.org/3/movie/now_playing?language=tr-TR' => $this->fakeNowPlayingMovies(),
                    'https://api.themoviedb.org/3/genre/movie/list?language=tr-TR' => $this->fakeGenres(),
                ]);

        $response = $this->get(route('movies.index'));
        $response->assertSuccessful();
        $response->assertSee('Popular Movies');
        $response->assertSee('Fake Movie');
        $response->assertSee('Aile, Animasyon, Macera, Komedi');
        $response->assertSee('Now Playing');
        $response->assertSee('Now Playing Fake Movie');
    }

    /** @test */
    public function the_movie_page_shows_the_correct_info()
    {
        Http::fake([
            'https://api.themoviedb.org/3/movie/*?language=tr-TR' => $this->fakeSingleMovie(),
        ]);

        $response = $this->get(route('movies.show', 12345));
        $response->assertSee('Fake Jumanji');
        $response->assertSee('Jeanne McCarthy');
        $response->assertSee('Casting Director');
        $response->assertSee('Dwayne Johnson');
    }

    /** @test */
    public function the_search_dropdown_works_correctly()
    {
        Http::fake([
            'https://api.themoviedb.org/3/search/movie?query=jumanji&language=tr-TR' => $this->fakeSearchMovies(),
        ]);

        Livewire::test('search-drop-down')
            ->assertDontSee('avatar')
            ->set('search', 'avatar')
            ->assertSee('Avatar');
    }

    private function fakeSearchMovies()
    {
        return Http::response([
            'results' => [
                [
                    "popularity" => 406.677,
                    "vote_count" => 2607,
                    "video" => false,
                    "poster_path" => "/xBHvZcjRiWyobQ9kxBhO6B2dtRI.jpg",
                    "id" => 419704,
                    "adult" => false,
                    "backdrop_path" => "/5BwqwxMEjeFtdknRV792Svo0K1v.jpg",
                    "original_language" => "en",
                    "original_title" => "Avatar",
                    "genre_ids" => [
                        12,
                        18,
                        9648,
                        878,
                        53,
                    ],
                    "title" => "Avatar",
                    "vote_average" => 6,
                    "overview" => "Avatar description. The near future, a time when both hope and hardships drive humanity to look to the stars and beyond. While a mysterious phenomenon menaces to destroy life on planet earth.",
                    "release_date" => "2019-09-17",
                ]
            ]
        ], 200);
    }


    private function fakePopularMovies()
    {
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/nmGWzTLMXy9x7mKd8NKPLmHtWGa.jpg",
                    "genre_ids" => [
                        0 => 10751,
                        1 => 16,
                        2 => 12,
                        3 => 35,
                    ],
                    "id" => 438148,
                    "original_language" => "en",
                    "original_title" => "Fake Movie",
                    "overview" => "Fake movie description, Kevin ve Bob bir s??permarketten muzlar??n?? alamad??klar?? i??in olduk??a sinirlidir. Bu duruma ????z??m bulmak isteyen ekip, Beyaz Saray???a do??ru yola koyulurlar. Durumu ??ikayet etmek i??in Beyaz Saray???a geldiklerinde ise kendilerini kap??n??n ??n??nde bulurlar. Kovulduklar?? i??in ??a??k??n ve bir o kadar da sinirli olan Stuart, Kevin ve Bob, kendilerine yap??lanlar??n intikam??n?? almak i??in ABD h??k??metini devirmek i??in zorlu bir maceraya at??l??r. Bu maceralar??nda onlara Gru da e??lik edecektir.",
                    "popularity" => 4311.912,
                    "poster_path" => "/hGwFgHejgCTe4xcpRYRHFfIPLU9.jpg",
                    "release_date" => "2022-06-29",
                    "title" => "Fake Movie",
                    "video" => false,
                    "vote_average" => 8,
                    "vote_count" => 109,
                ]
            ]
        ], 200);
    }

    private function fakeNowPlayingMovies()
    {
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/ta17TltHGdZ5PZz6oUD3N5BRurb.jpg",
                    "genre_ids" => [
                        0 => 53
                    ],
                    "id" => 924482,
                    "original_language" => "en",
                    "original_title" => "Now Playing Fake Movie",
                    "overview" => "Now playing fake movie description.",
                    "popularity" => 2659.738,
                    "poster_path" => "/AjhOjyZYWlOIUu30qifMxRpPAVi.jpg",
                    "release_date" => "2022-02-18",
                    "title" => "Now Playing Fake Movie",
                    "video" => false,
                    "vote_average" => 6.3,
                    "vote_count" => 30,
                ]
            ]
        ], 200);
    }

    private function fakeGenres()
    {
        return Http::response([
            'genres' => [
                [
                    "id" => 28,
                    "name" => "Aksiyon"
		        ],
                [
                    "id" => 12,
                    "name" => "Macera"
                ],
                [
                    "id" => 16,
                    "name" => "Animasyon"
                ],
                [
                    "id" => 35,
                    "name" => "Komedi"
                ],
                [
                    "id" => 80,
                    "name" => "Su??"
                ],
                [
                    "id" => 99,
                    "name" => "Belgesel"
                ],
                [
                    "id" => 18,
                    "name" => "Dram"
                ],
                [
                    "id" => 10751,
                    "name" => "Aile"
                ],
                [
                    "id" => 14,
                    "name" => "Fantastik"
                ],
                [
                    "id" => 36,
                    "name" => "Tarih"
                ],
                [
                    "id" => 27,
                    "name" => "Korku"
                ],
                [
                    "id" => 10402,
                    "name" => "M??zik"
                ],
                [
                    "id" => 9648,
                    "name" => "Gizem"
                ],
                [
                    "id" => 10749,
                    "name" => "Romantik"
                ],
                [
                    "id" => 878,
                    "name" => "Bilim-Kurgu"
                ],
                [
                    "id" => 10770,
                    "name" => "TV film"
                ],
                [
                    "id" => 53,
                    "name" => "Gerilim"
                ],
                [
                    "id" => 10752,
                    "name" => "Sava??"
                ],
                [
                    "id" => 37,
                    "name" => "Vah??i Bat??"
                ]
            ]
        ], 200);
    }

    private function fakeSingleMovie()
    {
        return Http::response([
            "adult" => false,
            "backdrop_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
            "genres" => [
                ["id" => 28, "name" => "Action"],
                ["id" => 12, "name" => "Adventure"],
                ["id" => 35, "name" => "Comedy"],
                ["id" => 14, "name" => "Fantasy"],
            ],
            "homepage" => "http://jumanjimovie.com",
            "id" => 12345,
            "overview" => "As the gang return to Jumanji to rescue one of their own, they discover that nothing is as they expect. The players will have to brave parts unknown and unexplored.",
            "poster_path" => "/bB42KDdfWkOvmzmYkmK58ZlCa9P.jpg",
            "release_date" => "2019-12-04",
            "runtime" => 123,
            "title" => "Fake Jumanji: The Next Level",
            "vote_average" => 6.8,
            "credits" => [
                "cast" => [
                    [
                        "cast_id" => 2,
                        "character" => "Dr. Smolder Bravestone",
                        "credit_id" => "5aac3960c3a36846ea005147",
                        "gender" => 2,
                        "id" => 18918,
                        "name" => "Dwayne Johnson",
                        "order" => 0,
                        "profile_path" => "/kuqFzlYMc2IrsOyPznMd1FroeGq.jpg",
                    ]
                ],
                "crew" => [
                    [
                        "credit_id" => "5d51d4ff18b75100174608d8",
                        "department" => "Production",
                        "gender" => 1,
                        "id" => 546,
                        "job" => "Casting Director",
                        "name" => "Jeanne McCarthy",
                        "profile_path" => null,
                    ]
                ]
            ],
            "videos" => [
                "results" => [
                    [
                        "id" => "5d1a1a9b30aa3163c6c5fe57",
                        "iso_639_1" => "en",
                        "iso_3166_1" => "US",
                        "key" => "rBxcF-r9Ibs",
                        "name" => "JUMANJI: THE NEXT LEVEL - Official Trailer (HD)",
                        "site" => "YouTube",
                        "size" => 1080,
                        "type" => "Trailer",
                    ]
                ]
            ],
            "images" => [
                "backdrops" => [
                    [
                        "aspect_ratio" => 1.7777777777778,
                        "file_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
                        "height" => 2160,
                        "iso_639_1" => null,
                        "vote_average" => 5.388,
                        "vote_count" => 4,
                        "width" => 3840,
                    ]
                ],
                "posters" => [
                    [

                    ]
                ]
            ]
        ], 200);
    }

}
