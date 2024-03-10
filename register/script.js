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
            return true;
        } else {
            $('#levelerr').remove();
            return false;
        }
    }

    // Trigger validation when any radio button is clicked
    $('.level').on('click', function () {
        validateRadio();
    });
    function validateForm() {
        return true;
    }

    $('#registration-form').submit(function (event) {
        event.preventDefault();
        if (true) {
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
                    console.log(response);
                    alert('Form submitted successfully!');
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
});


// var error = false;
// $('.error').remove();

// // General Info Validation
// var name = $('#name').val().trim();
// if (name === '') {
//     $('#name').after('<span class="error">Name is required.</span>');
//     $("#name").focus();
//     error = true;
// }

// var email = $('#email').val().trim();
// if (email === '') {
//     $('#email').after('<span class="error">Email is required.</span>');
//     $("#email").focus();
//     error = true;
// }

// var mobile = $('#mobile').val().trim();
// if (mobile === '') {
//     $('#mobile').after('<span class="error">Mobile no. is required.</span>');
//     $("#mobile").focus();
//     error = true;
// }

// // Project Partner Info Validation
// if ($('#student-form').is(':visible')) {
//     var name2 = $('#name2').val().trim();
//     if (name2 === '') {
//         $('#name2').after('<span class="error">Student Name is required.</span>');
//         $("#name2").focus();
//         error = true;
//     }

//     var email2 = $('#email2').val().trim();
//     if (email2 === '') {
//         $('#email2').after('<span class="error">Student Email is required.</span>');
//         $("#email2").focus();
//         error = true;
//     }

//     // Calculate age based on yesterday's date
//     var dob1 = $('#dob1').val();
//     var dob1Date = new Date(dob1);
//     var yesterday = new Date('2024-03-08');
//     yesterday.setDate(yesterday.getDate() - 1);
//     var age = yesterday.getFullYear() - dob1Date.getFullYear();
//     var monthDiff = yesterday.getMonth() - dob1Date.getMonth();
//     if (monthDiff < 0 || (monthDiff === 0 && yesterday.getDate() < dob1Date.getDate())) {
//         age--;
//     }
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

// error= validateRadio();
// // Project Info Validation
// var projectName = $('#project_name').val().trim();
// if (projectName === '') {
//     $('#project_name').after('<span class="error">Project Name is required.</span>');
//     $('#projectName').focus();
//     error = true;
// }

// if (error) {
//     event.preventDefault();
// }