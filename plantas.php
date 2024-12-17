<?php

    session_start();

    require_once(__DIR__ ."/config/header.php");
    require_once(__DIR__ ."/config/utils.php");
    require_once(__DIR__ ."/config/verbs.php");
    require_once(__DIR__ ."/model/Planta.php");
    require_once(__DIR__ ."/model/Cliente.php");
    require_once(__DIR__ ."/model/Ferramenta.php");

    $cliente = idClienteLogado();
    $adm = admClienteLogado();

    if(isMetodo("GET")){
        if (!parametrosValidos($_GET, ["id"])) {
            output(200, Planta::list());
        } else {
            try {
                $res = Planta::listID($_GET["id"]);
                if (!$res) {
                    throw new Exception("Planta não encontrada!", 500);
                }
                output(201, $res);
            } catch(Exception $e) {
                output($e->getCode(), ["msg" => $e->getMessage()]);
            }
        }
    }

    if(isMetodo("POST")){
        try{
            if(!parametrosValidos($_POST, ["nome", "nomecientifico", "preco", "cor", "estoque", "donoid", "ferramentaid" ])){
                throw new Exception("Parametros incorretos", 400);
            }
            if ($_POST['estoque'] > 10) {
                throw new Exception("O limite de estoque foi excedido! (10 plantas)", 400);
            }
            if ($_POST['estoque'] < 1) {
                throw new Exception("Ei amigo, vc precisa adicionar 1 pelo menos", 400);
            }
            $donoid = $_POST["donoid"];
            if ($donoid > -1) {
                if(!Cliente::exist($donoid)){
                    throw new Exception("Dono não encontrado", 400);
                }
            } else {
                $donoid = null;
            }
            if(!Ferramenta::exist($_POST["ferramentaid"])){
                throw new Exception("Ferramenta não encontrada", 400);
            }
            if ($adm == 1){
                for ($i = 0; $i < $_POST["estoque"]; $i++) {
                    $res = Planta::add($_POST["nome"], $_POST["nomecientifico"], $_POST["preco"], $_POST["cor"], $donoid, $_POST["ferramentaid"]);
                }
                if(!$res){
                    throw new Exception("Erro ao realizar cadastro", 400);
                }
                output(200, ["msg"=> "Planta adicionada com sucesso!"]);
            }
        }catch(Exception $e){
            output($e->getCode(), ["msg"=> $e->getMessage()]);
        }
    }

    if(isMetodo("PUT")){
        try{
            if(!parametrosValidos($_GET, ["id"])){
                throw new Exception("Parametro ID não encontrado", 400);
            }
            if(!Planta::exist($_GET["id"])){
                throw new Exception("Planta não encontrada", 400);
            }
            $donoid = null;
            if (parametrosValidos($_PUT, ["donoid"])) {
                $donoid = $_PUT["donoid"];
                if ($donoid >= 0) {
                    if(!Cliente::exist($donoid)){
                        throw new Exception("Dono não encontrado", 400);
                    }
                }
            }
            if($donoid == -1){
                $donoid = null;
            }
            if(parametrosValidos($_PUT, ["nome", "nomecientifico", "preco", "cor", "ferramentaid"])){
                if($donoid){
                    $res = Planta::compra($_PUT["donoid"], $_GET["id"]);
                    if(!$res){
                        throw new Exception("Erro ao realizar compra", 400);
                    }
                    // output(200, ["msg"=> "Planta comprada com sucesso!"]);
                }
                if(!Ferramenta::exist($_PUT["ferramentaid"])){
                    throw new Exception("Ferramenta não encontrada", 400);
                }
                if($adm == 1){
                    $res = Planta::edit($_GET["id"], $_PUT["nome"], $_PUT["nomecientifico"], $_PUT["preco"], $_PUT["cor"], $donoid, $_PUT["ferramentaid"]);
                    if(!$res){
                        throw new Exception("Erro ao realizar edição", 400);
                    }
                    output(200, ["msg"=> "Planta editada com sucesso!"]);
                }
            }
        }catch(Exception $e){
            output($e->getCode(), ["msg"=> $e->getMessage()]);
        }
    }

    if(isMetodo("DELETE")){
        try{
            if(!parametrosValidos($_GET, ["id"])){
                throw new Exception("Parametro ID não encontrado", 400);
            }
            if(!Planta::exist($_GET["id"])){
                throw new Exception("Planta não encontrada", 400);
            }
            if($adm == 1){
                $res = Planta::delete($_GET["id"]);
                if(!$res){
                    throw new Exception("Erro ao deletar", 400);
                }
                output(200, ["msg"=> "Planta deletada com sucesso e para sempre!"]);
            }
        }catch(Exception $e){
            output($e->getCode(), ["msg"=> $e->getMessage()]);
        }
    }