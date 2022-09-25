<?php
session_start();
require_once("autoload.php");

require_once("inc/funcoes.php");

require_once("inc/cabecalho.php");

// Data e hora atual
$dataAtual = new DateTime();
$mes = isset($_GET["mes"]) ? $_GET["mes"] : $dataAtual->format("m");
$ano = isset($_GET["ano"]) ? $_GET["ano"] : $dataAtual->format("Y");

// Instância de usuário
$usu = new Usuario();
// Instância de movimento
$mov = new Movimento();
?>

<div class="row">
    <!-- Dropdown ano -->
    <div class="two wide column">
        <select class="ui compact selection dropdown" onchange="location.replace('?mes=<?php echo $mes ?>&ano='+this.value)">
            <?php
            $anoAtual = $dataAtual->format("Y");
            for ($i = $anoAtual - 12; $i <= $anoAtual; $i++) {
            ?>
                <option value="<?php echo $i ?>" <?php if ($i == $ano) echo "selected=selected" ?>><?php echo $i ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <!-- Dropdown ano -->

    <!-- Menu de meses -->
    <div class="fourteen wide column">
        <div class="ui large twelve item stackable black secondary pointing menu">
            <?php
            $meses = mesExtenso();
            $contadorMes = 0;
            foreach ($meses as $mesExtenso) {
                $contadorMes++;
            ?>
                <a class="item<?php if ($mes == $contadorMes) echo " active"; ?>" href="?mes=<?php echo $contadorMes ?>&ano=<?php echo $ano; ?>"><?php echo $mesExtenso; ?></a>
            <?php
            }
            ?>
        </div>
    </div>
    <!-- Menu de meses -->
</div>
<div class="row">
    <div class="right aligned column">
        <?php echo "Seja bem vindo, " . $_SESSION["nome"] . "!"; ?>
    </div>
</div>
<div class="row">
    <div class="four wide column">
        <div class="ui green top attached center aligned segment">
            <div class="ui tiny horizontal statistic">
                <?php
                    $receitaMes = $mov->calculaMovimentosMes("receita", $mes, $ano);
                ?>
                <div class="value"><?php echo formataDinheiro($receitaMes); ?></div>
            </div>
        </div>
        <div class="ui green bottom attached segment">
            <div class="ui grid">
                <div class="thirteen wide column">Receitas do mês</div>
                <div class="three wide column"><i class="large green icon arrow alternate circle up outline"></i></div>
            </div>
        </div>
    </div>
    <div class="four wide column">
        <div class="ui red top attached center aligned segment">
            <div class="ui tiny horizontal statistic">
                <?php
                    $despesaMes = $mov->calculaMovimentosMes("despesa", $mes, $ano);
                ?>
                <div class="value"><?php echo formataDinheiro($despesaMes); ?></div>
            </div>
        </div>
        <div class="ui red bottom attached segment">
            <div class="ui grid">
                <div class="thirteen wide column">Despesas do mês</div>
                <div class="three wide column"><i class="large red icon arrow alternate circle down outline"></i></div>
            </div>
        </div>
    </div>
    <div class="four wide column">
        <div class="ui teal top attached center aligned segment">
            <div class="ui tiny horizontal statistic">
                <div class="value"><?php echo formataDinheiro($receitaMes-$despesaMes); ?></div>
            </div>
        </div>
        <div class="ui teal bottom attached segment">
            <div class="ui grid">
                <div class="thirteen wide column">Balanço do mês</div>
                <div class="three wide column"><i class="large teal icon dollar sign"></i></div>
            </div>
        </div>
    </div>
    <div class="four wide column">
        <div class="ui yellow top attached center aligned segment">
            <div class="ui tiny horizontal statistic">
                <?php
                    $receitaGeral = $mov->calculaMovimentos("receita");
                    $despesaGeral = $mov->calculaMovimentos("despesa");
                ?>
                <div class="value"><?php echo formataDinheiro($receitaGeral-$despesaGeral); ?></div>
            </div>
        </div>
        <div class="ui yellow bottom attached segment">
            <div class="ui grid">
                <div class="thirteen wide column">Balanço geral</div>
                <div class="three wide column"><i class="large yellow icon dollar sign"></i></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="right aligned column">
        <div class="ui teal buttons">
            <div class="ui button">Adicionar</div>
            <div class="ui floating dropdown icon button">
                <i class="dropdown icon"></i>
                <div class="menu">
                    <div class="item" onclick="adicionarReceita()"><i class="plus icon"></i> Receita</div>
                    <div class="item" onclick="adicionarDespesa()"><i class="minus icon"></i> Despesa</div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="column">
        <table id="movimentos" class="ui black compact striped table">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data</th>
                    <th>Categoria</th>
                    <th>Tipo</th>
                    <th>Pagamento</th>
                    <th>Pago</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $movimentos = $mov->listaMovimentos($mes, $ano);
                if (!empty($movimentos)) {
                    foreach ($movimentos as $chave => $item) {
                ?>
                        <tr class="<?php echo $item["tipo"] == "despesa" ? "error" : "positive"; ?>">
                            <td>
                                <?php echo $item["descricao"]; ?>
                            </td>
                            <td>
                                <?php echo formataDinheiro($item["valor"]); ?>
                            </td>
                            <td>
                                <?php
                                $dataMovimento = new DateTime($item["data"]);
                                echo $dataMovimento->format("d/m/Y");
                                ?>
                            </td>
                            <td>
                                <?php echo $item["categoria"]; ?>
                            </td>
                            <td>
                                <div class='ui <?php echo $item["tipo"] == "despesa" ? "red" : "green"; ?> circular label'><?php echo $item["tipo"]; ?></div>
                            </td>
                            <td>
                                <?php echo $item["forma_pagamento"]; ?>
                            </td>
                            <td>
                                <?php echo $item["pago"] == "s" ? "<i class='check green icon'></i>" : "<i class='x red icon'></i>"; ?>
                            </td>
                            <td class="right aligned">
                                <div class="ui icon top right pointing dropdown mini button">
                                    <i class="dropdown icon"></i>
                                    <div class="menu">
                                        <a class="item" href="marcar-movimento.php?pago=<?php echo $item["pago"] == "s" ? "n" : "s"; ?>&id=<?php echo $item["id_movimento"]; ?>">
                                            <i class="dollar sign icon"></i><?php echo $item["pago"] == "s" ? "Não pago" : "Pago"; ?>
                                        </a>
                                        <a class="item" href="deletar-movimento.php?id=<?php echo $item["id_movimento"]; ?>">
                                            <i class="trash icon"></i>Deletar
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<?php
require_once("inc/modal-receita.php");
require_once("inc/modal-despesa.php");

require_once("inc/scripts.php");
?>
<!-- jQuery Mask Plugin -->
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<!-- jQuery Mask Plugin -->
<!-- movimento js -->
<script src="js/movimento.js"></script>
<!-- movimento js -->
<!-- js de DataTable -->
<script src="js/DataTables/js/jquery.dataTables.min.js"></script>
<script src="js/DataTables/js/dataTables.semanticui.min.js"></script>
<!-- js de DataTable -->
<script>
    function mascararCampoMoeda(valor) {
        return $(valor).mask('000.000.000.000.000,00', {
            reverse: true
        });
    }
</script>
<?php
require_once("inc/rodape.php");
?>