<div class="newsLetterStyle1">
    <div class="newsLetter">
        <div class="newsLetter__wrapper">
            <div class="newsLetter__left">
                <div class="newsLetter__typography">
                    <h2 class="heading">{{ trans('sentence.subscribe_heading') }}
                        <!-- Subscribe so you can get real time help from 3,000,000+ loyal users. Let's get your back as well. -->
                    </h2>
                </div>
            </div>

            <div class="newsLetter__right">
                <form onsubmit="(e)=> e.preventDefault()">
                    <div class="newsLetter__formGroup">
                        <input type="email" class="subBoxEmail newsLetter__input"
                        placeholder="{{ trans('sentence.enter_email')}}">
                        <button type="button" class="newsLetter__button submit">{{ trans('sentence.subscribe_btn') }}
                            <!-- Subscribe -->
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>