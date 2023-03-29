<?php

namespace Tests\Browser\Web;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PagesTest extends DuskTestCase
{
    /**
     * A Dusk test About Us.
     *
     * @return void
     */
    public function testAboutUs()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/us/about-us')
                    ->assertSee('About Us');
        });
    }

    /**
     * A Dusk test Contact Details.
     *
     * @return void
     */
    public function testContactDetails()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/us/contact-details')
                    ->assertSee('Contact Us');
        });
    }
}
