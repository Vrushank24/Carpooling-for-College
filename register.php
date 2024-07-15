<?php
/*
 * Prog Test Bed Login page
 */
require_once ('functions.php');
if (loggedin())
    header("Location: index.php");
else if (isset($_POST['action'])) {
    $con = mysqli_connect("localhost", "root", "", "nuvshare1");
    $name = mysqli_real_escape_string($con, $_POST['name']);
    if ($_POST['action'] == 'register') {
        // register the user
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $number = mysqli_real_escape_string($con, $_POST['contactno']);
        $gender = mysqli_real_escape_string($con, $_POST['sex']);
        $desc = mysqli_real_escape_string($con, $_POST['description']);
        $sex = "M";
        $password = mysqli_real_escape_string($con, $_POST["password"]);
        $reppassword = mysqli_real_escape_string($con, $_POST["re_pass"]);
        if ($gender == "female") {
            $sex = "F";
        } else {
            // create the entry in the users table
            connectdb();
            $query = "SELECT random,hash FROM users WHERE email='" . $email . "'";
            $con = mysqli_connect("localhost", "root", "", "nuvshare1");
            $result = mysqli_query($con, $query);
            if (mysqli_num_rows($result) != 0)
                header("Location: register.php?exists=1");
            else if ($reppassword != $password){
                header("Location: register.php?pass=1");
            }
            else {
                $random = randomNum(5);
                $hash = crypt($_POST['password'], $random);
                $sql = "INSERT INTO `users` ( `name` , `random` , `hash` , `email` , `gender` , `contactno` , `description`, `credits` ) VALUES ('" . $name . "', '$random', '$hash', '" . $email . "','" . $sex . "','" . $number . "','" . $desc . "', 50)";
                mysqli_query($con, $sql);
                header("Location: login.php?registered=1");
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
    <title>Register</title>
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="./css/style.css">
    
</head>

<body>
    <div class="main"
        style="background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 35%, rgba(0,212,255,1) 100%);">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Register</h2>
                        <?php
                        if (isset($_GET['logout']))
                            echo ("<div class=\"alert alert-info\">\nYou have logged out successfully!\n</div>");
                        else if (isset($_GET['error']))
                            echo ("<div class=\"alert alert-error\">\nIncorrect email or password!\n</div>");
                        else if (isset($_GET['ldaperr']))
                            echo ("<div class=\"alert alert-error\">\nIncorrect LDAP username or LDAP password!\n</div>");
                        else if (isset($_GET['registered']))
                            echo ("<div class=\"alert alert-success\">\nYou have been registered successfully! Login to continue.\n</div>");
                        else if (isset($_GET['exists']))
                            echo ("<div class=\"alert alert-error\">\nEmail already exists! Please select a different username.\n</div>");
                        else if (isset($_GET['pass']))
                            echo ("<div class=\"alert alert-error\">\nPassword does not matches Repeat Password\n</div>");
                        else if (isset($_GET['nerror']))
                            echo ("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
                        ?>
                        <form method="POST" class="register-form" id="register-form" action="<?php echo $_SERVER["PHP_SELF"];?>">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name">
                            </div>
                            <input type="hidden" name="action" value="register" />
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email">
                            </div>
                            <div class="form-group">
                                <label for="phnum"><i class="zmdi zmdi-phone"></i></label>
                                <input type="tel" name="contactno" id="phnum" placeholder="Your Phone Number">
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password">
                            </div>
                            <div class="form-group">
                                Gender <br>
                                <input type="radio" name="sex" id="male" class="agree-term">
                                <label for="male" class="label-agree-term">Male</label>
                                <input type="radio" name="sex" id="female" class="agree-term">
                                <label for="female" class="label-agree-term">Female</label>
                                <input type="radio" name="sex" id="other" class="agree-term">
                                <label for="other" class="label-agree-term">Other</label>
                            </div>
                            <div class="form-group">
                                <i class="zmdi zmdi-info-outline"></i><textarea rows="3" name="description"
                                    style="resize: none;width:100%;border-top: none;border-left: none;border-right: none; font-family: poppins;"
                                    placeholder="Your department description might help people send you a pool request easily! "></textarea>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register">
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/img1.png" alt="sign up image"></figure>
                        <a href="login.php" class="signup-image-link">Already Register?</a>
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