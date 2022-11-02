<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="./css/messanger.css">
    <link rel="stylesheet" href="./fontOwsome/css/all.css">

    <title>messanger</title>
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
                            <i class="fa fa-commenting item-active" aria-hidden="true"></i>
                        </li>
                    </a>
                    <a href="settings.php">
                        <li class="item">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </li>
                    </a>

                </ul>
            </nav>

            <section class="discussions">
                <div class="discussion search">
                    <div class="searchbar">
                        <i class="fa fa-search" aria-hidden="true"></i>
                        <input id="input-search" type="text" placeholder="Search..."></input>
                    </div>
                </div>

                <div id="discussions-items" class="discussions-items">

                    <i class="fas fa-spinner fa-pulse loading"></i>

                    <!-- <div class="discussion-item message-active">
                        <div class="photo" style="background-image: url(./img/img1.jpg);">
                            <div class="online"></div>
                        </div>
                        <div class="desc-contact">
                            <p class="name">Megan Leib</p>
                            <p class="message">9 pm at the bar if possible 😳</p>
                        </div>
                        <div class="timer">12 sec</div>
                    </div> -->

                    <!-- <div class="discussion-item">
                        <div class="photo" style="background-image: url(./img/img2.jpg);">
                            <div class="online"></div>
                        </div>
                        <div class="desc-contact">
                            <p class="name">Dave Corlew</p>
                            <p class="message">Let's meet for a coffee or something today ?</p>
                        </div>
                        <div class="timer">3 min</div>
                    </div> -->

                </div>

            </section>

            <section class="chat">

                <div class="no-user-select">
                    <p id="err-msg">
                    </p>
                </div>

                <div class="header-chat">
                    <img id="header-user-img" src="./img/noProfile.png" alt="user image" />
                    <p id="user-header-name" class="name"></p>
                    <i class="icon clickable fa fa-ellipsis-h " aria-hidden="true"></i>
                </div>
                <div class="messages-chat">

                    <!-- <div class="message message-send">
                        <section>
                            <div class="photo" style="background-image: url('./img/img2.jpg')">
                                <div class="online"></div>
                            </div>
                            <p class="text"> 
                                Hi, how are you 
                            </p>
                        </section>
                        <p class="time"> 14h55</p>
                    </div>

                    <div class="message message-recived">
                        <section>
                            <div class="photo" style="background-image: url('./img/img1.jpg')">
                            </div>
                            <p class="text"> Hi, how are you ? </p>
                        </section>
                        <p class="time"> 14h58</p>
                    </div> -->

                </div>

                <div class="footer-chat">
                    <i class="icon fa fa-smile clickable" style="font-size:25pt;" aria-hidden="true"></i>
                    <input id="message-input" type="text" class="write-message" placeholder="Type your message here" />
                    <i class="icon send fa fa-paper-plane clickable" id="btn-send" aria-hidden="true"></i>
                </div>

            </section>

        </div>

    </div>

    <script src="./api/checkLogin.js"></script>
    <script>
        checkLogin('./index.php', false);
    </script>

    <script src="./api/getDiscussions.js"></script>
    <!-- <script src="./api/discussionSearch.js"></script> -->
    <!-- <script src="./api/getMessages.js"></script> -->
</body>

</html>