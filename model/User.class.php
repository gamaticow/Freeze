<?php

class User{

    private $id;
    private $name;
    private $posts;


    function __construct(){

    }

    function getPosts(){

    }

    function createPost($title, $resume ,$content, $mot_cle, $theme){

    }

    function getWriteAccessPosts(){

    }

    static function connect($name, $passwd){
        $sql = "SELECT id FROM CLIENT WHERE Pseudo_Cli='".$name."' AND Mdp_Cli='".$passwd."'";
    }

    static function register($name, $passwd){

    }
}