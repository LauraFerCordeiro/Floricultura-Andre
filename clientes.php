
<?php

    session_start();

    require_once(__DIR__ ."/config/header.php");
    require_once(__DIR__ ."/config/utils.php");
    require_once(__DIR__ ."/config/verbs.php");

    require_once(__DIR__ ."/model/Cliente.php");
    require_once(__DIR__ ."/model/Planta.php");

    $cliente = idClienteLogado();
    $adm = admClienteLogado();

    // Ta estranho ;-; 

    if(isMetodo("GET")){
            try {
                if (parametrosValidos($_GET, ["logout"])) {
                    if (!$cliente) {
                        throw new Exception("Usuário não está logado", 401);
                    }
                    session_destroy();
                    output(200, ["msg" => "Deslogado com sucesso"]);
                }
                if (!$cliente) {
                    throw new Exception("Usuário não está logado");
                }
                if (!Cliente::exist($cliente)) {
                    session_destroy();
                    throw new Exception("Usuário não existe mais. Você foi automaticamente deslogado", 400);
                }
                if (parametrosValidos($_GET, ["diferenciador"])){
                    output(200, ["cliente" => $cliente, "adm" => $adm]);
                }
                if($adm == 1){
                    if (!parametrosValidos($_GET, ["id"])) {
                        output(200, Cliente::list());
                    } else{
                        $res = Cliente::listID($_GET["id"]);
                        if (!$res) {
                            throw new Exception("Cliente não encontrada!", 500);
                        }
                        output(201, $res);
                        // Sei q no código de busca especifica não utilizei o listID, 
                        // porém obtei deixar para que no postman funcionasse também.
                    } 
                } 
            } catch(Exception $e) {
                output($e->getCode(), ["msg" => $e->getMessage()]);
            }
    }

    if(isMetodo("POST")){
        try{
            if($cliente) {
                if($adm == 0){
                    throw new Exception("Você está logado e não pode fazer isso", 400);
                }
            }
            if (parametrosValidos($_POST, ["signup", "email", "nome", "senha", "datanasc"])) {
                if(Cliente::existLogin($_POST["email"])) {
                    throw new Exception("Este login já existe", 400);
                }

                $res = Cliente::add($_POST["nome"], $_POST["datanasc"], $_POST["email"], $_POST["senha"]);
                if(!$res) {
                    throw new Exception("Erro no cadastro", 500);
                }
                output(200, ["msg" => "Cadastro realizado com sucesso"]);
            }

            if (parametrosValidos($_POST, ["email", "senha"])) {
                if(!Cliente::existLogin($_POST["email"])) {
                    throw new Exception("Este login não existe", 400);
                }
                $res = Cliente::getLogin($_POST["email"], $_POST["senha"]);
                if(!$res) {
                    throw new Exception("Login ou senha inválida", 400);
                }
                setIdClienteLogado($res["id"]);
                setAdmClienteLogado($res["adm"]);
                output(200, ["msg" => "Login realizado com sucesso"]);
            }
            if(!parametrosValidos($_POST, ["nome", "datanasc", "email", "senha"])){
                throw new Exception("Parametros incorretos", 400);
            }
            if($adm == 1){
                $res = Cliente::add($_POST["nome"], $_POST["datanasc"], $_POST["email"], $_POST["senha"]);
                if(!$res){
                    throw new Exception("Erro ao realizar cadastro", 400);
                }
                output(200, ["msg"=> "Cliente adicionado com sucesso!"]);
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
            if(!parametrosValidos($_PUT, ["nome", "datanasc", "email"])){
                throw new Exception("Parametros incorretos", 400);
            }
            if(!Cliente::exist($_GET["id"])){
                throw new Exception("Cliente não encontrado", 400);
            }
            if($adm == 1){
                $res = Cliente::edit($_GET["id"], $_PUT["nome"], $_PUT["datanasc"], $_PUT["email"]);
                if(!$res){
                    throw new Exception("Erro ao realizar edição", 400);
                }
                output(200, ["msg"=> "Cliente editado com sucesso!"]);
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
            if(!Cliente::exist($_GET["id"])){
                throw new Exception("Cliente não encontrado", 400);
            }
            if(Planta::existPlantaCliente($_GET["id"])){
                Planta::anular($_GET["id"]);
            }
            if ($adm == 1){
                $res = Cliente::delete($_GET["id"]);
                if(!$res){
                    throw new Exception("Erro ao deletar", 400);
                }
                output(200, ["msg"=> "Cliente deletado com sucesso e para sempre!"]);
            } 
        }catch(Exception $e){
            output($e->getCode(), ["msg"=> $e->getMessage()]);
        }
    }
?>