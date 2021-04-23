// Wait for the DOM to be ready
$(function() {
    // Initialize form validation on the registration form.
    // It has the name attribute "registration"
    $("form[name='check-out-form-with-validation']").validate({
      // Specify validation rules
      rules: {
        // The key name on the left side is the name attribute
        // of an input field. Validation rules are defined
        // on the right side
        shipping_fullname: {
            required: true,
            minlength: 5
        },
        shipping_mobile: {
            required: true,
            minlength: 10,
            maxlength: 12,
            number:true

        },
        shipping_email: {
          required: true,
          // Specify that email should be validated
          // by the built-in "email" rule
          email: true
        },
        shipping_housenumber_street: {
            required: true,
            minlength: 5
        }
      },
      // Specify validation error messages
      messages: {
        shipping_fullname: "Please enter your fullname!!!",
        // lastname: "Please enter your lastname",
        // password: {
        //   required: "Please provide a password",
        //   minlength: "Your password must be at least 5 characters long"
        // },
        shipping_mobile: "Please enter phone number at least 12 number",
        shipping_email: "Please enter a valid email address",
        shipping_housenumber_street: "Please enter your full address"
      },
      // Make sure the form is submitted to the destination defined
      // in the "action" attribute of the form when valid
      submitHandler: function(form) {
        form.submit();
      }
    });
  });
