<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\User;
use DB;

class DeleteTest extends DuskTestCase
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
                    ->visit('/serieslist')
                    ->assertSee('Supernatural - Season 1')
                    ->press('[id=btnDelete]')
                    ->assertSee('Are you sure?')
                    ->press('Delete')
                    ->waitForReload()
                    ->assertDontSee('Supernatural - Season 1');
        });

        $series = DB::table('list_series')->pluck('idSerie')->toArray(); 
        $this->assertFalse(in_array(3, $series)); #Supernatural
        $this->assertTrue(in_array(2, $series));  #Titans

        DB::table('list_series')->insert(['idUser'=>1,'idSerie'=>3, 'temporada' => 1, 'epsAssistidos' => 15, 'epsTotais'=> 22, 'status'=>'Watching']); 
    }
}
