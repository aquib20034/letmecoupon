@if(isset($detail['faq_title']) && $detail['faq_title'] != '' )
<div>
    <h2 class="heading-1">{{$detail['faq_title']}}</h2>
</div>
<div class="faqListing">
        @if(isset($detail['faq_json']) &&  sizeof(json_decode($detail['faq_json'],true)) > 0 )
        @php
            $faqs = json_decode($detail['faq_json'],true);
        @endphp
        @foreach($faqs as $key => $faq)
        <div class="accordionStyle1">
            <div class="accordion js-accordionStyle1">
                <div class="accordion__wrapper">
                    <div class="accordion__head <?php echo "js-accordion-{$key}"; ?>" onclick="toggleAccordion(this)">
                        <h3 class="title">{{$faq['question']}}</h3>
                        <span class="icon">
                            <i class="x_arrow-down-2"></i>
                        </span>
                    </div>
                    <div class="accordion__content">
                        <p>{{$faq['answer']}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endif