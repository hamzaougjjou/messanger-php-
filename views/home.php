<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="./css/home.css">
    <link rel="stylesheet" href="./fontOwsome/css/all.css">
    <title>Home</title>
</head>

<body>

    <div class="container">

        <div class="row">
            <nav class="menu">
                <ul class="items">
                    <a href="home.php">
                        <li class="item">
                            <i class="fa fa-home item-active" aria-hidden="true"></i>
                        </li>
                    </a>

                    <a href="messanger.php">
                        <li class="item">
                            <i class="fa fa-commenting" aria-hidden="true"></i>
                        </li>
                    </a>
                    <a href="settings.php">
                        <li class="item">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </li>
                    </a>

                </ul>
            </nav>
            <div class="users-container">
                <h1>Users</h1>

                <div class="search">
                    <div class="searchbar">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input id="input-search" type="text" placeholder="Search..." />
                        <i class="fa fa-times" id="btn-cancel-search" aria-hidden="true"></i>

                    </div>
                </div>

                <div id="users" class="users">

                    <!-- <div class="user-item">
                        <div class="img" style="background: url('./img/img1.jpg');">
                        </div>
                        <p class="name">Hamza ougjjou</p>
                        <a href="./messanger.html">
                            Send message
                        </a>
                    </div> -->

                    <i class="fas fa-spinner fa-pulse loading"></i>

                </div>
            </div>
        </div>

    </div>
    <script src="./api/checkLogin.js"></script>
    <script>
        checkLogin('',false);
    </script>
    <script src="./api/home.js"></script>
</body>

</html>