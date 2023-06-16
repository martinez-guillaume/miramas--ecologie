<?php

// use PHPMailer\PHPMailer\PHPMailer;

// function envoie_mail($from_name,$from_email,$subject,$message){
//    $mail = new PHPMailer();//on creer un objet phpmailer pour utiliser ses attributs et methodes
//    $mail->isSMTP();
//    $mail->SMTPDebug = 0;
//    $mail->SMTPSecure = 'ssl';
//    $mail->Host = 'smtp.gmail.com';//le serveur smtp de gmail
//    $mail->SMTPAuth = true;
//    $mail->Username = "support@miramas-écologie.fr";//mail->permet d'acceder a l'attribut username de l'objet creer ( c'est le mail qui vas nous aider a envoyer des mail)
//    $mail->Password = "Helloworld"; //mot de passe pour passer la double authentification
//    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;//permet de crypter le message
//    $mail->Port = 465;// le port

//    $mail->setFrom($from_email, $from_name);//le message est envoyer par $from_email, et son nom $from_name
//    $mail->addAddress('guillaume.m.developer@gmail.com','GuillaumeTech');//le recepteur , le nom (facultatif)
//    $mail->isHTML(true);// le message peut etre au format html
//    $mail->Subject = $subject;
//    $mail->Body = $message;
//    $mail->setLanguage('fr', '/optional/path/to/language/directory/');//pour charger la version francaise

//    //pour envoyer le message on va utiliser la methode send
//    $mail->send();//il renvoie true si c'est envoyer et false sinon

//    if (!$mail->send()) {
//       # code...
//       //!true il va retourner false
//       return false;
//    }else{
// //sinon true
// return true;
//    }
// }

// if (envoie_mail($_POST['email'],$_POST['subject'],$_POST['name'],$_POST['message'])){
//      echo 'ok';
//      //si envoie email renvoi true
// }else{
//    //sinon ecrire une erreur
//    echo "une erreur s'est produite";
// } 
