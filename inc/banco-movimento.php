<?php
// Retornar lista de movimentos do usuário
function listaMovimentos($conexao, $mes, $ano)
{
    $movimentosArr = array();
    $consulta = $conexao->prepare("SELECT * FROM movimento WHERE YEAR(data) = :ano AND MONTH(data) = :mes AND id_usuario_movimento = :id_usuario_movimento ORDER BY id_movimento DESC");
    $consulta->bindValue(":ano", $ano, PDO::PARAM_STR);
    $consulta->bindValue(":mes", $mes, PDO::PARAM_STR);
    $consulta->bindValue(":id_usuario_movimento", $_SESSION["id_usuario"], PDO::PARAM_INT);
    try {
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            while ($retorno = $consulta->fetch(PDO::FETCH_ASSOC)) {
                array_push($movimentosArr, $retorno);
            }
        }
        return $movimentosArr;
    } catch (PDOExecption $e) {
        return "Erro!: " . $e->getMessage();
    }
}

// Somar movimento do mês (receita ou despesa)
function somaMovimentoMes($conexao, $tipo, $mes, $ano)
{
    $consulta = $conexao->prepare("SELECT SUM(valor) AS total FROM movimento WHERE tipo = :tipo AND YEAR(data) = :ano AND MONTH(data) = :mes AND id_usuario_movimento = :id_usuario_movimento");
    $consulta->bindValue(":tipo", $tipo, PDO::PARAM_STR);
    $consulta->bindValue(":ano", $ano, PDO::PARAM_STR);
    $consulta->bindValue(":mes", $mes, PDO::PARAM_STR);
    $consulta->bindValue(":id_usuario_movimento", $_SESSION["id_usuario"], PDO::PARAM_INT);
    try {
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            $retorno = $consulta->fetch(PDO::FETCH_ASSOC);
            return $retorno["total"];
        }
    } catch (PDOExecption $e) {
        return "Erro!: " . $e->getMessage();
    }
}

// Somar movimento geral (receita ou despesa)
function somaMovimento($conexao, $tipo)
{
    $consulta = $conexao->prepare("SELECT SUM(valor) AS total FROM movimento WHERE tipo = :tipo AND id_usuario_movimento = :id_usuario_movimento");
    $consulta->bindValue(":tipo", $tipo, PDO::PARAM_STR);
    $consulta->bindValue(":id_usuario_movimento", $_SESSION["id_usuario"], PDO::PARAM_INT);
    try {
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            $retorno = $consulta->fetch(PDO::FETCH_ASSOC);
            return $retorno["total"];
        }
    } catch (PDOExecption $e) {
        return "Erro!: " . $e->getMessage();
    }
}

// Inserir novo movimento
function inserirMovimento($conexao, $descricao, $data, $tipo, $valor, $formaPagamento, $categoria)
{
    $inserir = $conexao->prepare("INSERT INTO movimento (descricao, data, tipo, valor, forma_pagamento, categoria, id_usuario_movimento) VALUES (:descricao, :data, :tipo, :valor, :forma_pagamento, :categoria, :id_usuario_movimento)");
    $inserir->bindValue(":descricao", $descricao, PDO::PARAM_STR);
    $inserir->bindValue(":data", $data, PDO::PARAM_STR);
    $inserir->bindValue(":tipo", $tipo, PDO::PARAM_STR);
    $inserir->bindValue(":valor", $valor, PDO::PARAM_STR);
    $inserir->bindValue(":forma_pagamento", $formaPagamento, PDO::PARAM_STR);
    $inserir->bindValue(":categoria", $categoria, PDO::PARAM_STR);
    $inserir->bindValue(":id_usuario_movimento", $_SESSION["id_usuario"], PDO::PARAM_INT);
    try {
        $inserir->execute();
        if ($conexao->lastInsertId() > 0) {
            return "Novo movimento inserido com sucesso";
        } else {
            return "Houve um erro ao tentar inserir um novo movimento, tente novamente";
        }
    } catch (PDOExecption $e) {
        return "Erro!: " . $e->getMessage();
    }
}

// Deletar movimento
function deletarMovimento($conexao, $id)
{
    $deletar = $conexao->prepare("DELETE FROM movimento WHERE id_movimento = :id_movimento AND id_usuario_movimento = :id_usuario_movimento");
    $deletar->bindValue(":id_movimento", $id, PDO::PARAM_INT);
    try {
        $deletar->execute();
        if ($deletar->rowCount() > 0) {
            return "Movimento deletado com sucesso";
        } else {
            return "Houve um erro ao tentar deletar o movimento, tente novamente";
        }
    } catch (PDOExecption $e) {
        return "Erro!: " . $e->getMessage();
    }
}