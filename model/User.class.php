<?php

class User{

    private $id;
    private $name;


    function __construct(){
        $args = func_get_args();
        $id = $args[0];
        $name = $args[1];

        $this->id = $id;
        $this->name = $name;
    }

    public function getId(){
        return $this->id;
    }

    public function getName(){
        return $this->name;
    }

    public function getPosts(){
        include 'db/db.php';
        $posts = array();

        $sql = "SELECT Id_Art FROM ARTICLE WHERE Auteur_Art=$this->id";
        foreach ($db->query($sql) as $row){
            array_push($posts, new Post($row["Id_Art"]));
        }
        return $posts;
    }

    function createPost($title, $resume ,$content, $mot_cle, $theme){
        $post = new Post($title,$resume,$content,$this->id,$mot_cle,$theme);
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
        $passwd = md5($passwd);
        $sql = "SELECT Id_Cli FROM CLIENT WHERE Pseudo_Cli='".str_replace('\'', '\'\'', $name)."' AND Mdp_Cli='".$passwd."'";
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
        $passwd = md5($passwd);
        $sql = "SELECT Pseudo_Cli FROM CLIENT WHERE Pseudo_Cli='".str_replace('\'', '\'\'', $name)."'";
        $pseudo = null;
        foreach ($db->query($sql) as $row) {
            $pseudo = $row["Pseudo_Cli"];
        }
        if ($pseudo == null) {
            $sql = "INSERT INTO CLIENT(Pseudo_Cli, Mdp_Cli) VALUES('".str_replace('\'', '\'\'', $name)."','" . $passwd . "')";
            $db->exec($sql);
            return new User($db->lastInsertId(), $name);
        }
        return null;
    }

    static function getNameById($id){
        include 'db/db.php';
        $name = "";
        $sql = "SELECT Pseudo_Cli FROM CLIENT WHERE Id_Cli=$id";
        foreach ($db->query($sql) as $row){
            $name = $row["Pseudo_Cli"];
        }

        return $name;
    }

    static function getIdByName($name){
        include 'db/db.php';
        $id = 0;
        $sql = "SELECT Id_Cli FROM CLIENT WHERE Pseudo_Cli='$name'";
        foreach ($db->query($sql) as $row){
            $id = $row["Id_Cli"];
        }
        return $id;
    }
}