 $(document).ready(function(){
    $('#toggle-check-box').click(function () {
        //check if checkbox is checked
        if ($(this).is(':checked')) {
            $('#checkout-button').removeAttr('disabled'); //enable input

        } else {
            $('#checkout-button').attr('disabled', true); //disable input
        }
    });
});
