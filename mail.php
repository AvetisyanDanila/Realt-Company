<?php 
require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$name = $_POST['user_name'];
$phone = $_POST['user_phone'];
$time = $_POST['user_settime'];

$mail->isSMTP();
$mail->Host = 'smtp.mail.ru';  																							// Specify main and backup SMTP servers
$mail->SMTPAuth = true;
$mail->Username = 'for-praktika@mail.ru'; // Логин от почты с которой будут отправляться письма
$mail->Password = '#2praktika#2'; // Пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';
$mail->Port = 465; // Этот порт может отличаться у других провайдеров

$mail->setFrom('for-praktika@mail.ru'); // От кого будет уходить письмо?
$mail->addAddress('for-praktika@mail.ru');     // Кому будет отправляться письмо?

$mail->isHTML(true);

$mail->Subject = 'Заявка с сайта Realt Company';
$mail->Body    = '' .$name . ' оставил заявку, его телефон ' .$phone. '<br>Удобное время: ' .$time;
$mail->AltBody = '';

if(!$mail->send()) {
    echo 'При отправке сообщения произошла ошибка, попробуйте ещё раз или напишите владельцу сайта.';
} else {
    header('location: thank-you.html');
}
?>