<?php 

date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ALL);

include 'Telegram.php';
include 'Alerta.php';
include 'conexao.php';


echo "INICIO DO ALERTA";
echo "<br>";
$alerta = new Alerta();
$sites_monitorados = $alerta->listarConfiguracoesSite();
echo "<br>";
echo "aaaaa";
echo date('Y-m-d H:i');

echo "<br>";

foreach ($sites_monitorados as $site) {
    $status = pingAddress($site['site']);
    
    echo $site['data_hora_envio'];
    
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
    $ch = curl_init("https://api.telegram.org/bot632066585:AAGx-dsUR2cae1CPWxfpZNEKaFAVntRP_Fg/getUpdates");
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $data = json_decode(curl_exec($ch),true); 	// <== Aqui
    
    if(($data['result'])[0] != null) {
        $resultado = ($data['result'])[0];
        $mensagem = $resultado['message'];
        $chat = $mensagem['chat'];
        $id_chat = $chat['id'];
    } else {
        $alerta = new Alerta();
        $id_chat = ($alerta->getIdChat())['valor'];
    }
    
    curl_close($ch);
    return $id_chat;
}

?>