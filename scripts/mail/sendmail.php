<?php
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $details = $_POST['details'];

    require_once('mail.class.php'); //подключим настройки phpmailer, этот файл мы создадим на 5 шаге

    $message_data = array(
       'to'      =>  'почта@приема.заявок',
       'to_name' =>  'Новая заявка от '.$name,
       'text'    =>  $name.', '.$email.', '.$phone.','.$details
    );

    $mailer = new mail; //класс из файла mail.class.php который мы подключили выше

    $sendmail = $mailer->send($message_data);

    $answer = 'EMPTY';

    if ($sendmail == 0)
    {
        $answer = 'Заявка оставлена!';
    } else {
        $answer = 'Ошибка! Письмо не было отправлено.';
    }

    echo $answer;
?>
