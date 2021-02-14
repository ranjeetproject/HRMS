<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Your Password</title>
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic')}}">
</head>

<body class="login-page" style="background-color: #661fbb9e;">{{--//#024f9257--}}
<div class="login-box">
    <div class="login-logo">
        <a href="javascript:void(0);"><b>Reset Your Password</b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Reset Password</p>
             @if (session('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form autocomplete="off" action="{{action("UserController@resetPasswordForFrontend")}}" method="post" id="changeResetPasswordForm">
                @csrf
                <input type="hidden" name="token" value="{{@$token}}">
                <div class="input-group mb-3">
                        <input type="password" name="new_password_reset" class="form-control" id="new_password_reset"
                               placeholder="Please enter your new password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                        <span id="error_new_password_reset" style="color:#ed0f12;padding:10px;"></span>
                    </div>
                    @if ($errors->has('new_password_reset'))
                        <span class="error">{{ $errors->first('new_password_reset') }}</span>
                    @endif
                </div>
                <div class="input-group mb-2">
                    <input type="password" id="confirm_password_reset" name="confirm_password_reset"
                               class="form-control" placeholder="Please enter confirm password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                        <span id="error_confirm_password_reset" style="color:#ed0f12;padding:10px;"></span>
                    </div>
                    @if ($errors->has('confirm_password_reset'))
                        <span class="error">{{ $errors->first('confirm_password_reset') }}</span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-8">
                       
                    </div>
                    <div class="col-4">
                        <button type="submit" id="changeResetPasswordForm" class="btn btn-primary btn-block btn-flat">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('vendor/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('vendor/adminlte/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  <script>
    $(function () {
            //$('#children_id').select2();
            $('#changeResetPasswordForm').validate({
                rules: {
                    new_password_reset: {
                        required: true

                    },
                    confirm_password_reset: {
                        required: true,
                        equalTo: "#new_password_reset"
                    },
                },
                messages: {
                    new_password_reset: {
                        required: "This new password field is required.",
                    },
                    confirm_password_reset: {
                        required: "This confirm password field is required.",
                        equalTo: "confirm password same as new password"
                    },
                },
                errorElement: "span",
                errorClass: "form-text text-danger is-invalid"
            });
            $('#changeResetPasswordForm').submit(function () {
                $('button[type=submit]').attr("disabled", true);
                setTimeout(function () {
                    $('button[type=submit]').attr("disabled", false);
                }, 3000);
            });

        });
    

       

      
    </script>
</body>
</html>