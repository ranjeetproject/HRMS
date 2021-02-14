<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgotten Password</title>
    <link rel="stylesheet" href="{{asset('vendor/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/adminlte/dist/css/adminlte.min.css')}}">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic')}}">
</head>

<body class="login-page" style="background-color: #661fbb9e;">{{--//#024f9257--}}
<div class="login-box">
    <div class="login-logo">
        <a href="javascript:void(0);"><b>Forgotten Password</b></a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Find Your Account</p>
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
            <form autocomplete="off" action="{{action('UserController@forgetPasswordSendLink')}}" method="post" name="forget">
                @csrf
                <div class="input-group mb-3">
                    <input type="email" name="forget_email" class="form-control " value="" placeholder="Please enter your register email address" id="forget_email" autofocus>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                    @if ($errors->has('email'))
                        <span class="error">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <div class="row">
                    <div class="col-8">
                       
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                           Submit
                        </button>
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
        $("form[name='forget']").validate({
            rules: {
                forget_email: "required",
                email: true
            },
            messages: {
                forget_email: "Please enter your valid email",

            },
            errorElement: "span",
            errorClass: "form-text text-danger is-invalid",
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
</body>
</html>