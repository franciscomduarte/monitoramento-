<?php 

    include 'ConfiguracaoAlerta.php';
    include 'conexao.php';
    
    $id = $_REQUEST['id_configuracao'];
    $configuracaoAlerta = new ConfiguracaoAlerta();
    
    $configuracaoAlerta = $configuracaoAlerta->listarPorId($id);
    
    echo $configuracaoAlerta->dataHoraEnvio;
    $configuracaoAlerta->dataHoraEnvio = date('Y-m-d H:i', strtotime("$configuracaoAlerta->dataHoraEnvio + 30 minutes"));
   
    $configuracaoAlerta->atualizarData($configuracaoAlerta);
    

?>