<?php
    class Usuario{
        private = $pdo;
        public = $msgErro = '';
    }
        public function conectar($host,$nome,$usuario,$senha) {
            global $pdo;
            try {
                $pdo = new PDO("mysql:dbname=CRUD". $nome, $usuario, $senha);
            } catch (PDOException $erro) {
                $msgErro = $erro->getMessage();
        }

        public function cadastrar($nome,$telefone,$email,$senha){
            global $pdo;

            // Verificar se o email já está cadastrado "prepare() -> prepara o sql pra não permitir a injeção de SQL"
            $sql = $pdo->prepare("SELECT id_usuario FROM usuarios WHERE email = :maria");
            // Atribui um valor para que não seja visto algum dado pessoal
            $sql->bindValue(":maria", $email);
            $sql->execute();
            if($sql->rowCount()>0){
                return false;
            }
            else{
                $sql = $pdo->prepare("INSERT INTO usuarios (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":t", $telefone);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s", md5(md5($senha)));
                $sql->execute();
                return true;
            }
        }
    }
?>