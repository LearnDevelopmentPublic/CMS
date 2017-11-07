<?php
require_once "connections/db.php";

if(isset($_POST['btn-signup'])){
    $username = trim($_POST['signup-username']);
    $password = trim($_POST['signup-password']);

    if($username==""){
        $error[] = "Please enter a username.";
    }
    else if($password==""){
        $error[] = "Please enter a password.";
    }
    else if(strlen($password < 6)){
        $error[] = "Password must be at least 6 characters long.";
    }
    else{
        $is_registered = $db->select("SELECT username FROM users WHERE username = '$username'");
        if ($is_registered){
            $error[] = "Username is already taken.";
        }
        else {
          if ($user->register($username,$password)){
              echo "Registered";
           }
        }
    }
}

if(isset($_POST['btn-login'])){
    $username = trim($_POST['login-username']);
    $password = trim($_POST['login-password']);

    if($username==""){
        $error[] = "Please enter a username.";
    }
    else if($password==""){
        $error[] = "Please enter a password.";
    }
    else if(strlen($password < 6)){
        $error[] = "Password must be at least 6 characters long.";
    }
    else{
        $existing_member = $db->select("SELECT username password FROM users WHERE username = '$username' AND password = '$password'");
        if ($existing_member){
            $_SESSION['user_id'] = $existing_member['username'];
            $user->redirect('index.php');
        }
        else {
          $error[] = "Account not found.";
        }
    }
}
?>
<!DOCTYPE HTML>
<html lang=en>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <div class="wrapper">
            <header class="header-top">
                <div class="logo"><a href="#">Devvit <span class="logo-io">.io</span></a></div>
                <div class="tagline">SOME. TAGLINE. HERE.</div>
                <ul class="authorization">
                    <li><a href="#">Sign in</a></li>
                    <li><a href="">Register</a></li>
                </ul>
            </header>

            <main>
                <div class="auth-container">
                    <header class="auth-block-header">
                        <img src="images/signup-logo.png" alt="Devvit Logo" class="auth-block-header-logo">
                        <h3 class="auth-block-header-heading">Sign up with Devvit.io</h3>
                        <p class="auth-block-paragraph">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of type.
                        </p>
                    </header>
                    <div class="auth-block-form">
                        <nav>
                            <ul class="auth-action-list">
                                <li class="auth-action-list-item auth-action-list-item-active">Sign up</li>
                                <li class="auth-action-list-item">Login</li>
                            </ul>
                        </nav>
                        <form class="signup-form" action="#" method = "post">
                            <?php if(isset($error)){
                                foreach($error as $error){
                                    ?>
                                    <p style = 'color:#FFF;'><?php echo $error; ?></p>
                                    <?php
                                }
                            } ?>
                            <input type="text" class="signup-form-username" name = "signup-username" placeholder="USERNAME">
                            <input type="password" class="signup-form-password" name = "signup-password" placeholder="PASSWORD">
                            <button type="submit" class="signup-form-submit-btn" name = "btn-signup" >Sign Up</button>
                        </form>
                        <p class="signup-terms">By signing up, you agree to the <a href="#" class="terms-link">Terms of services</a> and <a href="#" class="terms-link">Privacy Policy</a></p>
                    </div>
                </div>
            </main>
        </div>

        <footer class="main-footer">
            <ul class="footer-nav">
                <li><a href="#">Contacts</a></li>
                <li><a href="#">Status</a></li>
                <li><a href="#"><img src="images/logo.png" alt="Logo Picture" class="footer-logo"></a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">About</a></li>
            </ul>
        </footer>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    </body>
</html>