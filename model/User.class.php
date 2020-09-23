<?php

class User{

    private $id;
    private $name;
    private $posts;

    static function connect($name, $passwd){
        $sql = "SELECT id FROM CLIENT WHERE Pseudo_Cli='".$name."' AND Mdp_Cli='".$passwd."'";
    }
}