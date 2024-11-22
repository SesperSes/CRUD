<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h2>CADASTRO DE USUÁRIO</h2>
    <form action="" method="post">
        <label>Nome:</label>
        <input type="text" name="nome" id="" placeholder="Digite o seu nome.">
        <label>Telefone:</label>
        <input type="tel" name="tel" id="" placeholder="Digite o seu telefone.">
        <label>Email:</label>
        <input type="email" name="email" id="" placeholder="Digite o seu email.">
        <label>Senha:</label>
        <input type="password" name="senha" id="" placeholder="Confirme a sua senha.">
        <label>Confirmar Senha</label>
        <input type="password" name="confSenha" id="" placeholder="Repita sua senha">
        <input type="submit" value="CADASTRAR">
        <a href="index.php">VOLTAR</a>
    </form>

    <?php

        // Verifica se o campo tem algo preenchido
        if(isset($_POST['nome']))
        {
            $nome = $_POST['nome'];
            $telefone = $_POST['tel'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $confSenha = addslashes($_POST['confSenha']);

            // Verificar se todos os campos estão preenchidos
            if(!empty($nome) && !empty($telefone) && !empty($email) && !empty($senha) && !empty($confSenha))
            {
                $usuario->conectar("cadastroturma32", "localhost", "root", "");
                if($usuario->msgErro == "")
                {
                    if($senha == $confSenha)
                    {
                        if($usuario->cadastrar($nome, $telefone, $email, $senha))
                        {
                            ?>
                            <!-- Area do HTML -->
                                <div id="msn-sucesso">
                                    Cadastrado com Sucesso.
                                    Clique <a href="index.php">aqui</a> para logar.
                                </div>
                            <!-- Fim do HTML -->
                            <?php
                        }
                        else
                        {
                            ?>
                            <!-- Area do HTML -->
                                <div id="msn-sucesso">
                                    Email já cadastrado.
                                </div>
                            <!-- Fim do HTML -->
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                            <!-- Area do HTML -->
                                <div id="msn-sucesso">
                                    Senha e Confirma senha não conferem.
                                </div>
                            <!-- Fim do HTML -->
                            <?php
                    }
                }
                else
                {
                    ?>
                        <!-- Area do HTML -->
                            <div id="msn-sucesso">
                                <?php echo "Erro: ".$usuario->msgErro;?>
                            </div>
                        <!-- Fim do HTML -->
                    <?php
                }
            }
            else
            {
                ?>
                            <!-- Area do HTML -->
                                <div id="msn-sucesso">
                                    Preencha todos os campos.
                                </div>
                            <!-- Fim do HTML -->
                            <?php
            }
        }

    ?>
</body>
</html>