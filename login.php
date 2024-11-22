<?php
    require_once 'usuario.php';
    $usuario = new Usuario();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="../CRUD/styles/login.css">
</head>
<body>
    <div class="fundo-login">
        <form class="quadrado-login" action="" method="post">
            <h2>Login</h2>
            <label>Usuário:</label>
            <input class="caixa-email" type="email" name="email" id="" placeholder="Digite o seu email.">
            <label>Senha:</label>
            <input class="caixa-senha"type="password" name="senha" id="" placeholder="Digite a sua senha.">
            <input class="logar" type="submit" value="LOGAR">
            <a class="link-cadastro" href="cadastros.php">Cadastre-se</a>
        </form>
        <?php
        if(isset($_POST['email']))
        {
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            if(!empty($email) && !empty($senha))
            {
                $usuario->conectar("localhost", "crud", "root", "");

                if($usuario->msgErro == "")
                {
                    if($usuario->logar($email,$senha))
                    {
                        header("Location: lista.php");
                        exit;
                    }
                    else
                    {
                        ?>
                            <div class ="msg-erro" id="msn-sucesso">
                                Email e/ou senha estão incorretos.
                            </div>
                        <?php
                    }
                }
                else
                {
                    ?> 
                        <div class ="msg-erro" id="msn-sucesso">
                            <?php echo "Erro: ".$usuario->msgErro;?>
                        </div>
                    <?php
                }
            }
        }
    ?>
</body>
</html>
