<?php

class Post {

    private $id;
    private $title;
    private $resume;
    private $content;
    private $mot_cle; //Tableau de mots clé
    private $auteur; //ID de l'auteur
    private $theme;
    private $date;

    function __construct(){
        $ctp = func_num_args();
        $args = func_get_args();

        switch ($ctp){
            case 6:
                $this->newInsert($args[0], $args[1], $args[2], $args[3], $args[4], $args[5]);
                break;
            case 1:
                $this->newSelect($args[0]);
                break;
        }
    }

    private function newInsert($title, $resume, $content, $auteur, $mot_cle, $theme){
        include 'db/db.php';
        //TODO Insertion dans la BDD
        $this->title=$title;
        $this->resume=$resume;
        $this->content=$content;
        $this->auteur=$auteur;
        $this->mot_cle=$mot_cle;
        $this->theme=$theme;
        $this->date = date("Y-m-d H:i:s");
        $sql= "INSERT INTO ARTICLE(Nom_Article, Cont_Art, Auteur_Art, Date_Art, Theme_Art, Resume_Art) VALUES ('".str_replace('\'', '\'\'', $title)."','".str_replace('\'', '\'\'', $content)."',$auteur,'".$this->date."','".str_replace('\'', '\'\'', $theme)."','".str_replace('\'', '\'\'', $resume)."')";
        $db->exec($sql);
        $this->id=$db->lastInsertId();

        foreach ($mot_cle as $mc){
            $sql = "INSERT INTO MOTCLE VALUES ($this->id,'".str_replace('\'', '\'\'', $mc)."')";
            $db->exec($sql);
        }
    }

    private function newSelect($id){
        include 'db/db.php';
        //TODO Remplir les attributs a partir d'un article de la bdd
        $this->id=$id;
        $sql="SELECT * FROM ARTICLE WHERE Id_Art=$id";
        foreach ($db->query($sql) as $row){
            $this->title=$row['Nom_Article'];
            $this->resume=$row['Resume_Art'];
            $this->content=$row['Cont_Art'];
            $this->auteur=$row['Auteur_Art'];
            $this->theme=$row['Theme_Art'];
            $this->date=$row['Date_Art'];
        }

        $this->mot_cle = array();
        $sql="SELECT Mot_Cle_Art FROM MOTCLE WHERE Id_Art=$id";
        foreach ($db->query($sql) as $row){
            array_push($this->mot_cle, $row["Mot_Cle_Art"]);
        }
    }

    public function getId(){
        return $this->id;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        include 'db/db.php';
        $this->title = $title;
        //TODO Insertion dans la BDD
        $sql= "UPDATE ARTICLE SET Nom_Article='".str_replace('\'', '\'\'', $title)."' WHERE Id_Art=$this->id";
        $db->exec($sql);
    }

    public function getResume(){
        return $this->resume;
    }

    public function setResume($resume){
        include 'db/db.php';
        $this->resume = $resume;
        //TODO Insertion dans la BDD
        $sql= "UPDATE ARTICLE SET Resume_Art='".str_replace('\'', '\'\'', $resume)."' WHERE Id_Art=$this->id";
        $db->exec($sql);
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        include 'db/db.php';
        $this->content = $content;
        //TODO Insertion dans la BDD
        $sql= "UPDATE ARTICLE SET Cont_Art='".str_replace('\'', '\'\'', $content)."' WHERE Id_Art=$this->id";
        $db->exec($sql);
    }

    public function getMotCle(){
        return $this->mot_cle;
    }

    public function addMotCle($mot_cle){
        include 'db/db.php';
        $sql = "SELECT Mot_Cle_Art FROM MOTCLE WHERE Id_Art=$this->id AND Mot_Cle_Art='".str_replace('\'', '\'\'', $mot_cle)."'";
        $mc = null;
        foreach ($db->query($sql) as $row){
            $mc = $row["Mot_Cle_Art"];
        }

        if($mc != null)
            return;

        array_push($this->mot_cle, $mot_cle);
        $sql = "INSERT INTO MOTCLE VALUES ($this->id,'".str_replace('\'', '\'\'', $mot_cle)."')";
        $db->exec($sql);
    }

    public function removeMotCle($mot_cle){
        include 'db/db.php';
        $newMotCle = array();
        foreach ($this->mot_cle as $mc){
            if(strcmp($mc, $mot_cle) !== 0){
                array_push($newMotCle, $mc);
            }
        }
        $this->mot_cle = $newMotCle;
        $sql = "DELETE FROM MOTCLE WHERE Id_Art=$this->id AND Mot_Cle_Art='".str_replace('\'', '\'\'', $mot_cle)."'";
        $db->exec($sql);
    }

    public function getTheme(){
        return $this->theme;
    }

    public function setTheme($theme){
        include 'db/db.php';
        $this->theme = $theme;
        //TODO Insertion dans la BDD
        $sql= "UPDATE MOTCLE SET Theme_Art='".str_replace('\'', '\'\'', $theme)."' WHERE Id_Art=$this->id";
        $db->exec($sql);
    }

    public function getAuteur(){
        return $this->auteur;
    }

    public function getDate(){
        return $this->date;
    }

    function getWriteAccessUser(){
        include 'db/db.php';
        $user = array();
        $sql = "SELECT Id_Cli FROM DROIT WHERE Id_Art=$this->id";
        foreach ($db->query($sql) as $row){
            array_push($user, $row["Id_Cli"]);
        }
        return $user;
    }

    function addWriteAccessUser($id){
        include 'db/db.php';
        $sql = "SELECT Id_Cli FROM DROIT WHERE Id_Art=$this->id AND Id_Cli=$id";
        $mc = null;
        foreach ($db->query($sql) as $row){
            $mc = $row["Id_Cli"];
        }

        if($mc != null)
            return;

        $sql = "INSERT INTO DROIT VALUE ($this->id,$id)";
        $db->exec($sql);
    }

    function removeWriteAccessUser($id){
        include 'db/db.php';
        $sql = "DELETE FROM DROIT WHERE Id_Art=$this->id AND Id_Cli=$id";
        $db->exec($sql);
    }

    static function getPosts(){
        include 'db/db.php';
        $sql = "SELECT Id_Art FROM `ARTICLE` ORDER BY `ARTICLE`.`Date_Art` DESC";
        $posts = array();
        foreach ($db->query($sql) as $row){
            array_push($posts, new Post($row["Id_Art"]));
        }
        return $posts;
    }

}