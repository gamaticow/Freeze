<?php

include "Post.class.php";

//new Post("Titre", "Resume", "Contenu", 1, ["MC1", "MC2"], "Vlog");

$post = new Post(1);
print_r($post->getMotCle());
$post->removeMotCle("MC2");
$post->addMotCle("MC3");
print_r($post->getMotCle());