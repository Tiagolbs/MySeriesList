<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;
use App\listSerie;
use DB;

class EditTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                    ->visit('/serieslist/32/edit')
                    ->type('temporada', 2)
                    ->type('epsAssistidos', 13)
                    ->type('epsTotais', 13)
                    ->select('status', 'Completed')
                    ->press('Edit Serie')
                    ->assertPathIs('/serieslist')
                    ->assertSee('Titans - Season 2');
        });

        $serie = listSerie::find(32); #id Titans
        $this->assertEquals(2, $serie->temporada);
        $this->assertEquals(13, $serie->epsAssistidos);
        $this->assertEquals(13, $serie->epsTotais);
        $this->assertEquals('Completed', $serie->status);

        listSerie::find(32)->delete();

        $arrSerie = listSerie::pluck('idListSeries')->toArray();

        $this->assertFalse(in_array(32, $arrSerie));
    }

}
