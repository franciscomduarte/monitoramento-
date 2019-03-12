<?php

abstract class Base
{
    
    protected $tabela;
    protected $tabela_relacionada;
    protected $array;
    protected $chave;
    
    public abstract function inserir($obj);
    
    public abstract function editar($obj);
    
    public abstract function listar();
    
    public abstract function listarPorId($id);
    
    public function __get($valor){
        return $this->$valor;
    }
    
    public function __set($propriedade,$valor){
        $this->$propriedade = $valor;
    }
    
    public function retornaIdInserido() {
        return retornaId();
    }
    
    public function deletar($id){
        $sql = "DELETE FROM ".$this->tabela." WHERE id = $id";
        return executarSql($sql);
    }

    public function desativar($id){
        $sql = "UPDATE ".$this->tabela." set ativo = 0 WHERE id = $id ";
        
        return executarSql($sql);
    }
    
    public function desativarComChave($chave){
        $sql = "UPDATE ".$this->tabela." set ativo = 0 WHERE chave = '$chave' ";
        
        return executarSql($sql);
    }
    
    public function listarObjetos(){
        $sql   = "SELECT * FROM ".$this->tabela." WHERE 1=1 order by 2";
        $query = executarSql($sql);
        $this->array = $query->fetch_all(MYSQLI_ASSOC);
    }
    
    public function listarObjetosAtivos(){
        $sql   = "SELECT * FROM ".$this->tabela." WHERE 1=1 and ativo = 1 order by 2";
        $query = executarSql($sql);
        $this->array = $query->fetch_all(MYSQLI_ASSOC);
    }
    
    public function listarObjetosPorId($id){
        $sql = "SELECT * FROM ".$this->tabela." WHERE 1=1 AND id = $id order by 2";
        $query = executarSql($sql);
        $this->array = $query->fetch_all(MYSQLI_ASSOC);
    }

    public function listarObjetosPorChave($chave){
        $sql = "SELECT * FROM ".$this->tabela." WHERE 1=1 AND chave = '$chave' order by 2";
        $query = executarSql($sql);
        $this->array = $query->fetch_all(MYSQLI_ASSOC);
    }
    
    public function gerarChave(){
        return md5(time()."$%&".microtime());
    }
}

