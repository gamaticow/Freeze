<?php

include_once "header.inc.php";

if($isAuth){
    header("location: index.php");
    exit();
}

$error = "";
if(isset($_POST["name"]) && isset($_POST["passwd"])){
    $user = User::connect($_POST["name"], $_POST["passwd"]);

    if($user != null) {
        $_SESSION["user"] = serialize($user);
        header("location: index.php");
        exit();
    }else{
        $error = "<p style='color:red;'>Pseudo ou mot de passe incorrect</p>";
    }
}
?>

                <form method="post" action="login.php">
                    <?php echo $error; ?>
                    <input type="text" class="form-control" name="name" placeholder="Pseudo"><br />
                    <input type="password" class="form-control" name="passwd" placeholder="Mot de passe"><br>
                    <input type="submit" class="btn btn-primary" value="Connexion">
                </form>

<?php
include_once "footer.inc.php";
