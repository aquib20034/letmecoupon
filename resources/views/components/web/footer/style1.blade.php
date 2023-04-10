<div class="footerStyle1">
    <footer class="footer">
        <div class="footer__wrapper">
            <div class="footer__top">
                <div class="footer__top__wrapper container">
                    <div class="footer__description">
                        @web_component([ 'postfixes' => 'footer.about.style1','data' => [] ])@endweb_component
                    </div>

                    <div class="footer__navigation">
                        <div class="navigation">
                            @web_component([ 'postfixes' => 'footer.navigation.style1','data' => ['pages' => $pages,'bottom_event' => $bottom_event,'blogs_count' => $blogs_count] ])@endweb_component
                        </div>

                        <div class="navigation">
                            @web_component([ 'postfixes' => 'footer.follow.style1','data' => ['global_data' => $global_data, 'socials' => $socials] ])@endweb_component
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer__bottom">
                <div class="footer__bottom__wrapper container">
                    <p class="footer__text footer__text--white footer__text--center">
                        {!! trans('sentence.copyright_text') !!}
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>