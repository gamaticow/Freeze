<?php

include_once "header.inc.php";

if($isAuth){
    header("location: /index.php");
    exit();
}

if(isset($_POST["name"]) && isset($_POST["passwd"])){
    $user = User::connect($_POST["name"], $_POST["passwd"]);

    $_SESSION["id"] = $_POST["id"];

    header("location: test.php");
    exit();
}
?>

    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <form method="post" action="login.php">
                    <input type="text" class="form-control" name="name" placeholder="Pseudo"><br />
                    <input type="password" class="form-control" name="passwd" placeholder="Mot de passe"><br>
                    <input type="submit" class="btn btn-primary" value="Connexion">
                </form>
            </div>
        </div>
    </div>

<?php
include_once "footer.inc.php";
