<?php
#######################################################################
## PARAMENTROS INTERNOS DO SISTEMA
#######################################################################
define('NOME_SISTEMA', 'Monitoramento');
define('SIGLA_SISTEMA', 'Monitor');
define('AMBIENTE','DEV');

########################################################################
## PARAMETROS TELEGRAM
########################################################################

// Quando precisar mudar de grupo, olhar isso
//https://github.com/pluginsGLPI/telegrambot/issues/18
//https://api.telegram.org/bot632066585:AAGx-dsUR2cae1CPWxfpZNEKaFAVntRP_Fg/getUpdates/

define('CHAT_ID', '-362312713');
define('TOKEN_TELEGRAM', '632066585:AAGx-dsUR2cae1CPWxfpZNEKaFAVntRP_Fg');
define('URL_TELEGRAM', 'https://api.telegram.org/bot');

########################################################################
## PARAMENTROS DO BANCO DE DADOS
########################################################################

$ip = getenv("REMOTE_ADDR");
if($ip == '127.0.0.1' && AMBIENTE == "DEV") {
    define('HOST', 'localhost');
    define('DBNAME', 'e2f10');
    define('CHARSET', 'utf8');
    define('USER', 'root');
    define('PASSWORD', '');
} else {
    define('HOST', 'mysql.e2f.com.br');
    define('DBNAME', 'e2f10');
    define('CHARSET', 'utf8');
    define('USER', 'e2f10');
    define('PASSWORD', 'e2f12345678');
}


?>
