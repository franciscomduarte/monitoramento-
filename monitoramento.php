<?php 

include 'Telegram.php';
include 'Alerta.php';
include 'conexao.php';


function pingAddress($ip) {
    $pingresult = exec("ping  -n 3 $ip", $outcome, $status);
    return $status;
}


$url = 'https://api.telegram.org/bot632066585:AAGx-dsUR2cae1CPWxfpZNEKaFAVntRP_Fg/getUpdates';
$ch = curl_init($url);
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

$telegram = new Telegram();
$status = pingAddress("www.escolavirtual.gov.br");
if($status != 0) {
    $telegram->enviaAlerta("ALERTA! A EVG fora do ar!", $id_chat);
}

$statusMooc = pingAddress("mooc.escolavirtual.gov.br");
if($statusMooc != 0) {
    $telegram->enviaAlerta("ALERTA! O Mooc fora do ar! <a href='www.goggle.com'>Clique aqui</a>", $id_chat);
}
?>