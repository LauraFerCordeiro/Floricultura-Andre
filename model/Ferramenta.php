<?php

require_once(__DIR__ . "/../config/Conexao.php");
require_once(__DIR__ ."/../config/utils.php");

class Ferramenta {
    public static function list(){
        try{
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM ferramenta");
            $stmt->execute();

            return $stmt->fetchAll();

        } catch(Exception $e){
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function add($nome_ferramenta, $uso){
        try{
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("INSERT INTO ferramenta(nome_ferramenta, uso) values(?,?)");
            $stmt->execute([$nome_ferramenta, $uso]);

            return $stmt->rowCount();

        } catch(Exception $e){
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function exist($id){
        try{
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT COUNT(*) FROM ferramenta WHERE id=?");
            $stmt->execute([$id]);

            return $stmt->fetchColumn();

        } catch(Exception $e){
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function edit($id, $nome_ferramenta, $uso){
        try{
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("UPDATE ferramenta set nome_ferramenta=?, uso=? where id=?");
            $stmt->execute([$nome_ferramenta, $uso, $id]);

            return $stmt->rowCount();

        } catch(Exception $e){
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function delete($id){
        try{
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("DELETE from ferramenta where id=?");
            $stmt->execute([$id]);

            return $stmt->rowCount();

        } catch(Exception $e){
            output(500, ["msg" => $e->getMessage()]);
        }
    }

    public static function listID($id){
        try {
            $conexao = Conexao::getConexao();
            $stmt = $conexao->prepare("SELECT * FROM ferramenta WHERE id = ?");
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
}
