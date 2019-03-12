<?php

include 'Base.php';
include 'functions.php';

class ConfiguracaoAlerta extends Base
{
    public $id;
    public $site;
    public $dataHoraEnvio;
    
    public function __construct(){
        $this->tabela = "configuracao_alerta";
    }
    public function inserir($obj)
    {
    }
    
    public function atualizarData($obj)
    {
        $sql = "UPDATE ".$this->tabela."
			     SET data_hora_envio = '$obj->dataHoraEnvio'
                WHERE id = '$obj->id' ";
        return executarSql($sql);
    }

    public function listarConfiguracoesSite()
    {
        self::listarObjetos();
        
        $configuracoes = [];
        
        foreach ($this->array as $linha) {
            $alerta = new ConfiguracaoAlerta();
            $alerta->id             = $linha['id'];
            $alerta->site           = $linha['site'];
            $alerta->dataHoraEnvio  = $linha['data_hora_envio'];
            $configuracoes[] = $alerta;
        }
        return $configuracoes;
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
            $alerta->numeroEnvios = $linha['numero_envios'];
        }
        return $alerta;
    }

    public function editar($obj)
    {}

    public function listarPorId($id)
    {
        self::listarObjetosPorId($id);
        
        foreach ($this->array as $linha) {
            $alerta = new ConfiguracaoAlerta();
            $alerta->id             = $linha['id'];
            $alerta->site           = $linha['site'];
            $alerta->dataHoraEnvio  = $linha['data_hora_envio'];
        }
        return $alerta;
    }
    public function listar()
    {}

    
}