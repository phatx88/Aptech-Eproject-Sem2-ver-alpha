<script>
$(function () {
    $('#submitRegistration').click(function (e) {
        e.preventDefault();
        var formData = $("#fromRegister").serializeArray();
        var url = $("#fromRegister").data('action');
        $(".invalid-feedback").children("strong").text("");
        $("#fromRegister input").removeClass("is-invalid");
        $.ajax({
            type: "POST",
            headers: {
                Accept: "application/json"
            },
            url: "{{ route('register') }}",
            data: formData,
            success: () => window.location.assign("{{ route('login') }}"),
            error: (response) => {
                if (response.status === 422) {
                    let errors = response.responseJSON.errors;
                    Object.keys(errors).forEach(function (key) {
                        $("#" + key + "Input").addClass("is-invalid");
                        $("#" + key + "Error").children("strong").text(
                            errors[key][0]);
                    });
                } else {
                    window.location.reload();
                }
            }
        })
    });
});
</script>

 {{-- Make Login Modal to stay open --}}
 @if ($errors->has('email') || $errors->has('password'))
 <script>
     $(function() {
         $('#loginModal').modal({
             show: true
         });
     });

 </script>
@endif