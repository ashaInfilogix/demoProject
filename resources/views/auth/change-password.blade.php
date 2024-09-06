@extends('layouts.app')

@section('content')
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Change Password</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <form action="{{ route('password-change') }}" class="signin-form" method="post" name="change-password">
                        @csrf
                        <input type="hidden" name="email" value="{{ $email }}"> 
                        <div class="form-group form-primary">
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="New Password" required>
                            <span class="text-danger error-message" id="new_password-error"></span>
                        </div>

                        <div class="form-group form-primary">
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required>
                            <span class="text-danger error-message" id="confirm_password-error"></span>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary submit px-3">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.19.5/jquery.validate.min.js"></script>
<script>
    $(function() {
        $('[name="change-password"]').validate({
            rules: {
                new_password: {
                    required: true,
                    minlength: 6 // Example rule: password must be at least 6 characters long
                },
                confirm_password: {
                    required: true,
                    equalTo: "#new_password"
                }
            },
            messages: {
                new_password: {
                    required: "Please enter a new password",
                    minlength: "Your password must be at least 6 characters long"
                },
                confirm_password: {
                    required: "Please confirm your password",
                    equalTo: "Confirm Password does not match New Password"
                }
            },
            errorClass: "text-danger",
            errorElement: "span",
            errorPlacement: function(error, element) {
                var errorId = "#" + element.attr("id") + "-error";
                $(errorId).text(error.text());
            },
            highlight: function(element, errorClass, validClass) {
                $(element).parent().removeClass("form-primary").addClass("form-danger");
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parent().removeClass("form-danger").addClass("form-primary");
                var errorId = "#" + $(element).attr("id") + "-error";
                $(errorId).text(""); // Clear the error message
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
@endsection
