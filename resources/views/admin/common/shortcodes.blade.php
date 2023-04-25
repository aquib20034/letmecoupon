<div class="modal fade" id="shortcodesModal" role="dialog">
    <div class="modal-dialog modal-lg">

      <!-- Modal content-->
      <div class="modal-content">
        
        <div class="modal-header">
          <h4><img src="{{asset('build/images/shortcode.svg')}}" alt="Shortcodes"> Shortcodes</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group shortcodes text-center">
                <button type="button" class="btn btn-success btn-xl generateShortcode" data-shortcode="newsletter" data-option="" data-style="styles"><i class="fas fa-envelope"></i> Newsletter</button>
                <button type="button" class="btn btn-success btn-xl generateShortcode" data-shortcode="singlecoupon" data-option="coupon" data-style="styles"><i class="fas fa-cube"></i> Single Coupon</button>
                <button type="button" class="btn btn-success btn-xl generateShortcode" data-shortcode="multiplecoupon" data-option="coupons" data-style="styles"><i class="fas fa-cubes"></i> Multiple Coupon</button>
            </div>
            <!--<div class="form-group shortcodes-options shortcodes-options-style d-none">
                @php
                    $styles = [['label' => 'Style 1', 'value' => 'style1'], ['label' => 'Style 2', 'value' => 'style2'], ['label' => 'Style 3', 'value' => 'style3'], ['label' => 'Style 4', 'value' => 'style4'], ['label' => 'Style 5', 'value' => 'style5']];
                @endphp
                <label for="style">Select Style</label>
                <select class="form-control select2 shortcodes-options-input" name="style" id="style">
                    @foreach($styles as $id => $style)
                        <option value="{{ $style['value'] }}">{{ $style['label'] }}</option>
                    @endforeach
                </select>
            </div>-->
            <div class="form-group shortcodes-options shortcodes-options-coupon d-none">
                <label for="coupons">Select Coupon</label>
                <select class="form-control select2 shortcodes-options-input" name="coupon" id="coupon">
                    @foreach($coupons as $id => $coupon)
                        <option value="{{ $id }}">{{ $coupon }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group shortcodes-options shortcodes-options-coupons d-none">
                <div>
                    <label for="coupons">Select Coupons</label>
                    <span class="btn btn-info btn-xs deselect-all pull-right" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    <span class="btn btn-info btn-xs select-all pull-right mr-1" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                </div>
                <select class="form-control select2 shortcodes-options-input" name="coupons[]" id="coupons" multiple>
                    @foreach($coupons as $id => $coupon)
                        <option value="{{ $id }}">{{ $coupon }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group shortcodes-outputs text-center">
                <button type="button" class="btn btn-primary pull-right btn-sm mt-2 mr-2" id="copyShortcode"><i class="fas fa-copy"></i> Copy</button>
                <xmp class="shortcodes-output" id="shortcodeContent">Select any shortcode</xmp>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Close</button>
            <button type="button" class="btn btn-primary pull-left" id="addGeneratedShortcode"><span class="glyphicon glyphicon-add"></span> Add</button>
        </div>
      </div>
    </div>
</div>
<script>
    //add Shortcode button
    editor = CKEDITOR.replace('long_description'); // bind editor
    //console.log(editor.config)

    editor.addCommand("addShortcodes", { // create named command
        exec: function(edt) {
            //alert(edt.getData());
            $("#shortcodesModal").modal();
            $("#shortcodeContent").html('Select any shortcode');
            $('#addGeneratedShortcode').attr('disabled','disabled');
        }
    });

    editor.ui.addButton('SuperButton', { // add new button and bind our command
        label: "Add Shortcodes",
        command: 'addShortcodes',
        toolbar: 'tools',
        //icon:"Add Shortcodes",
        icon:"{{asset('build/images/shortcode.svg')}}"
    });

    $('.generateShortcode').click(function () {
        let style = $("#style").val();
        let option = $(this).data('option');
        let shortcode = $(this).data('shortcode');
        $('.shortcodes-options').addClass('d-none');
        if(shortcode == "newsletter"){
            style = (style)?style:'style2';
            $("#shortcodeContent").html('[newsletter style="'+style+'"][/newsletter]');
        }

        if(shortcode == "singlecoupon"){
            $('.shortcodes-options-'+option).removeClass('d-none');
            //$("#shortcodeContent").html('[coupon data=""][/coupon]');
        }

        if(shortcode == "multiplecoupon"){
            $('.shortcodes-options-'+option).removeClass('d-none');
            //$("#shortcodeContent").html('[coupon data=""][/coupon]');
        }
        $('#addGeneratedShortcode').removeAttr('disabled')
    });

    $('.shortcodes-options-input').keyup(function () {
        generateShortcode($(this))
    });

    $('.shortcodes-options-input').change(function () {
        generateShortcode($(this))
    });

    $('#addGeneratedShortcode').click(function () {
        let editor_data = editor.getData();
        let shortcode = $("#shortcodeContent").html();
        //console.log(editor_data+"<p>"+shortcode+"</p>")
        editor.setData(editor_data+"<p>"+shortcode+"</p>");
        $("#shortcodesModal").modal('hide');
    });

    let copyShortcode = document.getElementById("copyShortcode");
    copyShortcode.addEventListener("click", function () {
    navigator.clipboard
        .writeText($("#shortcodeContent").html())
        .then(
        (success) => console.log("text copied"),
        (err) => console.log("error copying text")
        );
    });

    function generateShortcode(element){
        let value = element.val();
        let input = element.attr('id');
        //console.log(value.join(", "))
        let style = $("#style").val();
        if(input == 'coupon' || input == 'coupons'){
            style = (style)?style:'style2';
            $("#shortcodeContent").html('[coupon style="'+style+'" coupons="'+value+'"][/coupon]');
        }
    }
</script>