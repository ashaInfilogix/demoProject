@extends('layouts.app')

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Login</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
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
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Have an account?</h3>
                        <form action="{{ route('authenticate') }}" class="signin-form" method="post">
                            @csrf
                            <div class="form-group form-primary">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Username" required>
                                <span class="text-danger error-message" id="email-error"></span>
                            </div>
                            <div class="form-group form-primary">
                                <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                <span class="text-danger error-message" id="password-error"></span>
                                <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="{{ route('forgot-password') }}" style="color: #fff">Forgot Password</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(function() {
            $("form").validate({
                rules: {
                    email: {
                        
                        required: true,
                        email: true // Email format validation
                    },
                    password: {
                        required: true,
                        minlength: 6 // Password must be at least 6 characters long
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    }
                },
                errorClass: "text-danger f-12",
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
