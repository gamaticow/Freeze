<?php

class Post {

    private $title;
    private $resume;
    private $content;
    private $mot_cle; //Tableau de mots clé
    private $auteur; //ID de l'auteur
    private $theme;

    function __construct($title, $resume, $content, $auteur, $mot_cle, $theme){
        //TODO Insertion dans la BDD
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title){
        $this->title = $title;
        //TODO Insertion dans la BDD
    }

    public function getResume(){
        return $this->resume;
    }

    public function setResume($resume){
        $this->resume = $resume;
        //TODO Insertion dans la BDD
    }

    public function getContent(){
        return $this->content;
    }

    public function setContent($content){
        $this->content = $content;
        //TODO Insertion dans la BDD
    }

    public function getMotCle(){
        return $this->mot_cle;
    }

    public function setMotCle($mot_cle){
        $this->mot_cle = $mot_cle;
        //TODO Insertion dans la BDD
    }

    public function getTheme(){
        return $this->theme;
    }

    public function setTheme($theme){
        $this->theme = $theme;
        //TODO Insertion dans la BDD
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