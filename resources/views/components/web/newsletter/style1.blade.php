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

@push('scripts')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script>
$(document).ready(function(){
    $(".submit").click(function(event) {
        event.preventDefault();
        var email = $(".subBoxEmail").val();
        if(email == ''){
            Swal.fire({
                title: '',
                text: "{{ trans('sentence.email_field_is_required') }}",
                icon: 'info',
                confirmButtonText: 'OK',
                confirmButtonColor: '#ea5a4f',
            })
        }else{
            var valid = validate_email(email);
            if (valid != false) {
                subscribe(email);
            } else {
                Swal.fire({
                    title: '',
                    text: "{{ trans('sentence.invalid_email') }}",
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ea5a4f',
                })
            }
        }
    });

    $(".subBoxEmail").keypress(function(e) {
        if (e.which == 13) {
            e.preventDefault();
            var email = $(this).val();
            if(email == ''){
                Swal.fire({
                    title: '',
                    text: "{{ trans('sentence.email_field_is_required') }}",
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ea5a4f',
                })
            }else{
                var valid = validate_email(email);
                if (valid != false) {
                    subscribe(email);
                } else {
                    Swal.fire({
                        title: '',
                        text: "{{ trans('sentence.invalid_email') }}",
                        icon: 'info',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#ea5a4f',
                    })
                }
            }
        }
    });

    function subscribe(email) {
        $.ajax({
            url: '{{ route('submitsubscribe') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "dataType": "JSON",
                'data': {
                    'email': email
                },
            },
            success: function(data) {
                console.log(data);
                Swal.fire({
                    title: '',
                    text: data.msg,
                    icon: data.icon,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ea5a4f',
                })

                if(data.icon == 'success')
                    $('.subBoxEmail').val('');
            },
            error: function(data) {
                Swal.fire({
                    title: '',
                    text: data,
                    icon: 'info',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#ea5a4f',
                })
                console.log(data);
            }
        });
    }

    function validate_email(email) {
        var validEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
        if (validEmail.test(email)) {
            return true;
        } else {
            return false;
        }
    }
})
</script>
@endpush