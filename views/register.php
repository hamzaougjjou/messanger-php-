<?php

include './../config.php';

session_start();

$err = '';
$username = '';
$email = '';
$password = '';
$c_password = '';
$imgStatus = 1;

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['psw'];
    $c_password = $_POST['c-psw'];
    // $profile_image = $_POST['profile-image'];
    if (strlen($username) < 2) {
        # code...
        $err = 'invalid full name';
    } elseif (strlen($email) < 1) {
        $err = "please insert email ";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $err = "Invalid email format";
    } elseif (strlen($password) < 1) {
        # code...
        $err = 'please insert password';
    } elseif (strlen($password) < 6) {
        # code...
        $err = 'password should be mor than 6 char';
    } elseif ($password != $c_password) {
        # code...
        $err = 'password and confrm password not the same';
    }
    // ==============uploading image
    elseif (empty($_FILES["profile-image"]["name"])) {
        $err = 'Please select an image file to upload.';
    }

    // ==============uploading image
    else {
        $sql = "SELECT * FROM users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            // ======================
            if (!empty($_FILES["profile-image"]["name"])) {
                // Get file info 
                $fileName = basename($_FILES["profile-image"]["name"]);
                $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

                // Allow certain file formats 
                $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
                if (in_array($fileType, $allowTypes)) {
                    $image = $_FILES['profile-image']['tmp_name'];
                    $imgContent = addslashes(file_get_contents($image));
                    // Insert image content into database 
                    $insert_query = "INSERT INTO users (username,email, password,image)
    				VALUES ('$username', '$email', '$password','$imgContent')";
                    $insert_result = mysqli_query($conn, $insert_query);
                    if ($insert_result) {
                        $last_id = $conn->insert_id;
                        $status = 1;
                        $username = "";
                        $email = "";
                        $_POST['psw'] = "";
                        $_POST['c-psw'] = "";
                        $_SESSION['id'] = $last_id;
                        echo "<script>
                                localStorage.setItem('id'," . $last_id . ");
                                window.location.href = './index.php';
                            </script>";

                        // header("Location: home.php");
                    } else {
                        $err = "Woops! Something Wrong Went.";
                    }
                } else {
                    $err = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
                }
            }
            // ======================

        } else {
            $err = "Woops! Email Already Exists.";
        }
    }
}

?>

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
    <title>Register </title>
</head>

<body>

    <div class="container">
        <form class="form-content animate" method="POST" action="" enctype="multipart/form-data">
            <h2>Register</h2>
            <p id="login-error">
                <?php echo $err; ?>
            </p>

            <label for="username"><b>Full name</b></label>
            <input type="text" id="username-input" placeholder="Enter Full name" name="username" value="<?php echo $username; ?>" />

            <label for="email"><b>Email</b></label>
            <input type="email" id="email-input" placeholder="Enter email" name="email" value="<?php echo $email; ?>" />

            <label for="psw"><b>Password</b></label>
            <input type="password" id="password-input" placeholder="Enter Password" name="psw" value="<?php echo $password; ?>" />

            <label for="c-psw"><b>Confirm Password</b></label>
            <input type="password" id="c-password-input" placeholder="Confirm Password" name="c-psw" value="<?php echo $c_password; ?>" />

            <label for="profile-image"><b>Select profile image</b></label>
            <input type="file" id="profile-image" name="profile-image" accept="image/*" />

            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>

            <button name="submit" id="btn-login" type="submit">Register</button>

            <section class="redirecting">
                <p class="messag">I have account ? </p>
                <a href="./login.php">Login</a>
            </section>
        </form>
    </div>

    <script src="./api/checkLogin.js"></script>
    <script>
        checkLogin('./index.php', false,true);
    </script>

</body>

</html>