<?php
// Checar se o usuário informado já existe
function checaDuplicidadeUsuario($conexao, $usuario)
{
    $consulta = $conexao->prepare("SELECT id_usuario FROM usuario WHERE usuario = :usuario");
    $consulta->bindValue(":usuario", $usuario, PDO::PARAM_STR);
    try {
        $consulta->execute();
        return ($consulta->rowCount() > 0) ? true : false;
    } catch (PDOExecption $e) {
        return "Erro!: " . $e->getMessage();
    }
}

// Login
function login($conexao, $usuario, $senha)
{
    $usuarioArr = array(); // Array para alocar os dados do usuário
    $consulta = $conexao->prepare("SELECT * FROM usuario WHERE usuario = :usuario AND senha = :senha");
    $consulta->bindValue(":usuario", $usuario, PDO::PARAM_STR);
    $consulta->bindValue(":senha", $senha, PDO::PARAM_STR);
    try {
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            while ($retorno = $consulta->fetch(PDO::FETCH_ASSOC)) {
                array_push($usuarioArr, $retorno);
            }
        }
        return $usuarioArr;
    } catch (PDOExecption $e) {
        return "Erro!: " . $e->getMessage();
    }
}

// Inserir novo usuário
function inserirUsuario($conexao, $nome, $usuario, $senha)
{
    // Verificar se usuário não existe antes de inserí-lo
    if (!checaDuplicidadeUsuario($conexao, $usuario)) {
        $inserir = $conexao->prepare("INSERT INTO usuario (nome, usuario, senha) VALUES (:nome, :usuario, :senha)");
        $inserir->bindValue(":nome", $nome, PDO::PARAM_STR);
        $inserir->bindValue(":usuario", $usuario, PDO::PARAM_STR);
        $inserir->bindValue(":senha", $senha, PDO::PARAM_STR);
        try {
            $inserir->execute();
            if ($conexao->lastInsertId() > 0) {
                return "Usuário inserido com sucesso! você já pode logar no sistema";
            } else {
                return "Houve um erro ao tentar inserir um novo usuário, tente novamente";
            }
        } catch (PDOExecption $e) {
            return "Erro!: " . $e->getMessage();
        }
    } else {
        return "Este nome de usuário já existe! Escolha outro";
    }
}

// Retornar lista de pagamentos do usuário
function listaPagamentos($conexao)
{
    $consulta = $conexao->prepare("SELECT formas_pagamento FROM usuario WHERE id_usuario = :id_usuario");
    $consulta->bindValue(":id_usuario", $_SESSION["id_usuario"], PDO::PARAM_INT);
    try {
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            $retorno = $consulta->fetch(PDO::FETCH_ASSOC);
            return json_decode($retorno["formas_pagamento"], true);
        }
    } catch (PDOExecption $e) {
        return "Erro!: " . $e->getMessage();
    }
}

// Adicionar nova forma de pagamento
function adicionarPagamento($conexao, $pagamento)
{
    $listaPagamentos = listaPagamentos($conexao); // Lista de pagamentos
    $prossegue = true;
    foreach ($listaPagamentos as $chave => $item) {
        // Checar se a forma de pagamento já existe dentro da lista
        if ($item["pagamento"] == $pagamento) {
            return "A forma de pagamento informada já existe, tente adicionar novamente";
            $prossegue = false;
        }
    }
    if ($prossegue) {
        // Puxar o novo pagamento para dentro da lista de pagamentos
        array_push($listaPagamentos, array(
            "pagamento" => $pagamento
        ));
        // Converter os pagamentos para string e codificar caracteres Unicode
        $pagamentos = json_encode($listaPagamentos, JSON_UNESCAPED_UNICODE);
        $adicionar = $conexao->prepare("UPDATE usuario SET formas_pagamento = :formas_pagamento WHERE id_usuario = :id_usuario");
        $adicionar->bindValue(":formas_pagamento", $pagamentos, PDO::PARAM_STR);
        $adicionar->bindValue(":id_usuario", $_SESSION["id_usuario"], PDO::PARAM_INT);
        try {
            $adicionar->execute();
            if ($adicionar->rowCount() > 0) {
                return "Pagamento adicionado com sucesso";
            } else {
                return "Houve um erro ao tentar adicionar o pagamento, tente novamente";
            }
        } catch (PDOExecption $e) {
            return "Erro!: " . $e->getMessage();
        }
    }
}

