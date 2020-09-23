<?php

include_once "header.inc.php";

if($isAuth){
    header("location: /index.php");
    exit();
}

if(isset($_POST["name"]) && isset($_POST["posswd"])){
    $user = User::connect($_POST["name"], $_POST["passwd"]);

    header("location: test.php");
    exit();
}
?>

<form method="post" action="login.php">
    <input type="text" name="id">
    <input type="submit" value="Connexion">
</form>

<?php
include_once "footer.inc.php";
