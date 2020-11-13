<?php
include_once "header.inc.php";

if(!$isAuth){
    header("location: login.php");
    exit();
}

if(empty($_GET["id"]) && empty($_POST["id"])){
    header("location: login.php");
    exit();
}

$post = null;
if(isset($_GET["id"])){
    $post = new Post($_GET["id"]);
}else{
    $post = new Post($_POST["id"]);
}

if($post == null || $post->getId() == 0){
    header("location: index.php");
    exit();
}

$user = unserialize($_SESSION["user"]);
if($post->getAuteur() != $user->getId()){
    header("location: index.php");
    exit();
}

$error = "";

if(isset($_GET["uid"])){
    $post->removeWriteAccessUser($_GET["uid"]);
    header("location: droit.php?id=".$post->getId());
    exit();
}elseif (isset($_POST["name"])){
    $id = User::getIdByName($_POST["name"]);
    if($id > 0 && $id != $user->getId()){
        $post->addWriteAccessUser($id);
        header("location: droit.php?id=".$post->getId());
        exit();
    }else{
        if($id <= 0){
            $error = "<p style='color:red;'>Utilisateur inconnu</p>";
        }else{
            $error = "<p style='color:red;'>Vous ne pouvez pas vous ajouter vous même</p>";
        }
    }
}
?>

<h1>Droit de modification sur l'article :</h1>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Pseudo</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $cpt = 1;
        foreach ($post->getWriteAccessUser() as $uid){
            $name = User::getNameById($uid);
        ?>
        <tr>
            <th scope="row"><?php echo $cpt; ?></th>
            <td><?php echo $name; ?></td>
            <td><a href="droit.php?id=<?php echo $post->getId(); ?>&uid=<?php echo $uid; ?>" class="btn btn-danger btn-sm">Supprimer</a></td>
        </tr>
            <?php
            $cpt++;
        }
            ?>
        </tbody>
    </table>

<h3>Ajouter un éditeur :</h3>
    <?php echo $error; ?>
    <form method="post" action="droit.php?id=<?php echo $post->getId(); ?>">
        <input type="hidden" name="id" value="<?php $post->getId(); ?>">
        <div class="form-row align-items-center">
            <div class="col-sm-3 my-1">
                <label class="sr-only" for="inlineFormInputName">Name</label>
                <input type="text" class="form-control" id="inlineFormInputName" placeholder="Pseudo" name="name">
            </div>
            <div class="col-auto my-1">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>

<?php
include_once "footer.inc.php";

