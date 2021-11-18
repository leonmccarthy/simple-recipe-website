<?php
    include('config/db_connect.php');

    //delete the recipe
    if(isset($_POST['delete'])){
        
        $id_to_delete = mysqli_real_escape_string($conn ,$_POST['id_to_delete']);

        $sql = "DELETE FROM recipes WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)){
            header("Location: home.php");
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    //check GET request id param
    if(isset($_GET['id'])){

        $id = mysqli_real_escape_string($conn, $_GET['id']);
        
        //make sql
        $sql = "SELECT * FROM recipes WHERE id = $id";

        //get the result
        $result = mysqli_query($conn, $sql);

        //fetch result
        $recipe = mysqli_fetch_assoc($result);

        mysqli_close($conn);
        mysqli_free_result($result);

        // print_r($recipe);
    }
?>

<!DOCTYPE html>
<html>
    <?php include('templates/header.php');?>

    <h4 class="text-center text-muted">Details</h4>
    <div class="container ">
        <div class="row ">
            <div class="col-md-4 p-4 mx-auto text-center bg-light text-muted">
                <?php if($recipe):?>
                    <h5><?php echo htmlspecialchars($recipe['foodname'])?></h5>
                    <p>Created by: <?php echo htmlspecialchars($recipe['uname'])?></p>
                    <p>Email: <?php echo htmlspecialchars($recipe['email'])?></p>
                    <p>Created on: <?php echo date($recipe['created_at']);?></p>
                    <h6>Ingredients</h6>
                    <p><?php echo htmlspecialchars($recipe['recipes'])?></p>
                    <form class="mx-1 my-1" action="details.php" method="POST">
                        <input type="hidden" name="id_to_delete" value="<?php echo $recipe['id']?>">
                        <input class="btn btn-danger  px-4"type="submit" name="delete" id="delete" value="Delete">
                    </form>

                <?php else:?>
                    <h5>No such pizza exists</h5>
                <?php endif;?>
            </div>
        </div>
    </div>

    <?php include('templates/footer.php');?>
</html>