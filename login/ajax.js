
function Login() {
    const email = $("#email").val();
    const pass = $("#pass").val();
    $.ajax({
        url: "login.php",
        method: "POST",
        data: {
            email: email,
            pass: pass
        },
        success: function (data) {
            if (data == 0) {
                $("#logStatus").html('<small class="alert alert-danger">Invalid Credentials !</small>');
            } else if (data == 1) {
                swal("Good job!", "Login Successful", "success");
                $('#LoginModal').modal('toggle');
                setTimeout(() => {
                    if (email=='admin') {
                        window.location.href = "../admin/index.php";
                    }else{
                        window.location.href = "../college/dashboard.php";
                    }
                    
                }, 1000)
            }
            else {
                $("#logStatus").html('<small class="alert alert-danger">Internal Server Error!</small>');
            }
        },
    })
}