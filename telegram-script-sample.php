<?php


// заполнить и сохранить как файл telegram-script.php (без -sample)

// токен бота
define('TELEGRAM_TOKEN', '<TOKEN>');

// ID получателя в Telegram
define('TELEGRAM_CHATID', '<CHAT ID>');

// собирается текст для письма
try {
    $text = sprintf("Пришла заявка от пользователя %s. Связь с пользователем через %s по контакту %s.", $_POST['name'], $_POST['connectionType'], $_POST['connectionTypeValue']);
    if ($_POST['description']) {
        $text = $text.sprintf("\nОписание работы: %s", $_POST['description']);
    }
    message_to_telegram($text);
    echo 0;
} catch (Exception $e) {
    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}

exit();

function message_to_telegram($text)
{
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => TELEGRAM_CHATID,
                'text' => $text,
            ),
        )
    );
    curl_exec($ch);
}
?>
