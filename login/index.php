<?php 
session_start();
if (isset($_POST["signin"])) {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    require_once("common-functions.php");

    // login details
    $user_emailId = trim($_POST["emailid"]);
    $user_password = md5(trim($_POST["password"]));

    // server side validation ========================

    $email_error_mssg = "";
    $pass_error_mssg = "";
    global $valid_check;
    $valid_check = true;

    if (empty(trim($_POST["emailid"]))) {
        $email_error_mssg = "Enter email id";
        $valid_check = false;
    }
    else {
        if (!filter_var($user_emailId, FILTER_VALIDATE_EMAIL)) {
            $email_error_mssg = "Invalid email address";
            $valid_check = false;
        }
    }

    if (empty(trim($_POST["password"]))) {
        $pass_error_mssg = "Enter password";
        $valid_check = false;
    }
    else {
        if (!preg_match("/^[a-zA-Z0-9]{8,10}$/",trim($_POST["password"]))) {
            $pass_error_mssg = "Invalid password";
            $valid_check = false;
        }
    }

    if ($valid_check === true) {

        // database connection
        databaseConnect();

        $sql = "SELECT user_id FROM user WHERE email_id = ?";

        if ($stmt = $con->prepare($sql)) {
            $stmt->bind_param("s",$email_id);
            $email_id = $user_emailId;
            $stmt->execute();
            $result = $stmt->get_result();
            $row_count = $result->num_rows;
        }

        $result->free();
        $stmt->close();

        if ($row_count > 0) {
            // now checking for password 

            $sql = "SELECT user_id FROM user WHERE email_id = ? AND password = ?";

            if ($stmt = $con->prepare($sql)) {
                $stmt->bind_param("ss",$email_id,$password);
                $email_id = $user_emailId;
                $password = $user_password;
                $stmt->execute();
                $result = $stmt->get_result();
                $row_counts = $result->num_rows;
            }

            $user_information = $result->fetch_assoc();
            $result->free();
            $stmt->close();

            if ($row_counts == 1) {

                // remember me 

                if (isset($_POST["remember-me"])) {
                    setcookie("bookmarkEmail",$user_emailId,time()+60*60*24*30);
                }
                else {
                    setcookie("bookmarkEmail","",time()-60);
                }
                $_SESSION["logged_user_id"] = $user_information["user_id"];
                header("Location: ../bookmark/admin/dashboard.php");
            }
            else {
                $invalid_email_error = "Invalid Password";
            }
        }
        else {
            $invalid_email_error = "Invalid Email id";
        }

        databaseClose();
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">
        <!-- Log in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <form method="POST" class="register-form" id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" onsubmit="return validateLogin();">
                            <div class="form-group">
                                <label class="email-pass-icons"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="emailid" id="emailid" placeholder="Email id" value="<?php if (isset($_COOKIE["bookmarkEmail"])) echo $_COOKIE["bookmarkEmail"]; ?>"/>
                            </div>

                            <!-- error message -->
                            <div class="error-messsages" id="emailErrorMssg">
                                <?php 
                                    if (isset($email_error_mssg) && $email_error_mssg != "") {
                                        echo $email_error_mssg;
                                    }
                                ?>
                            </div>

                            <div class="form-group" style="margin-top: 45px;">
                                <label class="email-pass-icons"><i class="zmdi zmdi-lock material-icons-name"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                                <label><i class="zmdi zmdi-eye material-icons-name eye-icon" id="eyeIcon"></i></label>
                            </div>

                            <!-- error message -->
                            <div class="error-messsages" id="passwordErrorMssg">
                                <?php 
                                    if (isset($pass_error_mssg) && $pass_error_mssg != "") {
                                        echo $pass_error_mssg;
                                    }
                                ?>
                            </div>

                            <div class="error-messsages">
                                <?php 
                                    if (isset($invalid_email_error)) {
                                        echo $invalid_email_error;
                                    }
                                
                                ?>
                            </div>

                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" <?php if (isset($_COOKIE["bookmarkEmail"])) echo "checked"; ?>/>
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <a href="#" class="forgot-pass">Forgot password?</a>
                            <a href="../index.php" class="back-to-site">Website</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script src="js/main.js"></script>

    <!-- jquery related things -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#emailid, #password").focus(function() {
                $(".error-messsages").empty();
            });
        });
    </script>
</body>
</html>