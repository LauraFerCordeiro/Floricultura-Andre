
<?php

    session_start();

    require_once(__DIR__ ."/config/header.php");
    require_once(__DIR__ ."/config/utils.php");
    require_once(__DIR__ ."/config/verbs.php");

    require_once(__DIR__ ."/model/Ferramenta.php");
    require_once(__DIR__ ."/model/Planta.php");

    $cliente = idClienteLogado();
    $adm = admClienteLogado();


    if(isMetodo("GET")){
        if (!parametrosValidos($_GET, ["id"])) {
            output(200, Ferramenta::list());
            try {
                $res = Ferramenta::listID($_GET["id"]);
                if (!$res) {
                    throw new Exception("Ferramenta não encontrada!", 500);
                }
                output(201, $res);
            } catch(Exception $e) {
                output($e->getCode(), ["msg" => $e->getMessage()]);
            }
        }
    }

    if(isMetodo("POST")){
        try{
            if($cliente) {
                if($adm == 0){
                    throw new Exception("Você está logado e não pode fazer isso", 400);
                }
            }
            if(!parametrosValidos($_POST, ["nome_ferramenta", "uso"])){
                throw new Exception("Parametros incorretos", 400);
            }
            if($adm == 1){
                $res = Ferramenta::add($_POST["nome_ferramenta"], $_POST["uso"]);
                if(!$res){
                    throw new Exception("Erro ao realizar cadastro", 400);
                }
                output(200, ["msg"=> "Ferramenta adicionada com sucesso!"]);
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
            if(!parametrosValidos($_PUT, ["nome_ferramenta", "uso"])){
                throw new Exception("Parametros incorretos", 400);
            }
            if(!Ferramenta::exist($_GET["id"])){
                throw new Exception("Ferramenta não encontrada", 400);
            }
            if($adm == 1){
                $res = Ferramenta::edit($_GET["id"], $_PUT["nome_ferramenta"], $_PUT["uso"]);
                if(!$res){
                    throw new Exception("Erro ao realizar edição", 400);
                }
                output(200, ["msg"=> "Ferramenta editada com sucesso!"]);
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
            if(!Ferramenta::exist($_GET["id"])){
                throw new Exception("Ferramenta não encontrada", 400);
            }
            if(Planta::existPlantaFerramenta($_GET["id"])){
                Planta::confereDelete($_GET["id"]);
            }
            if($adm == 1){
                $res = Ferramenta::delete($_GET["id"]);
                if(!$res){
                    throw new Exception("Erro ao deletar", 400);
                }
                output(200, ["msg"=> "Ferramenta deletada com sucesso e para sempre!"]);
            }
        }catch(Exception $e){
            output($e->getCode(), ["msg"=> $e->getMessage()]);
        }
    }
?>