<?php

include "Post.class.php";

//new Post("Post2", "Resume", "Contenu", 1, ["MC1", "MC2"], "Vlog");

$post = new Post(2);
$post->addWriteAccessUser(1);
echo in_array(2, $post->getWriteAccessUser());
