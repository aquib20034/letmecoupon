@php
$web_settings = App\WebModel\WebsiteSetting::select(
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
                //dd($web_settings);
$data['web_settings'] =  $web_settings;
@endphp
@component('components.web.'.$postfixes,$data)@endcomponent