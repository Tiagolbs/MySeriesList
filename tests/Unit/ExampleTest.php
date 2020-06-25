<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\SeriesController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use DB;
use App\Serie;

class ExampleTest extends TestCase
{
    use DatabaseMigrations;

    public function testInsertController()
    {
        $serie = ['idImdb' => 'tt0944947', 'nomeSerie' => 'Game of Thrones', 'numTemps' => 8, 'descricao' => '...', 'generoSerie' => 'Action, Adventure, Drama',
            'notaSerie' => 9.3, 'poster' => 'https://m.media-amazon.com/images/M/MV5BYTRiNDQwYzAtMzVlZS00NTI5LWJjYjUtMzkwNTUzMWMxZTllXkEyXkFqcGdeQXVyNDIzMzcwNjc@._V1_SY1000_CR0,0,734,1000_AL_.jpg',
            'epTime' => 57];

        $seriescontroller = new SeriesController;

        $seriescontroller->insertSerie($serie);

        $arrSeries = DB::table('series')->pluck('nomeSerie')->toArray();

        $this->assertTrue(in_array('Game of Thrones', $arrSeries));

        Serie::where('nomeSerie', '=', 'Game of Thrones')->delete();

        $arrSeries = DB::table('series')->pluck('nomeSerie')->toArray();

        $this->assertFalse(in_array('Game of Thrones', $arrSeries));

    }
}
