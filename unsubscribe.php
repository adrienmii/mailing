<?php

$bdd = new PDO('mysql:dbname=mailing;host=localhost','root','', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));


if(isset($_GET['email'])) {
    $req = $bdd->prepare('DELETE FROM mail WHERE userEmail = :email');
    $req->bindValue(':email', $_GET['email'], PDO::PARAM_STR);
    $req->execute();
}
