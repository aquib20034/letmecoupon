<div class="errorBanner-v1">
    <div class="errorBanner">
        <div class="errorBanner__wrapper">
            <div>
                <div class="errorBanner__image">
                    <figure>
                        <img src="{{config('app.image_path') . '/build/images/error-banner-1.webp' }}" alt="404">
                    </figure>
                </div>

                <div class="errorBanner__title">
                    <h1 class="heading-1 primary">
                        Oops, this page could not be found!
                    </h1>
                </div>

                <div class="errorBanner__description">
                    <p>
                        We checked dozens of 404 pages to find the best that would stand out Creativity and personality of brands.
                    </p>
                </div>
            </div>

            <div class="errorBanner__redirection">
                <div class="errorBanner__redirection__title">
                    <h2 class="heading-1">
                        What would you like to continue?
                    </h2>
                </div>

                <div class="errorBanner__redirection__buttons">
                    <div>
                        <a href="{{config('app.app_path')}}" class="btn-2" aria-label="Visit Home Page">Homepage</a>
                    </div>
                    <div>
                        <a href="{{config('app.app_path').'/sitemap'}}" class="btn-2" aria-label="Visit Store Page">All Stores</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>