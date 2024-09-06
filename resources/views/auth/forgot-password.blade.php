@extends('layouts.app')

@section('content')
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Forgot Password</h2>
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
                        <form action="{{ route('otp-send') }}" class="signin-form" method="post">
                            @csrf
                            <div class="form-group form-primary">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                <span class="text-danger error-message" id="email-error"></span>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">SUbmit</button>
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
                },
                messages: {
                    email: {
                        required: "Please enter your email",
                        email: "Please enter a valid email address"
                    },
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
