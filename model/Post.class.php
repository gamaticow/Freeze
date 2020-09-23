<?php

class Post {

    private $id;
    private $title;
    private $resume;
    private $content;
    private $mot_cle; //Tableau de mots clé
    private $auteur; //ID de l'auteur
    private $theme;

    function __construct(){
        $ctp = func_num_args();
        $args = func_get_args();

        switch ($ctp){
            case 7:
                $this->newInsert($args[0], $args[1], $args[2], $args[3], $args[4], $args[5], $args[6]);
                break;
            case 1:
                $this->newSelect($args[0]);
                break;
        }
    }

    private function newInsert($id, $title, $resume, $content, $auteur, $mot_cle, $theme){
        //TODO Insertion dans la BDD
        $this->id=$id;
        $this->title=$title;
        $this->resume=$resume;
        $this->content=$content;
        $this->auteur=$auteur;
        $this->mot_cle=$mot_cle;
        $this->theme=$theme;
        $sql= " INSERT INTO ARTICLE VALUES ('$id','$title','$resume','$content','$auteur','$mot_cle','$theme')";
    }

    private function newSelect($id){
        //TODO Remplir les attributs a partir d'un article de la bdd

    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
        //TODO Insertion dans la BDD
        $sql= "UPDATE ARTICLE SET Nom_Article = $title";
    }

    public function getResume(){
        return $this->resume;
    }

    public function setResume($resume){
        $this->resume = $resume;
        //TODO Insertion dans la BDD
        $sql= "UPDATE ARTICLE SET Resume_Art = $resume";

    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;
        //TODO Insertion dans la BDD
        $sql= "UPDATE ARTICLE SET Cont_Art = $content";
    }

    public function getMotCle(){
        return $this->mot_cle;
    }

    public function setMotCle($mot_cle){
        $this->mot_cle = $mot_cle;
        //TODO Insertion dans la BDD
        $sql= "UPDATE MOTCLE SET Mot_cle = $mot_cle";
    }

    public function getTheme(){
        return $this->theme;
    }

    public function setTheme($theme){
        $this->theme = $theme;
        //TODO Insertion dans la BDD
        $sql= "UPDATE MOTCLE SET Theme_Art = $theme";
    }

    public function getAuteur()
    {
        return $this->auteur;
    }

    function getWriteAccessUser(){

    }

    function addWriteAccessUser(){

    }

    function removeWriteAccessUser(){

    }

}