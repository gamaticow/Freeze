<?php

class User{

    private $id;
    private $name;
    private $posts;


    function __construct(){
        $args = func_get_args();
        $id = $args[0];
        $name = $args[1];
        $posts = $args[2];

        $this->id = $id;
        $this->name = $name;
        $this->posts = $posts;
    }

    public function getPosts(){
        return $this->posts;
    }

    function createPost($title, $resume ,$content, $mot_cle, $theme){
        $post = new Post($title,$resume,$content,$this->name,$mot_cle,$theme);
    }

    function getWriteAccessPosts(){
        $sql = "SELECT article FROM DROIT WHERE";
    }

    static function connect($name, $passwd){
        $sql = "SELECT id FROM CLIENT WHERE Pseudo_Cli='".$name."' AND Mdp_Cli='".$passwd."'";
    }

    static function register($name, $passwd){
        $sql = "INSERT INTO CLIENT VALUES  ('','".$name."','".$passwd."')";
    }
}