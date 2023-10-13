<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login to NMCP</title>

    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset('/bower_components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/bower_components/admin-lte/dist/css/skins/skin-red.min.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- Theme style -->
    <link href="{{ asset('/bower_components/admin-lte/dist/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('/bower_components/admin-lte/plugins/iCheck/square/blue.css') }}">
</head>

<body class="hold-transition login-page">
    <div style="padding-top: 20px; margin-bottom: 0px; box-sizing: border-box;">
        <!--h1>NMCP</h1-->
        <table style="margin:auto; width: 800px; color:white; font-size:small;">
            <tr style="text-align:center;">
                <td colspan="3" align-item="center">
                    <h3 style="font-size: 18px;">Ministry of Health, Myanmar</h3>
                </td>
            </tr>
            <tr>
                <td width="350px" align="right">
                    National Malaria Control Programme<br />
                    အမျိုးသားငှက်ဖျားရောဂါတိုက်ဖျက်ရေးစီမံချက်
                </td>
                <td width="100px" style="padding: 10px;"><img src="/img/moh_logo.png" width="100px" /></td>
                <td width="350px">
                    Malaria Surveillance System<br />
                    ငှက်ဖျားရောဂါစောင့်ကြပ်ကြည့်ရှုခြင်းစနစ်
                </td>
            </tr>
        </table>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-info alert-block text-center ct-margin">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    @if ($errors->has('error'))
        <div class="alert alert-danger text-center ct-margin">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $errors->first('error') }}</strong>
        </div>
    @endif
    <div class="login-box">
        <div class="login-box-body">
            <p class="text-center" id="login_message">သင့် ပြည်နယ်/တိုင်း/မြို့နယ် အကောင့်ဖြင့်ဝင်ပါ</p>
            <form action="login" method="post">
                {{ csrf_field() }}
                <div class="form-group has-feedback">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                        required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                        required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-md-8">

                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-block btn-primary btn-flat" id="submitBtn">Sign
                            in</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="text-center" id="footer-info">
        <strong>Version {{ config('app.version') }}</strong>
        <p>Powered By <a href="www.agga.io"><b>AGGA.IO</b></a></p>
    </div>
    <!-- jQuery 3 -->
    <script src="{{ asset('/bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- iCheck -->
    <script src="{{ asset('/bower_components/admin-lte/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });
        $(document).ready(function() {
            $('#email').focus();
        });
        document.getElementById('submitBtn').onsubmit = () => {
            document.body.style.cursor = 'wait';
        }
    </script>
    <style>
        .login-page {
            background: #999;
        }

        .ct-margin {
            margin: auto 30%;
        }

        #footer-info {
            opacity: 0.25;
        }

        #footer-info>p,
        #footer-info>strong {
            letter-spacing: 0.1em;
        }

        #footer-info>p>i {
            color: red;
        }

        #footer-info>p>a {
            color: indigo;
        }
    </style>
</body>

</html>
