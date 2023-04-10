<?php

namespace App\ViewComposers;

use Illuminate\View\View;
use \App\WebModel\Site as Site;
use App\Event;
use App\WebModel\Store;
use App\WebModel\WebsiteSetting;
use App\WebModel\Page;
use App\WebModel\Blog;
use App\WebModel\Category;
use Illuminate\Support\Facades\Cache;

class SiteWideData
{
	public function compose(View $view)
	{
		$data = [];

		$siteid = config('app.siteid');

		$data['global_data'] = Cache::remember(
			"SiteWide__GlobalSiteSettings",
			21600,
			function () {
				return WebsiteSetting::select(
					'id',
					'site_logo',
					'site_favicon',
					'twitter',
					'instagram',
					'facebook',
					'youtube',
					'pinterest',
					'linked_in',
					'site_javascript',
					'site_html_tags',
					'primary_color',
					'secondary_color',
					'tertiary_color',
					'categories_popular',
					'stores_popular',
					'stores_related',
					'coupons_active',
					'coupons_expired',
					'coupons_full',
					'coupons_minimal',
					'blogs_trending',
					'blogs_popular',
					'blogs_recent',
					'reviews_trending',
					'reviews_popular',
					'reviews_recent',
					'coupon_card_style_primary',
					'coupon_card_style_secondary'
				)
					->first()
					->toArray();
			}
		);
		//dd($data['global_data']);


		$data['site_wide_data'] = Cache::remember(
			"SiteWide__RegionSetting__{$siteid}s",
			21600,
			function () use ($siteid) {
				return Site::select(
					'id',
					'name',
					'country_name',
					'country_code',
					'url',
					'html_tags',
					'javascript_tags',
					'meta_title',
					'meta_description',
					'country_flag',
					'about_desc',
					'about_image',
					'store_heading_one_suffix',
					'primary_keyword',
					'secondary_keyword',
					'store_meta_title_template',
					'store_meta_description_template',
					'category_page_title_template',
					'category_meta_title_template',
					'category_meta_description_template'
				)
					->whereId($siteid)
					->first()
					->toArray();
			}
		);

		$data['blogs_count'] = Cache::remember(
			"SiteWide__BlogsCount__{$siteid}",
			21600,
			function () use ($siteid) {
				return Blog::select('id')
					->where('publish', 1)
					->CustomWhereBasedData($siteid)
					->count();
			}
		);

		$data['bottom_event'] = Cache::remember(
			"SiteWide__FooterEvents",
			21600,
			function () use ($siteid) {
				return Event::select(
					'id',
					'title',
					'slug'
				)
					->with('slugs')
					->where('publish', 1)
					->where('bottom', 1)
					->with('sites')
					->whereHas('sites', function ($q) use ($siteid) {
						$q->where('site_id', $siteid);
					})
					->orderBy('id', 'desc')
					->take(5)
					->get()
					->toArray();
			}
		);

		$data['pages'] = Cache::remember(
			"SiteWide__Pages__{$siteid}",
			21600,
			function () use ($siteid) {
				return Page::select(
					'id',
					'title',
					'top',
					'bottom',
					'publish',
					'meta_title',
					'meta_keywords',
					'meta_description'
				)
					->with(['slugs' => function ($slugQuery) {
						$slugQuery->select(['id', 'obj_id', 'slug', 'old_slug']);
					}])
					->whereHas('sites', function ($page) use ($siteid) {
						$page->where('site_id', $siteid);
					})
					->take(3)
					->get()
					->toArray();
			}
		);

		$data['sites'] = Cache::remember(
			"Sitewide__SiteList__{$siteid}",
			86400,
			function () {
				return Site::select(
					'id',
					'country_name',
					'country_code',
					'url',
					'country_flag'
				)
					->where('publish', 1)
					->get()
					->toArray();
			}
		);

		$data['socials'] = [['field_name' => 'facebook', 'icon_name' => 'facebook'], ['field_name' => 'twitter', 'icon_name' => 'twitter'], ['field_name' => 'instagram', 'icon_name' => 'instagram'], ['field_name' => 'linked_in', 'icon_name' => 'linkedin'], ['field_name' => 'youtube', 'icon_name' => 'youtube'], ['field_name' => 'pinterest', 'icon_name' => 'pinterest']];		
		
		$data['fullCouponCardCss']		= 'coupon-card-full-' . $data['global_data']['coupon_card_style_primary'];
		$data['minimalCouponCardCss']	= 'coupon-card-minimal-' . $data['global_data']['coupon_card_style_secondary'];

		$view->with($data);
	}
}
