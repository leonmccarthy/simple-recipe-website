<?php
    include('config/db_connect2.php');
    $firstname = $lastname = $gender = $email = $password = $retype_password ='';
    $errors = array('firstname'=>'', 'lastname'=>'', 'email'=>'','password'=>'', 'retype_password'=>'');
    if(isset($_POST['submit'])){
        if(empty($_POST['firstname'])){
            $errors['firstname'] = "Your first name is required!";
        } else {
            $firstname = $_POST['firstname'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $firstname)){
                $errors['firstname'] = 'Your first name must be letters and spaces only!';
            }
        }
        if(empty($_POST['lastname'])){
            $errors['lastname'] = "Your last name is required!";
        } else {
            $lastname = $_POST['lastname'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $lastname)){
                $errors['lastname'] = 'Your last name must be letters and spaces only!';
            }
        }
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
        if(empty($_POST['retype_password'])){
            $errors['retype_password'] = "You need to retype your password!";
        } else {
            $retype_password = $_POST['retype_password'];
            if(!$password==$retype_password){
                $errors['retype_password'] = "The password retyped entered does not match!";
            }
        }
        $gender = $_POST['gender'];

        if(array_filter($errors)){

        } else {
            $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
            $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $gender = mysqli_real_escape_string($conn, $_POST['gender']);

            $sql="SELECT * FROM 'users_register' WHERE email= '$email'";
            $result = mysqli_query($conn, $sql);

             $sql = "INSERT INTO users_register(fname, lname, email, upassword, gender) VALUES ('$firstname', '$lastname', '$email', '$password', '$gender')";

            //save to db and check
            if(mysqli_query($conn, $sql)){
                //success
                echo "<script>alert('Data saved successfully!')</script>";
                header('Location: index.php');
            } else {
                //errors
                echo "Query error: ".mysqli_error($conn);
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
    <title>Register with UEAB recipes</title>
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
        <form action="register.php" class="register-email bg-light rounded bg-opacity-50" method="POST">
            <p class="fw-bold fs-3 text-center form-label mb-4 brand-text">Register</p>
            <label for="firstname" class="form-label my-2 fw-bold">Firstname</label>
            <input type="text" placeholder="Enter your firstname" name="firstname" class="form-control rounded-pill" value="<?php echo $firstname;?>">
            <div class="form-label text-danger"><?php echo $errors['firstname'];?></div>
            <label for="lastname" class="form-label my-2 fw-bold">Lastname</label>
            <input type="text" placeholder="Enter your lastname" name="lastname" class="form-control rounded-pill" value="<?php echo $lastname;?>">
            <div class="form-label text-danger"><?php echo $errors['lastname'];?></div>
            <label for="gender" class="form-label my-2 fw-bold">Gender</label>
            <div class="col-md-10">
                <div class="form-check form-check-inline">
                    <label for="male" class="form-label radio">Male </label>
                    <input type="radio" value="male" id="male" name="gender" class="form-check-input">
                </div>
                <div class="form-check form-check-inline">
                    <label for="female" class="form-label radio">Female </label>
                    <input type="radio" value="female" id="female"  name="gender" class="form-check-input">
                </div>
                <div class="form-check form-check-inline">
                    <label for="other" class="form-label radio">Other </label>
                    <input type="radio" value="other" id="other" name="gender" class="form-check-input" checked>
                </div>
            </div>

            <label for="email" class="form-label y-2 fw-bold">Your email:</label>
            <input type="email" class="form-control rounded-pill" name="email" placeholder="example: myemail@example.com" value="<?php echo $email;?>">
            <div class="form-label text-danger"><?php echo $errors['email'];?></div>
            <label for="password" class="form-label my-2 fw-bold">Your password:</label>
            <input type="password" class="form-control my-2 rounded-pill" name="password" placeholder="Enter your password here" value="<?php echo $password;?>">
            <div class="form-label text-danger"><?php echo $errors['password'];?></div>
            <label for="password" class="form-label my-2 fw-bold">Re-type password:</label>
            <input type="password" class="form-control my-2 rounded-pill" name="retype_password" placeholder="Enter your password here" value="<?php echo $retype_password;?>">
            <div class="form-label text-danger"><?php echo $errors['retype_password'];?></div>
            <input type="submit" class="form-control btn btn-primary fs-6 mt-4 rounded-pill p-2 mb-3" value="Register" name="submit">
            <a href="index.php" class="text-center text-muted">Have an account already? Click here to Login!</a>
            <p class="fw-bold form-label mt-4 brand-text text-end">(You will be redirected to the login page once your details are correct and have been saved automatically)</p>
        </form>
    </div>
    
</body>
</html>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="bootstrap/js/bootstrap.min.js"></script>