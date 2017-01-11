<?php
/**
 * Created by PhpStorm.
 * User: MIW
 * Date: 05/01/2017
 * Time: 14:22
 */

require_once "phpmailer/PHPMailerAutoload.php";

$bdd = new PDO('mysql:dbname=mailing;host=localhost','root','', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
$req = $bdd->query('SELECT * FROM mail');
$count = 0;
while($row = $req->fetch()){

    $mail = new PHPMailer;

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'auth.smtp.1and1.fr';                   // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'contact@adrienmi.com';             // SMTP username
    $mail->Password = 'lolilol vous pouvez rêver ;)';     // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    $mail->From = 'address@mail.com';
    $mail->FromName = 'Adrien MICHEL';
    $mail->addAddress($row['email'], $row['prenom'].$row['nom']);
    $mail->addReplyTo('address@mail.com', 'Adrien MICHEL');
    $mail->isHTML(true);
    $mail->Subject = 'Hello it\'s me';
    $mail->Body = '<b>Hello</b> How are you boy ? Hope you enjoy your day. Unsubscribe <a href="http://localhost/merde/unsubscribe.php?email='.$row['email'].'">here</a>.';
    $mail->AltBody = 'Hello if you can\'t see HTML on your mail server';


    if(!$mail->send()){
        echo 'Your mail can\'t be send.';
        usleep(300);
    }else{
        echo 'Great your mail has been send !';
    }

    if($count%5 == 0)
        usleep(300);

    $count++;
}
echo 'Mail sender';
