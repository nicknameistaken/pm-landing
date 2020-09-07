<?php
class mail{

    private $smtp_data = array(
        "host" =>  'ЗАПОЛНИТЬ', // SMTP сервер
        "debug" => 0,   // Уровень логирования (0 выкл, 1 - вывод ошибок, 2- полный лог)
        "debugoutput"=>  'html',    //формат вывода лога, если включено логирование
        "auth" =>  true,    // Авторизация на сервере SMTP. Если ее нет - false
        "port" =>  ЗАПОЛНИТЬ,   // Порт SMTP сервера
        "username" =>  'ЗАПОЛНИТЬ', // Логин на SMTP сервере
        "password" =>  'ЗАПОЛНИТЬ', // Пароль на SMTP сервере
        "fromname" =>  'ЗАПОЛНИТЬ', // Отображаемое имя отправителя
        "replyto" =>  array(
            "address" => 'ЗАПОЛНИТЬ',   // адрес почты для ответа
            "name" =>  'ЗАПОЛНИТЬ'  //отображаемое имя владельца ящика
        ),
        "notification" => array(
            "address" =>  'ЗАПОЛНИТЬ',  // Почта оповещения админа (не оповещать оставить пустым)
            "name" =>  'ЗАПОЛНИТЬ'  //отображаемое имя владельца ящика
        ),
        "secure" =>  'ЗАПОЛНИТЬ',   // Тип шифрования. Например ssl или tls
        "charset" =>  'UTF-8',  //кодировка отправляемых писем
        "verify" =>  '0'    // Верификация сертификата. 0 -выкл, 1 - вкл (выключить при возникновении ошибок связанных с SSL сертификатами при отправке)
    );

    private $mail_content = array(
        'title' =>  'ЗАПОЛНИТЬ',
        'header' =>  '',
        'footer' =>  ''
    );

    private function fullText($text)
    {
        if(!empty($text))
        {
            return $this-> mail_content['header'] . $text . $this->mail_content['footer'];
        }
        else
        {
            die("Отсутствует текст письма");
        }
    }

    public function send($message_data)
    {
        require_once('C:/..ПУТЬ../PHPMailer/PHPMailerAutoload.php');

        $mail = new PHPMailer;
        $mail-> isSMTP();
        if($this-> smtp_data['verify'] == 0) {
            $mail-> SMTPOptions = array('ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ));
        }

        $mail-> Host = $this-> smtp_data['host'];
        $mail-> SMTPDebug = $this -> smtp_data['debug'];
        $mail-> Debugoutput = $this-> smtp_data['debugoutput'];
        $mail-> SMTPAuth = $this-> smtp_data['auth'];
        $mail-> Port = $this-> smtp_data['port'];
        $mail-> Username = $this-> smtp_data['username'];
        $mail-> Password = $this-> smtp_data['password'];
        $mail-> SMTPSecure = $this-> smtp_data['secure'];
        $mail-> CharSet = $this-> smtp_data['charset'];
        $mail-> setFrom($this-> smtp_data['username'],
        $this-> smtp_data['fromname']);
        $mail-> addReplyTo($this-> smtp_data['replyto']['address'],
        $this-> smtp_data['replyto']['name']);

        if(!empty($this-> smtp_data['notification']['address'])) {
            $mail-> addAddress($this-> smtp_data['notification']['address'],
                               $this-> smtp_data['notification']['name']);
        }

        $mail-> addAddress($message_data['to'], $message_data['to_name']);
        $mail-> Subject = $this-> mail_content['title'];
        $mail-> msgHTML($this-> fullText($message_data['text']));
        $mail-> AltBody = strip_tags($this-> fullText($message_data['text']));

        if (!$mail-> send()) {
            die("Mailer Error: " . $mail-> ErrorInfo);
        } else {
            return 0;
        }
    }
}
