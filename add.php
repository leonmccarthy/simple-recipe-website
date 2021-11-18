<?php

    include('config/db_connect.php');

    $name = $email = $foodname = $recipes = '';
    $errors = array('name'=>'', 'email'=>'', 'foodname'=>'', 'recipes'=>'');

    if(isset($_POST['submit'])){

        // check name
        if(empty($_POST['name'])){
            $errors['name'] = 'A name is required! <br />';
        }else{
            $name = $_POST['name'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $name)){
                $errors['name'] = 'Name must be letters and spaces only! <br />';
            }
        }

        // check email
        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required! <br />';
        }else{
            $email = $_POST['email'];
            // if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            //     $errors['email'] = 'Please enter a valid email address!';
            // }
        }

        // check food name
        if(empty($_POST['foodname'])){
            $errors['foodname'] = 'A food name is required! <br />';
        }else{
            $foodname = $_POST['foodname'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $foodname)){
                $errors['foodname'] = 'Foodname must be letters and spaces only! <br />';
            }
        }

        //check recipes
        if(empty($_POST['recipes'])){
            $errors['recipes'] = 'A recipe must contain atleast one ingredient! <br />';
        }else{
            $recipes = $_POST['recipes'];
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $recipes)){
                $errors['recipes'] = 'Invalid entry! (use letters, spaces and commas)  <br />';
            }
        }

        if(array_filter($errors)){

        } else {

            $email = mysqli_real_escape_string($conn, $_POST['email']);

            $name = mysqli_real_escape_string($conn, $_POST['name']);

            $foodname = mysqli_real_escape_string($conn, $_POST['foodname']);

            $recipes = mysqli_real_escape_string($conn, $_POST['recipes']);

            //create sql
            $sql = "INSERT INTO recipes(uname, email, foodname, recipes) VALUES ('$name', '$email', '$foodname', '$recipes')";

            //save to db and check
            if(mysqli_query($conn, $sql)){
                //success
                header('Location: home.php');
            } else {
                //errors
                echo "Query error: ".mysqli_error($conn);
            }
        }

    } //end of post check


?>

<!DOCTYPE html>
<html>

    <?php include('templates/header.php');?>

    <section class="container text-muted my-3">
        <h4 class="text-center">
            Add a Recipe
        </h4>
        <form class="bg-light rounded" action="add.php" method="POST">
            <label class="form-label fw-bold">Your name:</label>
            <input class="form-control" type="text" name="name" placeholder="example: leon" value="<?php echo $name?>">
            <div class="form-label text-danger"><?php echo $errors['name'];?></div>
            <label class="form-label fw-bold">Your email:</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input class="form-control" type="email" name="email" placeholder="example: myemail@example.com" value="<?php echo $email?>">
            </div>
            <div class="form-label text-danger"><?php echo $errors['email'];?></div>
            <label class="form-label fw-bold">Food name:</label>
            <input class="form-control" type="text" name="foodname" placeholder="example: ugali" value="<?php echo $foodname?>">
            <div class="form-label text-danger"><?php echo $errors['foodname'];?></div>
            <label class="form-label fw-bold">Recipe ingredients: (comma separated)</label>
            <input class="form-control" type="text" name="recipes" placeholder="example: maize flour, water" value="<?php echo $recipes?>">
            <div class="form-label text-danger"><?php echo $errors['recipes'];?></div>
            <input class="form-control btn btn-primary mt-4" type="submit" name="submit" value="Submit">
        </form>
    </section>

    <?php include('templates/footer.php');?>

</html>