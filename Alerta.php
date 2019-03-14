<?php

include 'Base.php';
include 'functions.php';

class Alerta extends Base
{
    public $id;
    public $status;
    public $site;
    public $mensagem;
    public $dataEnvio;
    public $numeroEnvios;
    
    public function __construct(){
        $this->tabela = "alerta";
    }
    public function inserir($obj)
    {
        
        echo $sql = "INSERT INTO ".$this->tabela." (id, status, site, mensagem, data_envio)
				             VALUES (null, '$obj->status', '$obj->site', '$obj->mensagem', now())";
        
        return executarSql($sql);
        
    }
    
    public function atualizarStatus($obj)
    {
        $sql = "UPDATE ".$this->tabela."
			     SET status      = 1
                WHERE id = '$obj->id' ";
        return executarSql($sql);
    }
    
    public function listarConfiguracoesSite()
    {
        echo $sql   = "SELECT * FROM configuracao_alerta WHERE 1=1";
        $query = executarSql($sql);
        return $query->fetch_all(MYSQLI_ASSOC);
    }

    public function listarAtivos($site)
    {
        $sql = "SELECT * FROM alerta WHERE 1=1 and status = 0 and site = '$site'";
        $query = executarSql($sql);
        
        $array = $query->fetch_all(MYSQLI_ASSOC);
        $alerta = null;
        foreach ($array as $linha) {
            $alerta = new Alerta();
            $alerta->id         = $linha['id'];
            $alerta->status     = $linha['status'];
            $alerta->site       = $linha['site'];
            $alerta->mensagem   = $linha['mensagem'];
            $alerta->data_envio = $linha['data_envio'];
        }
        return $alerta;
    }
    
    public function listarPorSiteAtivo($site)
    {
        $sql = "SELECT * FROM alerta WHERE 1=1 and site = '. $site .' and status = 0 limit 1";
        $query = executarSql($sql);
        
        $array = $query->fetch_all(MYSQLI_ASSOC);
        
        foreach ($array as $linha) {
            $alerta = new Alerta();
            $alerta->id         = $linha['id'];
            $alerta->status     = $linha['status'];
            $alerta->site       = $linha['site'];
            $alerta->mensagem   = $linha['mensagem'];
            $alerta->data_envio = $linha['data_envio'];
        }
        return $alerta;
    }

    public function editar($obj)
    {
        $sql = "UPDATE ".$this->tabela."
			     SET status      = 0, numero_envios = '$obj->numeroEnvios'
                WHERE id = '$obj->id' ";
        return executarSql($sql);
    }
    
    public function getIdChat(){
        $sql = "SELECT * FROM configuracao_sistema WHERE 1=1 and descricao = 'telegram_chat_id'";
        $query = executarSql($sql);
        return $query->fetch_assoc();
    }

    public function listarPorId($id)
    {}
    public function listar()
    {}

    
}