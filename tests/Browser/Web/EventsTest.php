<?php

namespace Tests\Browser\Web;

use App\Event;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EventsTest extends DuskTestCase
{
    /**
     * A Dusk test Event Index.
     *
     * @return void
     */
    public function testWebEventIndex()
    {
        $data = Event::CustomWhereBasedData(1)->get()->random(1)->first();

        $this->browse(function (Browser $browser) use($data) {
            if(isset($data->slugs)) {
                $browser->visit('/us/' . $data->slugs->slug)
                    ->assertSee($data->title);
            }
        });
    }
}
