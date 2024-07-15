<?php
/*
 * Prog Test Bed Login page
 */
require_once ('functions.php');
if (loggedin())
    header("Location: index.php");
else if (isset($_POST['action'])) {
    $con = mysqli_connect("localhost", "root", "", "nuvshare1");
    $email = mysqli_real_escape_string($con, $_POST['email']);
    if ($_POST['action'] == 'login') {
        if (trim($_POST['email']) == "" or trim($_POST['password']) == "")
            header("Location: login.php?nerror=1"); // empty entry
        else {
            // code to login the user and start a session
            connectdb();
            $query = "SELECT random,hash FROM users WHERE email='" . $email . "'";
            $con = mysqli_connect("localhost", "root", "", "nuvshare1");
            $result = mysqli_query($con, $query);
            $fields = mysqli_fetch_array($result);
            $currhash = crypt($_POST['password'], $fields['random']);
            if ($currhash == $fields['hash']) {
                $_SESSION['username'] = $email;
                header("Location: index2.php");

            } else
                header("Location: login.php?error=1");

        }
    } else if ($_POST['action'] == 'ldaplogin') {
        $ldap_uid = strip_tags($_POST['username']);
        $ldap_pass = strip_tags($_POST['password']);
        $ds = ldap_connect("ldap.iitb.ac.in") or die("Unable to connect to LDAP server. Please try again later.");
        if ($ldap_uid != 'administrator') {
            $sr = ldap_search($ds, "dc=iitb,dc=ac,dc=in", "(uid=$ldap_uid)");
            $info = ldap_get_entries($ds, $sr);
            $ldap_uid = $info[0]['dn'];
            $do_bind = @ldap_bind($ds, $ldap_uid, $ldap_pass);
            if ($do_bind) {
                header("Location: register.php");
            } else {
                header("Location: login.php?ldaperr=1");
            }
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="./css/style.css">
    

</head>

<body>
    <div class="main"
        style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">

        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/imglogin.png" alt="Login Image"></figure>
                        <a href="register.php" class="signup-image-link">Create an account</a>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Login</h2>
                        <?php
                        if (isset($_GET['logout']))
                            echo ("<div class=\"alert alert-info\">\nYou have logged out successfully!\n</div>");
                        else if (isset($_GET['error']))
                            echo ("<div class=\"alert alert-error\">\nIncorrect username or password!\n</div>");
                        else if (isset($_GET['ldaperr']))
                            echo ("<div class=\"alert alert-error\">\nIncorrect LDAP username or LDAP password!\n</div>");
                        else if (isset($_GET['registered']))
                            echo ("<div class=\"alert alert-success\">\nYou have been registered successfully! Login to continue.\n</div>");
                        else if (isset($_GET['exists']))
                            echo ("<div class=\"alert alert-error\">\nUser already exists! Please select a different username.\n</div>");
                        else if (isset($_GET['nerror']))
                            echo ("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
                        ?>
                        <form method="POST" class="register-form" id="login-form"
                            action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="email" id="your_name" placeholder="Your Name">
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="your_pass" placeholder="Password">
                            </div>
                            <!-- <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term">
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember
                                    me</label>
                            </div> -->
                            <input type="hidden" name="action" value="login" />
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in">
                            </div>
                        </form>
                        <!-- <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>

</body>
</body>

</html>