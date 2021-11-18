<?php
    include('config/db_connect2.php');
    session_start();
    $email = $password = '';
    $errors = array('email'=>'','password'=>'', 'login'=>'');
    if(isset($_POST['submit'])){
        if(empty($_POST['email'])){
            $errors['email'] = "Your email is required!";
        } else {
            $email = $_POST['email'];
        }
        if(empty($_POST['password'])){
            $errors['password'] = "Your password is required!";
        } else {
            $password = $_POST['password'];
            if($password<4){
                $errors['password'] = "A password must be atleast 4 characters long!";
            }
        }

        if(array_filter($errors)){

        } else {
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $sql="SELECT * FROM `users_register` WHERE email='$email' and upassword='$password'";
            $result = mysqli_query($conn, $sql);
	        $rows = mysqli_num_rows($result);

        if($rows==1){
	    $_SESSION['email'] = $email;
            // Redirect user to add.php
	    header("Location: add.php");

         }else {
            $errors['login'] = 'Email and password does not match';
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
    <title>Login to UEAB recipes</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar bg-light p-4 navbar-light navbar-fixed-top">
        <div class="container ">
            <a class="navbar-brand mx-auto fs-3 fw-bold brand-text" href="#">UEAB Recipes</a>
        </div>
    </nav>
    <div class="container">
        <form action="index.php" class="register-email bg-light rounded bg-opacity-50" method="POST">
            <p class="fw-bold fs-3 text-center form-label mb-4 brand-text">Login</p>
            <label for="email" class="form-label y-2 fw-bold">Your email:</label>
            <input type="email" class="form-control rounded-pill" name="email" placeholder="example: myemail@example.com" value="<?php echo $email;?>">
            <div class="form-label text-danger"><?php echo $errors['email'];?></div>
            <label for="password" class="form-label my-2 fw-bold">Your password:</label>
            <input type="password" class="form-control my-2 rounded-pill" name="password" placeholder="Enter your password here" value="<?php echo $password;?>">
            <div class="form-label text-danger"><?php echo $errors['password'];?></div>
            <input type="submit" class="form-control btn btn-primary fs-6 mt-4 rounded-pill p-2 mb-3" value="Login" name="submit">
            <div class="form-label text-danger fs-5"><?php echo $errors['login'];?></div>
            <a href="register.php" class="text-center text-muted">Don't have an account? Click here to Register!</a>
        </form>
    </div>
</body>
</html>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>