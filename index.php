<?php
include_once 'header.inc.php';

$posts = Post::getPosts();

foreach ($posts as $post){
    ?>

    <div class="jumbotron">
        <h1 class="display-4"><?php echo $post->getTitle(); ?></h1>
        <p class="lead"><h2><?php echo User::getNameById($post->getAuteur()); ?></h2><strong>Date :</strong> <?php echo $post->getDate(); ?> <strong>Theme :</strong> <?php echo $post->getTheme();?> <strong>Mots clés :</strong><?php foreach ($post->getMotCle() as $word){echo " ".$word;}?></p>
        <hr class="my-4">
        <p><?php echo $post->getResume(); ?></p>
        <a class="btn btn-primary btn-lg" href="post.php?id=<?php echo $post->getId(); ?>" role="button" >Lire l'article</a>
    </div>

    <?php
}
include_once 'footer.inc.php';