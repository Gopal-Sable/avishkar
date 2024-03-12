$(document).ready(function () {

    function isRadioSelected(name) {
        return $('input[name="' + name + '"]:checked').length > 0;
    }
    function getSelectedRadioValue(name) {
        return $('input[name="' + name + '"]:checked').val();
    }
    // Function to validate the radio buttons
    function validateRadio() {
        if (!isRadioSelected('level')) {
            $('#level').append('<span id="levelerr" class="error">Please select a level.</span>');
            return false;
        } else {
            $('#levelerr').remove();
            return true;
        }
    }

    // Trigger validation when any radio button is clicked
    $('.level').on('click', function () {
        validateRadio();
    });
    function validateForm() {
        var isValid = true;

        // Validate Name
        var name = $('#name').val().trim();
        if (name === '') {
            $('#name').after('<span class="error">Please enter your name.</span>');
            $('#name').focus();
            isValid = false;
        } else {
            $('#name').siblings('.error').remove();
        }

        // Validate Email
        var email = $('#email').val().trim();
        if (email === '') {
            $('#email').after('<span class="error">Please enter your email.</span>');
            $('#email').focus();
            isValid = false;
        } else {
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                $('#email').after('<span class="error">Please enter a valid email address.</span>');
                $('#email').focus();
                isValid = false;
            } else {
                $('#email').siblings('.error').remove();
            }
        }

        // Validate Mobile Number
        var mobile = $('#mobile').val().trim();
        if (mobile === '') {
            $('#mobile').after('<span class="error">Please enter your mobile number.</span>');
            $('#mobile').focus();
            isValid = false;
        } else {
            var mobilePattern = /^\d{10}$/;
            if (!mobilePattern.test(mobile)) {
                $('#mobile').after('<span class="error">Please enter a valid 10-digit mobile number.</span>');
                $('#mobile').focus();
                isValid = false;
            } else {
                $('#mobile').siblings('.error').remove();
            }
        }

        // Validate Radio Buttons
        isValid = validateRadio() && isValid;

        // Validate Checkbox
        if (!$('input[name="services"]:checked').length) {
            $('#checkboxes').after('<span class="error">Please select at least one service.</span>');
            isValid = false;
        } else {
            $('#checkboxes').siblings('.error').remove();
        }

        // Validate Abstract File
        var abstractFile = $('#abstract').prop('files')[0];
        if (!abstractFile) {
            $('#abstract').after('<span class="error">Please upload an abstract file.</span>');
            isValid = false;
        } else {
            $('#abstract').siblings('.error').remove();
        }

        return isValid;
    }


    $('#registration-form').submit(function (event) {
        event.preventDefault();
        if (validateForm()) {
            event.preventDefault();
            var formData = new FormData($('#registration-form')[0]);

            // Handle radio buttons
            $('input[type="radio"]:checked').each(function () {
                formData.append($(this).attr('gender1'), $(this).val());
                formData.append($(this).attr('gender2'), $(this).val());
                formData.append($(this).attr('level'), $(this).val());
                formData.append($(this).attr('present'), $(this).val());

            });

            // Handle checkboxes
            $('input[type="checkbox"]').each(function () {
                formData.append($(this).attr('services'), $(this).is(':checked') ? $(this).val() : '');
            });

            // Handle file inputs
            var files = $('#abstract')[0].files;
            for (var i = 0; i < files.length; i++) {
                formData.append('abstract', files[i]);
            }

            // Send AJAX request
            $.ajax({
                type: 'POST',
                url: $('#registration-form').attr('action'),
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    // Handle success response
                    // console.log(response);
                    alert(response);
                    // You can redirect the user or do any other action here
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                    alert('Error occurred while submitting the form.');
                }
            });
        }

    });
    // Validation on change for radio buttons
    $('.level').on('change', function () {
        validateRadio();
    });

    // Validation on change for checkboxes
    $('input[name="services"]').on('change', function () {
        if ($('input[name="services"]:checked').length > 0) {
            $('#checkboxes').siblings('.error').remove();
        }
    });
});



//     if (age > 25 && 1==getSelectedRadioValue('level')) {
//         $('#dob1').after('<span class="error">Student should be below 25 years old.</span>');
//         $("#dob1").focus();
//         error = true;
//     }if (age > 30 && 2==getSelectedRadioValue('level')) {
//         $('#dob1').after('<span class="error">Student should be below 25 years old.</span>');
//         $("#dob1").focus();
//         error = true;
//     }
// }
