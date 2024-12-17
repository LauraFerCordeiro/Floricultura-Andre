<?php
    require_once(__DIR__ ."/../config/Conexao.php");
    require_once(__DIR__ ."/../config/utils.php");

    class Cliente{
        public static function list(){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT id, nome, datanasc, email, adm FROM cliente");
                $stmt->execute();

                return $stmt->fetchAll();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function add($nome, $datanasc, $email, $senha){
            try{
                $senhaCripto = password_hash($senha, PASSWORD_BCRYPT);

                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("INSERT INTO cliente(nome, datanasc, email, senha) values(?,?,?,?)");
                $stmt->execute([$nome, $datanasc, $email, $senhaCripto]);

                return $stmt->rowCount();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function exist($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT COUNT(*) FROM cliente WHERE id=?");
                $stmt->execute([$id]);

                return $stmt->fetchColumn();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function edit($id, $nome, $datanasc, $email){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("UPDATE cliente set nome=?, datanasc=?, email=? where id=?");
                $stmt->execute([$nome, $datanasc, $email, $id]);

                return $stmt->rowCount();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function delete($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("DELETE from cliente where id=?");
                $stmt->execute([$id]);

                return $stmt->rowCount();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function listID($id){
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT * FROM cliente WHERE id = ?");
                $stmt->execute([$id]);

                $resposta = $stmt->fetchAll();

                if (count($resposta)) {
                    return $resposta[0];
                } else {
                    return NULL;
                }
                
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }

        public static function existLogin($email) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT COUNT(*) FROM cliente WHERE email LIKE ?");
                $stmt->execute([$email]);

                return $stmt->fetchColumn();
            } catch(Exception $e) {
                return null;
            }
        }

        public static function getLogin($email, $senha) {
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT * FROM cliente WHERE email LIKE ?");
                $stmt->execute([$email]);

                $cliente = $stmt->fetchAll()[0];

                // Verifica se o usuário que veio do banco usa a mesma senha digitada pelo usuário fazendo login.

                if(password_verify($senha, $cliente["senha"])) {
                    // É o mesmo usuário! Retorna ele!
                    return $cliente;
                } else {
                    // Não é a mesma senha!
                    return false;
                }
            } catch(Exception $e) {
                return null;
            }
        }
    }
    

