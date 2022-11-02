<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css link -->
    <link rel="stylesheet" href="./css/login.css">
    <!-- font owsome link -->
    <!-- <link rel="stylesheet" href="./fontOwsome/css/font-awesome.css"> -->
    <title>login </title>
</head>

<body>

    <div class="container">
        <section class="form-content animate" method="post" action="index.html">
            <h2>login</h2>
            <p id="login-error">
            </p>
            <label for="email"><b>Email</b></label>
            <input type="email" id="email-input" placeholder="Enter email" name="email" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" id="password-input" placeholder="Enter Password" name="psw" required>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            <button id="btn-login" type="submit">Login</button>

            <section class="redirecting">
                <p class="messag">I don't have account ? </p>
                <a href="./register.php">create account</a>
            </section>
        </section>

    </div>

    <script src="./api/checkLogin.js"></script>
    <script>
        checkLogin('./index.php', true, true);
    </script>

    <script src="./api/login.js"></script>
</body>

</html>