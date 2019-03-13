<?php 

include 'Telegram.php';
include 'Alerta.php';
include 'conexao.php';

date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ALL);

$alerta = new Alerta();
$sites_monitorados = $alerta->listarConfiguracoesSite();

foreach ($sites_monitorados as $site) {
    $status = pingAddress($site['site']);
    if($status != 0 && $site['data_hora_envio'] < date('Y-m-d H:i')) {
        $alerta = new Alerta();
        $alerta->mensagem = "Alerta! " . $site['site'] . " fora do ar.";
        $alerta->site = $site['site'];
        $alerta->dataEnvio =  date('Y-m-d H:i');
        $alerta->status = 0;
        $alerta->inserir($alerta);
    }
}

// Lógica para enviar a mensagem
$id_chat = getIdTelegramChat();

$dados = $alerta->listarAtivos($site['site']);

if($dados) {
    $telegram = new Telegram();
    $telegram->enviaAlerta("ALERTA! " . $dados->site . " fora do ar! <a href='http://monitoramento.e2f.com.br/desativarAlerta.php?id_configuracao=1'> Clique aqui para desativar o alerta por 30 minutos </a>", $id_chat);
    $alerta->atualizarStatus($dados);
}

function pingAddress($ip) {
    $pingresult = exec("ping  -n 3 $ip", $outcome, $status);
    return $status;
}

function getIdTelegramChat() {
    $ch = curl_init(URL_CHAT_ID);
    curl_setopt($ch, CURLOPT_USERPWD, 'usuario:senha');
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $data = json_decode(curl_exec($ch),true); 	// <== Aqui
    
    curl_close($ch);
    
    $resultado = ($data['result'])[0];
    $mensagem = $resultado['message'];
    $chat = $mensagem['chat'];
    $id_chat = $chat['id'];
    return $id_chat;
}

?>