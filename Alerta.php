<?php

class Alternativa extends Base
{
    public $id;
    public $descricao;
    public $mensagem;
    public $dataEnvio;
    
    public function __construct(){
        $this->tabela = "alerta";
    }
    public function inserir($obj)
    {
        
        $sql = "INSERT INTO ".$this->tabela." (id, descricao, mensagem, data_envio)
				             VALUES (null, '$obj->descricao', '$obj->mensagem',now())";
        
        return executarSql($sql);
        
    }
    
    public function atualizarDataEnvio($obj)
    {
        $sql = "UPDATE ".$this->tabela."
			     SET data_envio      = '$obj->dataEnvio'
                WHERE id = '$obj->id' ";
        return executarSql($sql);
    }

    public function listar()
    {}

    public function editar($obj)
    {}

    public function listarPorId($id)
    {}
    
}