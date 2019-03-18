<?php
    
// Quando precisar mudar de grupo, olhar isso
//https://github.com/pluginsGLPI/telegrambot/issues/18
//https://api.telegram.org/bot632066585:AAGx-dsUR2cae1CPWxfpZNEKaFAVntRP_Fg/getUpdates/

define('CHAT_ID', '-362312713');
define('TOKEN_TELEGRAM', '632066585:AAGx-dsUR2cae1CPWxfpZNEKaFAVntRP_Fg');
define('URL_TELEGRAM', 'https://api.telegram.org/bot');
define('URL_CHAT_ID', 'https://api.telegram.org/bot632066585:AAGx-dsUR2cae1CPWxfpZNEKaFAVntRP_Fg/getUpdates');

    class Telegram
    {
        public function enviaAlerta($mensagem, $chat_id) {
            $url = URL_TELEGRAM . TOKEN_TELEGRAM . "/sendMessage?parse_mode=html&chat_id=" . $chat_id . "&text=" . $mensagem;
            file_get_contents($url);
        }

    }
    