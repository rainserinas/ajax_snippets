<html>
<head>

    <title>Login</title>

    <style rel="stylesheet">
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: 'helvetica','Open Sans', 'Helvetica Neue', HelveticaNeue, Arial, sans-serif;
            font-size: 16px;
            line-height: 1.48;
            text-align: center;
            color: #2980b9;
        }

        form {
            top:50%;
            left:50%;
            position: absolute;
            margin: -184px 0px 0px -155px;
            width: 300px;
            padding: 3em 2em 2em;
            border: 1px solid currentColor;
            text-align: center;
            color: currentColor;
        }

        legend {
            position: absolute;
            top: -.75em;
            left: 1.7em;
            right: 1.7em;
            background: #fff;
            text-transform: uppercase;
            font-size: 1.1em;
            font-weight: 600;
        }

        input {
            color: #151718;
            font-size: .9em;
            display: block;
            width: 100%;
            margin-bottom: 1em;
            padding: .75em 1em;
            border: 1px solid #2980b9;
            -webkit-transition: all 300ms cubic-bezier(0.23, 1, 0.32, 1);
            transition: all 300ms cubic-bezier(0.23, 1, 0.32, 1);
        }

        input:focus {
            outline: 0;
            -webkit-transform: scale(1.05);
            -moz-transform: scale(1.05)
        }

        button {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding: .75em 1em;
            border: 1px solid;
            color: white;
            background: #2980b9;
            font-size: 1em;
            display: block;
            width: 100%;
            cursor: pointer;
            font-weight: 100;
            -webkit-transition: all 300ms cubic-bezier(0.23, 1, 0.32, 1);
            transition: all 300ms cubic-bezier(0.23, 1, 0.32, 1);
        }

    </style>
</head>
<body>
<form action="http://localhost/ci_admin/admin/login" method="post">
    <legend>Journeytech Inc.</legend>
    <input name="username" type="text" placeholder="Enter Username" required/>
    <input name="password" type="password" placeholder="Enter Password" required/>
    <button type="submit">Submit
    </button>
</form>

</body>
</html>