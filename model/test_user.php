<?php

include 'User.class.php';

echo ('Test de connexion<br>');

if(User::connect("Corentin", "wesh") != null){
    echo ('Test OK<br>');
}else{
    echo ('Test KO<br>');
}

if(User::connect("Corentin", "wes") == null){
    echo ('Test OK<br>');
}else{
    echo ('Test KO<br>');
}

if(User::connect("Alexandre", "wesh") == null){
    echo ('Test OK<br>');
}else{
    echo ('Test KO<br>');
}

echo ('Test de inscription<br>');

if(User::register("Corentin", "grze") == null){
    echo ('Test OK<br>');
}else{
    echo ('Test KO<br>');
}

if(User::register("Alexandre", "Cheh") != null){
    echo ('Test OK<br>');
}else{
    echo ('Test KO<br>');
}

if(User::connect("Alexandre", "Cheh") != null){
    echo ('Test OK<br>');
}else{
    echo ('Test KO<br>');
}