<?php
$msgs = [];
  if (isset($_POST['name']) ) {
        if(empty($_POST['name']) && NAMEISREQUIRED) {
            $msgs['name'] = MSGSNAMEERROR;
        } else {
            if (!empty($_POST['name'])) {
                $name = "<b>Имя: </b>" . trim(strip_tags($_POST['name'])) . "<br>";
            }

        }
    }

    if (isset($_POST['tel']) ) {
        if(empty($_POST['tel']) && TELISREQUIRED) {
            $msgs['tel'] = MSGSTELERROR;
        } else {
            if (!empty($_POST['tel'])) {
                $tel = "<b>Телефон: </b> " . trim(strip_tags($_POST['tel'])) . "<br>";
            }
        }
    }

    if (isset($_POST['email']) ) {
        if(empty($_POST['email']) && EMAILISREQUIRED) {
            $msgs['email'] = MSGSEMAILERROR;
        } else {
            if(!empty($_POST['email'])) {
                if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $email = "<b>Почта: </b> " . trim(strip_tags($_POST['email'])) . "<br>";
                } else {
                    $msgs['email'] = MSGSEMAILINCORRECT;
                }
            }
        }
    }

    if (isset($_POST['messenger']) ) {
        if (!empty($_POST['messenger'])) {
            $messenger = "<b>Ответить в whatsapp/telegram: </b> " . trim(strip_tags($_POST['messenger'])) . "<br>";
        }
    }

    if ($msgs) {
      echo json_encode($msgs);
      die;
    } else {
      $msgs['success'] = MSGSSUCCESS;
    }
    ?>
