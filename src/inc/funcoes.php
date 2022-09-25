<?php
function formataDinheiro($valor)
{
    $valor = ($valor == "") ? "0,00" : number_format(str_replace(",", ".", $valor), 2, ",", ".");
    return "R$ " . $valor;
}
function mesExtenso()
{
    $meses = array("Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
    return $meses;
}