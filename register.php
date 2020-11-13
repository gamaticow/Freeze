<?php

include_once 'header.inc.php';

if($isAuth){
    header("location: index.php");
    exit();
}

$error = "";

if(isset($_POST["name"]) && isset($_POST["passwd"]) && isset($_POST["c-passwd"])){
    $name = $_POST["name"];
    $passwd = $_POST["passwd"];
    // Vérification de la longueur du nom de l'utilisateur
    if(strlen($name) > 2 && strlen($name) < 26){
        if(strcmp($passwd, $_POST["c-passwd"]) === 0){
            if(strlen($passwd) > 5 && strlen($passwd) < 33){
                $user = User::register($name, $passwd);
                if($user != null){
                    $_SESSION["user"] = serialize($user);
                    header("location: index.php");
                    exit();
                }else{
                    $error = "<p style='color:red;'>Ce pseudo est déjà utilisé</p>";
                }
            }else{
                $error = "<p style='color:red;'>La longueur du mot de passe doit être comprise 6 et 32 caractères</p>";
            }
        }else{
            $error = "<p style='color:red;'>Les mots de passes ne sont pas identiques</p>";
        }
    }else{
        $error = "<p style='color:red;'>La longueur du pseudo doit être comprise entre 3 et 25 caractères</p>";
    }
}

?>

            <form method="post" action="register.php">
                <?php echo $error; ?>
                <input type="text" class="form-control" name="name" placeholder="Pseudo"><br />
                <input type="password" class="form-control" name="passwd" placeholder="Mot de passe"><br>
                <input type="password" class="form-control" name="c-passwd" placeholder="Confirmation mot de passe"><br>
                <input type="submit" class="btn btn-primary" value="Inscription">
            </form>

<?php
include_once 'footer.inc.php';