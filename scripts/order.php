<?php
/**
 * This example shows making an SMTP connection with authentication.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
//date_default_timezone_set('Etc/UTC');

require 'PHPMailer/PHPMailerAutoload.php';

if (!isset($_POST['name']) || !isset($_POST['phone']) || !isset($_POST['type'])) {
    http_response_code(500);
    exit;
}

$type  = filter_var($_POST['type'], FILTER_SANITIZE_STRING);
$name  = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);

send_consul($type, $name, $phone);

function send_consul($type, $name, $phone) {

    if(!in_array($type, ['consultation', 'metering', 'sale'])) {
        http_response_code(500);
        exit;
    }

    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->SMTPDebug = 0;
    $mail->Host = 'smtp.yandex.ru';
    $mail->Port = 465;
    $mail->SMTPAuth = true;
    $mail->Username = "zakaz@doorsmount.ru";
    $mail->Password = "DveRi713zkz$";
    $mail->setFrom('zakaz@doorsmount.ru');
    // $mail->addAddress('order@avangardsafe.ru', '');
    $mail->addAddress('order@avangardsafe.ru', '');
    $mail->CharSet = 'UTF-8';
    $mail->SMTPSecure = 'ssl';

    if($type === 'consultation') {
        $mail->Subject = 'Заказ консультации';
        $mail->msgHTML("<div>Имя: $name </div>\n<div>Телефон: $phone</div>");
        $mail->AltBody = "Имя: $name <br/>\nТелефон: $phone";
    } elseif ($type === 'sale') {
        $mail->Subject = 'Заказ скидки';
        $mail->msgHTML("<div>Имя: $name </div>\n<div>Телефон: $phone</div>");
        $mail->AltBody = "Имя: $name <br/>\nТелефон: $phone";
    } else {
        $mail->Subject = 'Заявка на замер';
        $mail->msgHTML("<div>Телефон: $phone</div>");
        $mail->AltBody = "Телефон: $phone";
    }

    if (!$mail->send()) {
        http_response_code(500);
        echo 'asdfasdf';
        exit;
    }
}