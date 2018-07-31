<script type="text/javascript" src="<?php echo base_url('assets/frontend/js/jquery.validate.min.js');?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
//To Validate Final Price After Calculated Discount With Respect To Actual Price
$.validator.addMethod("discount_calculate", function(value, element) {
    var actual_price = $("#product_price").val();
    var discount_percent = $("#product_discount").val();
    if ($.isNumeric(actual_price) && actual_price > 0) {
        var final_price = parseFloat(actual_price) - (parseFloat(actual_price) * parseFloat(discount_percent) / 100);
        $("#product_selling_price").val(final_price);
        return true;
    }

}, ''),

$('#productform').validate({
    debug: true,
    rules: {
        product_name: "required",
        product_price: {
            required: true,
            min: 0,
            discount_calculate: true
        },
        product_discount: {
            required: true,
            min: 0,
            max: 100,
            discount_calculate: true
        },
    },
    messages: {        
        product_price: {
            required: "This field is required",
            digits: 'Please Enter Positive Number',
            min: 0
        },
        product_price: {
            digits: 'Please enter positive number.',
            min: 0,
            max: 'Please enter value less than or equal to 100.',
        },
    },
    errorClass: "help-inline",
    highlight: function(element, errorClass, validClass) {
        $(element).parents('.controls').addClass('error');
    },
    unhighlight: function(element, errorClass, validClass) {
        $(element).parents('.controls').removeClass('error');
    },
    submitHandler: function(form) {
        form.submit();
    }
});
});  
</script>