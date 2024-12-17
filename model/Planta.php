<?php

    require_once(__DIR__ ."/../config/Conexao.php");
    require_once(__DIR__ ."/../config/utils.php");

    class Planta{
        public static function list(){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT * FROM planta");
                $stmt->execute();

                return $stmt->fetchAll();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function add($nome, $nomecientifico, $preco, $cor, $donoid, $ferramentaid){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("INSERT INTO planta(nome, nomecientifico, preco, cor, donoid, ferramentaid) values(?, ?, ?, ?, ?, ?)");
                $stmt->execute([$nome, $nomecientifico, $preco, $cor, $donoid, $ferramentaid]);
        
                return $stmt->rowCount();
            }catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function edit($id, $nome, $nomecientifico, $preco, $cor, $donoid, $ferramentaid){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("UPDATE planta set nome=?, nomecientifico=?, preco=?, cor=?, donoid=?, ferramentaid=? where id=?");
                $stmt->execute([$nome, $nomecientifico, $preco, $cor, $donoid, $ferramentaid, $id]);
        
                return $stmt->rowCount();
        
            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function exist($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT COUNT(*) FROM planta WHERE id=?");
                $stmt->execute([$id]);

                return $stmt->fetchColumn();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function delete($id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("DELETE from planta where id=?");
                $stmt->execute([$id]);

                return $stmt->rowCount();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function confereDelete($ferramentaid){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("DELETE from planta where ferramentaid=?");
                $stmt->execute([$ferramentaid]);

                return $stmt->rowCount();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function existPlantaFerramenta($ferramentaid){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT COUNT(*) FROM planta WHERE ferramentaid=?");
                $stmt->execute([$ferramentaid]);

                return $stmt->fetchColumn();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function existPlantaCliente($donoid){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT COUNT(*) FROM planta WHERE donoid=?");
                $stmt->execute([$donoid]);

                return $stmt->fetchColumn();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function anular($donoid){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("UPDATE planta set donoid=null where donoid=?");
                $stmt->execute([$donoid]);

                return $stmt->rowCount();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }

        public static function listID($id){
            try {
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("SELECT * FROM planta WHERE id = ?");
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

        public static function compra($donoid, $id){
            try{
                $conexao = Conexao::getConexao();
                $stmt = $conexao->prepare("UPDATE planta set donoid=? where id=?");
                $stmt->execute([$donoid, $id]);

                return $stmt->rowCount();

            } catch(Exception $e){
                output(500, ["msg" => $e->getMessage()]);
            }
        }
 
    }