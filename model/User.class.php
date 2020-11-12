<?php

class User{

    private $id;
    private $name;
    private $posts;


    function __construct(){
        include 'db/db.php';
        $args = func_get_args();
        $id = $args[0];
        $name = $args[1];

        $this->id = $id;
        $this->name = $name;
        $this->posts = array();

        $sql = "SELECT Id_Art FROM ARTICLE WHERE Auteur_Art=$this->id";
        foreach ($db->query($sql) as $row){
            array_push($this->posts, new Post($row["Id_Art"]));
        }
    }

    public function getName(){
        return $this->name;
    }

    public function getPosts(){
        return $this->posts;
    }

    function createPost($title, $resume ,$content, $mot_cle, $theme){
        $post = new Post($title,$resume,$content,$this->id,$mot_cle,$theme);
        array_push($this->posts, $post);
        return $post;
    }

    function getWriteAccessPosts(){
        include 'db/db.php';
        $tb = array();
        $sql = "SELECT Id_Art FROM DROIT WHERE Id_Cli=$this->id";
        foreach ($db->query($sql) as $row) {
            array_push($tb, new Post($row["Id_Art"]));
        }
    }

    static function connect($name, $passwd){
        include 'db/db.php';

        $sql = "SELECT Id_Cli FROM CLIENT WHERE Pseudo_Cli='".$name."' AND Mdp_Cli='".$passwd."'";
        $id = null;
        foreach ($db->query($sql) as $row){
            $id = $row["Id_Cli"];
        }
        if($id != null){
            return new User($id, $name);
        }else{
            return null;
        }
    }

    static function register($name, $passwd){
        include 'db/db.php';
        $sql = "SELECT Pseudo_Cli FROM CLIENT WHERE Pseudo_Cli='" . $name . "'";
        $pseudo = null;
        foreach ($db->query($sql) as $row) {
            $pseudo = $row["Pseudo_Cli"];
        }
        if ($pseudo == null) {
            $sql = "INSERT INTO CLIENT(Pseudo_Cli, Mdp_Cli) VALUES('" . $name . "','" . $passwd . "')";
            $db->exec($sql);
            return new User($name, $passwd);
        }
        return null;
    }
}