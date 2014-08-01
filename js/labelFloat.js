$(document).ready(function(e){
reFloatLabel();
});

function reFloatLabel(){
if($('.bs-float-label input').length){
    var bs_float_on_class = "on";
    var bs_float_show_class = "show";
    
    $('.float-input').on('bs-check-value', function(){
        var _bs_label = $(this).closest('.bs-float-label').find('.float-label');
        if (this.value !== ''){
            _bs_label.addClass(bs_float_show_class);
        } else {
            _bs_label.removeClass(bs_float_show_class);
        }
    })
    .on("keyup",function(){
        $(this).trigger("bs-check-value");
    })
	.on('change',function(){
        $(this).trigger("bs-check-value");
    })
    .on("focus",function(){
        $(this).closest(".bs-float-label").find('.float-label').addClass(bs_float_on_class);
    })
    .on("blur",function(){
        $(this).closest(".bs-float-label").find('.float-label').removeClass(bs_float_on_class);
    }).trigger("bs-check-value");
    ;
}
}