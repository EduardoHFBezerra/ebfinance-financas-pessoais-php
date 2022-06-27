<?php

class Conexao
{

    // Dados de conexão com o banco de dados
    private $servidor = "localhost";
    private $banco = "ebfinance";
    private $usuario = "root";
    private $senha = "nautico1901";
    public $conexao;

    // Conexão com o banco de dados
    public function con()
    {
        try {
            $this->conexao = new PDO("mysql:host=" . $this->servidor . ";dbname=" . $this->banco, $this->usuario, $this->senha);
            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro! " . $e->getMessage();
        }
        return $this->conexao;
    }
}