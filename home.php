<?php

    include('config/db_connect.php');

    //write the query
    $sql = 'SELECT uname, email, foodname, recipes, id FROM recipes ORDER BY created_at';

    //make and get result
    $result = mysqli_query($conn, $sql);

    //fetch the resulting rows as an array
    $recipes = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //free result
    mysqli_free_result($result);

    //free connection
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php');?>

    <h4 class="text-center">
        Recipes
    </h4>
    <div class="container">
        <div class="row">
            <?php foreach ($recipes as $recipe):?>
                <div class="col-md-5 col-sm-6 mx-auto my-5">
                    <div class="card mb-3">
                        <div class="card-body text-center">
                            <h5 class="card-title text-center"><?php echo htmlspecialchars($recipe['foodname'])?></h5>
                            <ul><?php foreach(explode(',', $recipe['recipes']) as $reci):?>
                                <li><?php echo htmlspecialchars($reci)?></li>
                                <?php endforeach;?>
                            </ul>
                        </div>
                        <div class="card-footer text-end">
                            <a href="details.php?id=<?php echo $recipe['id']?>" class="text-uppercase text-primary">more info...</a>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>

    <?php include('templates/footer.php');?>
</html>