// Remover forma de pagamento
function removerPagamento($conexao, $pagamento)
{
    $listaPagamentos = listaPagamentos($conexao);
    foreach ($listaPagamentos as $chave => $item) {
        // Verificar se é o pagamento informado
        if ($item["pagamento"] == $pagamento) {
            // Remover da lista caso seja o pagamento informado
            unset($listaPagamentos[$chave]);
        }
    }
    // Converter os pagamentos para string, realocar numa Array, e codificar caracteres Unicode
    $pagamentos = json_encode(array_values($listaPagamentos), JSON_UNESCAPED_UNICODE);
    $remover = $conexao->prepare("UPDATE usuario SET formas_pagamento = :formas_pagamento WHERE id_usuario = :id_usuario");
    $remover->bindValue(":formas_pagamento", $pagamentos, PDO::PARAM_STR);
    $remover->bindValue(":id_usuario", $_SESSION["id_usuario"], PDO::PARAM_INT);
    try {
        $remover->execute();
        if ($remover->rowCount() > 0) {
            return "Pagamento removido com sucesso";
        } else {
            return "Houve um erro ao tentar remover o pagamento, tente novamente";
        }
    } catch (PDOExecption $e) {
        return "Erro!: " . $e->getMessage();
    }
}

// Retornar lista de categorias do usuário
function listaCategorias($conexao)
{
    $consulta = $conexao->prepare("SELECT categorias FROM usuario WHERE id_usuario = :id_usuario");
    $consulta->bindValue(":id_usuario", $_SESSION["id_usuario"], PDO::PARAM_INT);
    try {
        $consulta->execute();
        if ($consulta->rowCount() > 0) {
            $retorno = $consulta->fetch(PDO::FETCH_ASSOC);
            return json_decode($retorno["categorias"], true);
        }
    } catch (PDOExecption $e) {
        return "Erro!: " . $e->getMessage();
    }
}

// Adicionar nova categoria
function adicionarCategoria($conexao, $categoria, $tipo)
{
    $listaCategorias = listaCategorias($conexao); // Lista de categorias
    $prossegue = true;
    foreach ($listaCategorias as $chave => $item) {
        // Checar se a categoria já existe dentro da lista
        if ($tipo == $item["tipo"] && $item["categoria"] == $categoria) {
            return "A categoria informada já existe, tente adicionar novamente";
            $prossegue = false;
        }
    }
    if ($prossegue) {
        // Puxar a nova categoria para dentro da lista de categorias
        array_push($listaCategorias, array(
            "tipo" => $tipo,
            "categoria" => $categoria
        ));
        // Converter as categorias para string e codificar caracteres Unicode
        $categorias = json_encode($listaCategorias, JSON_UNESCAPED_UNICODE);
        $adicionar = $conexao->prepare("UPDATE usuario SET categorias = :categorias WHERE id_usuario = :id_usuario");
        $adicionar->bindValue(":categorias", $categorias, PDO::PARAM_STR);
        $adicionar->bindValue(":id_usuario", $_SESSION["id_usuario"], PDO::PARAM_INT);
        try {
            $adicionar->execute();
            if ($adicionar->rowCount() > 0) {
                return "Categoria adicionada com sucesso";
            } else {
                return "Houve um erro ao tentar adicionar a categoria, tente novamente";
            }
        } catch (PDOExecption $e) {
            return "Erro!: " . $e->getMessage();
        }
    }
}

// Remover categoria
function removerCategoria($conexao, $categoria, $tipo)
{
    $listaCategorias = listaCategorias($conexao);
    foreach ($listaCategorias as $chave => $item) {
        // Verificar se é a categoria informada
        if ($tipo == $item["tipo"] && $item["categoria"] == $categoria) {
            // Remover da lista caso seja a categoria informada
            unset($listaCategorias[$chave]);
        }
    }
    // Converter as categorias para string, realocar numa Array, e codificar caracteres Unicode
    $categorias = json_encode(array_values($listaCategorias), JSON_UNESCAPED_UNICODE);
    $remover = $conexao->prepare("UPDATE usuario SET categorias = :categorias WHERE id_usuario = :id_usuario");
    $remover->bindValue(":categorias", $categorias, PDO::PARAM_STR);
    $remover->bindValue(":id_usuario", $_SESSION["id_usuario"], PDO::PARAM_INT);
    try {
        $remover->execute();
        if ($remover->rowCount() > 0) {
            return "Categoria removida com sucesso";
        } else {
            return "Houve um erro ao tentar remover a categoria, tente novamente";
        }
    } catch (PDOExecption $e) {
        return "Erro!: " . $e->getMessage();
    }
}
