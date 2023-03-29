<?php

namespace Tests\Browser\Web;

use App\Category;
use App\Store;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoriesTest extends DuskTestCase
{
    /**
     * A Dusk test Index.
     *
     * @return void
     */
    public function testWebCategoryIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/us/category')
                    ->assertSee('Categories');
        });
    }

    /**
     * A Dusk test Stores.
     *
     * @return void
     */
    public function testWebCategoryStores()
    {
        $data = Category::with('slugs')->CustomWhereBasedData(1)->get();

        if(COUNT($data)) {
            $data = $data->random(1)->first();
        } else {
            $data = [];
        }

        $this->browse(function (Browser $browser) use($data) {
            if(isset($data->slugs)) {
                $browser->visit('/us/'.$data->slugs->slug)
                        ->assertSee('About ' . $data->title);
            }
        });
    }

    /**
     * A Dusk test View Stores.
     *
     * @return void
     */
    public function testWebCategoryViewStores()
    {
        $data = Store::CustomWhereBasedData(1)->get();

        if(COUNT($data)) {
            $data = $data->random(1)->first();
        } else {
            $data = [];
        }
        $this->browse(function (Browser $browser) use($data) {
            if(isset($data->slugs)) {
                $browser->visit('/us/'.$data->slugs->slug)
                    ->assertSee($data->name);
            }
        });
    }
}
