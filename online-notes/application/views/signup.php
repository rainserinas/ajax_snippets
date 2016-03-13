<html>
<head>
    <title>Sign up</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets/signup/signup.css'); ?>"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
</head>
<body>
<div class="container">

    <?php if ($_GET['status'] == "1") { ?>

        <div class="alert alert-success">
            <strong>Success!</strong> Signup successful
        </div>

    <?php } else if ($_GET['status'] == "0") { ?>

        <div class="alert alert-warning">
            <strong>Warning!</strong> Signup failed
        </div>

    <?php } else if ($_GET['status'] == "2") { ?>
        <div class="alert alert-warning">
            <strong>Warning!</strong> Signup failed. Username already exists
        </div>
    <?php } ?>
    <form id="signup" action="<?php echo base_url('main/signup_process'); ?>" method="post">

        <div class="header">

            <h3>Sign Up</h3>

            <p>Fill all the data</p>

        </div>

        <div class="sep"></div>

        <div class="inputs">

            <input name="username" type="text" placeholder="username" autofocus/>

            <input name="password" type="password" placeholder="Password" id="password"/>

            <input type="password" placeholder="Re-type password" onkeyup="validate_pass($(this).val())"/>
            <p id="match-password" style="color:red; display:none;">Password input don't match</p>

            <div class="checkboxy">
                <input name="cecky" id="checky" value="1" type="checkbox"/><label class="terms">I accept the terms of
                    use</label>
            </div>

            <input type="submit" id="submit" value="SIGN UP" disabled/>

        </div>

    </form>

</div>
​
<script src="<?php echo base_url('assets/signup/signup.js'); ?>"></script>
</body>
</html>
