<?php

function parametrosValidos($metodo, $lista)
{
    $obtidos = array_keys($metodo);
    $nao_encontrados = array_diff($lista, $obtidos);
    if (empty($nao_encontrados)) {
        foreach ($lista as $p) {
            if (empty(trim($metodo[$p]))) {
                return false;
            }
        }
        return true;
    }
    return false;
}


function isMetodo($metodo)
{
    if (!strcasecmp($_SERVER['REQUEST_METHOD'], $metodo)) {
        return true;
    }
    return false;
}


function output($codigo, $msg)
{
    http_response_code($codigo);
    echo json_encode($msg);
    exit;
}

// Função que retorna o valor do campo "usuario" da sessão, se houver. False, caso não exista.
function idClienteLogado() {
    if(parametrosValidos($_SESSION, ["cliente"])) {
        return $_SESSION["cliente"];
    } 
    return false;
}

function setIdClienteLogado($id) {
    $_SESSION["cliente"] = $id;
}

function setAdmClienteLogado($adm) {
    $_SESSION["adm"] = $adm;
}

function admClienteLogado(){
    if(parametrosValidos($_SESSION, ["adm"])) {
        return $_SESSION["adm"];
    } 
    return false;
}
