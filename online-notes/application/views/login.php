<html>
<head>
    <title>Online Notes</title>

    <link href="<?php echo base_url('assets/login/login.css'); ?>" rel="stylesheet"/>
</head>
<body>

<form action="<?php echo base_url('main/authentication'); ?>" method="post">
    <div class="main-form">

        <div class="logo"></div>
        <input name="username" type="text" placeholder="Username">
        <input name="password" type="password" placeholder="Password">
        <label>
            <input type="checkbox"> Remember me
        </label>
        <input type="submit" value="Sign in">
        <a href="#" title="">Forgot your password?</a>
        <div>
            <a href="#" title="">Don't have an account?</a>
            <a href="<?php echo base_url('main/signup'); ?>" title="" target="_blank">Sign Up</a>
        </div>
    </div>
</form>

</body>
</html>