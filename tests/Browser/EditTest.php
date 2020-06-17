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
                    ->visit('/serieslist/53/edit')
                    ->assertSee('Editing: Titans')
                    ->type('temporada', 2)
                    ->type('epsAssistidos', 13)
                    ->type('epsTotais', 13)
                    ->select('status', 'Completed')
                    ->press('Edit Serie')
                    ->assertPathIs('/serieslist')
                    ->assertSee('Titans - Season 2');
        });

        $serie = listSerie::find(53); #id Titans
        $this->assertEquals(2, $serie->temporada);
        $this->assertEquals(13, $serie->epsAssistidos);
        $this->assertEquals(13, $serie->epsTotais);
        $this->assertEquals('Completed', $serie->status);
    }

}
