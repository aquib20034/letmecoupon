<!-- <a href="{{ config('app.app_path') }}" class="footer__logo">
    <figure>
        <img src="../../build/images/header-logo.webp" alt="Logo">
    </figure>
</a> -->

<h3 class="footer__heading">
    <!--About Logo-->
    <a href="{{ config('app.app_path') }}" class="footer__logo">
        <img src="{{ config('app.app_path') }}/build/images/header-logo.webp" alt="Logo">
    </a>
</h3>

<p class="footer__text">
    {{ trans('sentence.footer_desc') }}
</p>