<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./css/settings.css">
    <link rel="stylesheet" href="./fontOwsome/css/all.css">
    <title>Settings</title>
</head>

<body>

    <div class="container">

        <div class="row">
            <nav class="menu">
                <ul class="items">
                    <a href="home.php">
                        <li class="item">
                            <i class="fa fa-home" aria-hidden="true"></i>
                        </li>
                    </a>

                    <a href="messanger.php">
                        <li class="item">
                            <i class="fa fa-commenting" aria-hidden="true"></i>
                        </li>
                    </a>
                    <a href="settings.php">
                        <li class="item">
                            <i class="fa fa-cog item-active" aria-hidden="true"></i>
                        </li>
                    </a>

                </ul>
            </nav>

            <div class="settings-container">

                <div id="user-item-container">
                    <i class="fas fa-spinner fa-pulse loading"></i>
                </div>

                <button id="btn-log-out">Log out</button>
            </div>
        </div>

    </div>
    <script src="./api/checkLogin.js"></script>
    <script>
        checkLogin('',false);
    </script>
    <script src="./api/settings.js"></script>
</body>

</html>