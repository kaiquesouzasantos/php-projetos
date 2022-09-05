<?php
    require("../model/Turma.php");
    require("../connect/Conexao.php");

    class TurmaDAO{
        private static function getConexao(){
            return Conexao::getConexao();
        }

        public static function cadastrar($nomeTurma){
            $turma = new Turma($nomeTurma);

            $insertTurma = "INSERT INTO tbTurma(nomeTurma) VALUES (:nome)";
            
            $stmt = self::getConexao()->prepare($insertTurma);
            $stmt->bindValue(":nome", $turma->getNomeTurma());

            $stmt->execute();

            return true;
        }

        public static function getTurmas(){
            $turmas = "";
            $stmt = self::getConexao()->query("SELECT * FROM tbTurma")->fetchAll();

            foreach($stmt as $turma){
                $turmas = $turmas.'<option value="'.$turma['codTurma'].'">'.$turma['nomeTurma'].'</option>';
            }

            return $turmas;
        }
    }
?>

