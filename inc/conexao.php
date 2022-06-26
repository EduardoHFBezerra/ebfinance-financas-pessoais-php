<?php
try {
    $conexao = new PDO("mysql:host=localhost;dbname=ebfinance", "root", "nautico1901");
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();
}