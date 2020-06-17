<?php

use Illuminate\Database\Seeder;
use App\Serie;

class SerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Serie::create([
            'idSerieImdb'=>'tt4574334',
            'nomeSerie'=>'Stranger Things',
            'numTemps'=>2,
            'descricao'=>'When a young boy disappears, his mother, a police chief and his friends must confront terrifying supernatural forces in order to get him back',
            'generoSerie'=>'Drama, Fantasy, Horror ',
            'notaSerie' => 8.8,
            'poster' => 'https://m.media-amazon.com/images/M/MV5BZGExYjQzNTQtNGNhMi00YmY1LTlhY2MtMTRjODg3MjU4YTAyXkEyXkFqcGdeQXVyMTkxNjUyNQ@@._V1_.jpg'
        ]);
    }
}
