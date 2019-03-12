<?php
    
    class Telegram
    {
        public function enviaAlerta($mensagem, $chat_id) {
            $url = URL_TELEGRAM . TOKEN_TELEGRAM . "/sendMessage?parse_mode=html&chat_id=" . $chat_id . "&text=" . $mensagem;
            file_get_contents($url);
        }
    }
    