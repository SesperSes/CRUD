<?php
class Usuario {
    private $pdo;
    public $msgErro = "";

    public function conectar($host, $nome, $usuario, $senha) {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$nome", $usuario, $senha);
        } catch (PDOException $erro) {
            $this->msgErro = $erro->getMessage();
        }
    }

    public function getPDO() {
        return $this->pdo;
    }

    public function logar($email, $senha) {
        $sql = $this->pdo->prepare("SELECT id_usuario, senha FROM usuario WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $dado = $sql->fetch(PDO::FETCH_ASSOC);
            if ($dado['senha'] == md5(md5($senha))) {
                return true;
            }
        }

        return false;
    }

    public function cadastrar($nome, $telefone, $email, $senha) {
        $sql = $this->pdo->prepare("SELECT id_usuario FROM usuario WHERE email = :e");
        $sql->bindValue(":e", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return false;
        } else {
            $sql = $this->pdo->prepare("INSERT INTO usuario (nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
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
