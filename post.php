<?php
include_once 'header.inc.php';

if (empty($_GET["id"])){
    header("locaction: index.php");
    exit();
}

$post = new Post($_GET["id"]);
if($post == null || $post->getId() == 0){
    header("locaction: index.php");
    exit();
}

?>

    <div class="jumbotron">
        <h1 class="display-4"><?php echo $post->getTitle(); ?></h1>
        <p class="lead"><h2><?php echo User::getNameById($post->getAuteur()); ?></h2> <?php echo $post->getDate(); ?> </p>
        <hr class="my-4">
        <p><?php echo $post->getContent(); ?></p>
        <?php
        $edit_btn = '<a class="btn btn-success btn-lg" href="edit.php?id='.$post->getId().'" role="button" >Modifier l\'article</a>';
        $right_button = '<a class="btn btn-primary btn-lg" href="droit.php?id='.$post->getId().'" role="button" style="margin-left: 10px;">Droit de modification</a>';
        if($isAuth){
            $user = unserialize($_SESSION["user"]);
            if($post->getAuteur() == $user->getId() || in_array($user->getId(), $post->getWriteAccessUser())){
                echo $edit_btn;
            }
            if($post->getAuteur() == $user->getId()){
                echo $right_button;
            }
        }
        ?>
    </div>

<?php
include_once 'footer.inc.php';