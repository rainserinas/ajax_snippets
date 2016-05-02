<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registration</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/AdminLTE.min.css'); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/blue.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/custom.css'); ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition register-page">
<div class="register-box">
    <div class="register-logo">
        <a href="#">Registration</a>
    </div>

    <div class="register-box-body">
        <p class="login-box-msg">Register a new membership</p>

        <!-- if get status is set display green alert -->
        <?php if (isset($_GET['status']) && $_GET['status'] == '1') { ?>
            <div class="alert alert-success alert-box">
                <strong>Success!</strong> Please check you email for validation
            </div>
        <?php } else if (isset($_GET['status']) && $_GET['status'] == '2') { ?>
            <div class="alert alert-danger">
                <strong>Warning!</strong> Email registration failed
            </div>
        <?php } ?>

        <form action="<?php echo base_url('MainController/register') ?>" enctype="multipart/form-data"
              accept-charset="utf-8" method="post">

            <div class="form-group has-feedback">
                <input maxlength="255" name="email" type="email" class="form-control" placeholder="Email" required>
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>


            <div class="form-group has-feedback">
                <input min="8" maxlength="25" name="password" type="password" class="form-control password"
                       placeholder="Password" required>

            </div>

            <div class="form-group has-feedback">
                <input onkeyup=validate($(this).val()) maxlength="24" type="password" class="form-control"
                       placeholder="Confirm Password" required>

                <span class="match">Password doesn't match</span>
            </div>

            <div class="form-group has-feedback">
                <input onchange=readURL(this) name="userfile[]" type="file" class="form-control"
                       placeholder="Upload Profile Picture">
                <div class="thumb-img-div" style="display: none;text-align: center;margin-top: 5px">
                    <img height="50" width="50" id="blah"
                         src="#" alt="your image" title="Image thumbnail"/>
                </div>
            </div>

            <div class="form-group has-feedback">
                <input maxlength="30" name="firstname" type="text" class="form-control" placeholder="First Name"
                       required>

            </div>

            <div class="form-group has-feedback">
                <input maxlength="30" name="lastname" type="text" class="form-control" placeholder="Last Name" required>

            </div>

            <div class="form-group has-feedback">
                <input maxlength="30" name="middlename" type="text" class="form-control" placeholder="Middle Name">

            </div>

            <div class="form-group has-feedback">
                <input id="datepicker" name="birthday" type="text" class="form-control datepicker"
                       placeholder="mm/dd/yy" required>

                <span class="date-alert">Date selected not over 18 years old!</span>
            </div>

            <div class="form-group has-feedback">
                <label>Gender</label> <br>
                <label><input name="gender" type="radio" placeholder="Birthday" value="Male">Male</label> <br>
                <label><input name="gender" type="radio" placeholder="Birthday" value="Female">Female</label>
            </div>

            <div class="form-group has-feedback">
                <div class="row phonenum-row">

                    <div class="col-md-8">
                        <input name="phonenum[]" maxlength="11" type="text" class="form-control phonenum"
                               placeholder="Phone Number">

                    </div>

                    <div class="col-md-2">
                        <input type="button" onClick="addnum()" class="btn btn-danger btn-flat" value="Add">
                    </div>

                </div>


            </div>

            <div class="row">

                <button type="submit" class="btn btn-primary btn-block btn-flat submit-btn">Register</button>

            </div>
        </form>


    </div><!-- /.form-box -->
</div><!-- /.register-box -->

<!-- jQuery 2.1.4 -->
<script src="<?php echo base_url('assets/js/jQuery-2.1.4.min.js'); ?>"></script>
<!-- Bootstrap 3.3.5 -->
<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
<!-- iCheck -->
<script src="<?php echo base_url('assets/js/icheck.min.js'); ?>"></script>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>
</body>
</html>
