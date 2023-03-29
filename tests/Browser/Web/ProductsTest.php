<?php

namespace Tests\Browser\Web;

use App\Product;
use App\ProductCategory;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductsTest extends DuskTestCase
{
    /**
     * A Dusk test Product Index.
     *
     * @return void
     */
    public function testProductIndex()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/us/best-products')
                ->assertSee('Product Listing');
        });
    }
    /**
     * A Dusk test Product Detail.
     *
     * @return void
     */
    public function testProductDetail()
    {
        $data = ProductCategory::CustomWhereBasedData(1)->get()->random(1)->first();
        $this->browse(function (Browser $browser) use($data) {
            if(isset($data->slugs)) {
                $browser->visit('/us/'.$data->slugs->slug)
                    ->assertSee($data->title_heading);
            }
        });
    }
}
