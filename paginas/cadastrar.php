<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/bibliocine/src/IconePreto.ico" type="image/x-icon">
        <title> Cadastrar </title>
        <link rel="stylesheet" href="/bibliocine/css/estilos.css">
    </head>
    <body>
        <?php
            require_once('./headerIn.php');
        ?>
        <main class="index">
            <section class="secForm">
                <h1> Cadastrar </h1>
                <form action="#" method="POST">

                    <label for="nome"> Digite seu nome: </label>
                    <input type="text" name="nome" id="nome" placeholder="Digite seu nome" autocomplete="off">

                    <label for="email"> Digite seu email: </label>
                    <input type="email" name="email" id="email" placeholder="Digite seu email" autocomplete="off">

                    <label for="senha"> Digite sua senha: </label>
                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" autocomplete="off">

                    <label for="senhaConf"> Confirme sua senha: </label>
                    <input type="password" name="senhaConf" id="senhaConf" placeholder="Confirme sua senha" autocomplete="off">

                    <input type="submit" name="cadastrar" value="Cadastrar">

                </form>
                <?php
                    if(isset($_POST['cadastrar'])){

                        $nome = $_POST['nome'];
                        $email = $_POST['email'];
                        $senha = $_POST['senha'];
                        $senhaConf = $_POST['senhaConf'];

                        if($nome == '' || $email == '' || $senha == '' || $senhaConf == ''){
                            echo('Um ou mais campos estão vázios');
                        }else{
                            if($senha != $senhaConf){
                                echo('As senhas precisam ser iguais');
                            }else{
                                $senhaCrip = password_hash($senha, PASSWORD_DEFAULT);

                                require_once('./conexao.php');

                                $mysqlSel = 'SELECT email FROM usuarios WHERE email = "'. $email .'";';

                                $consul = mysqli_query($conexao , $mysqlSel);

                                $numLin = mysqli_num_rows($consul);

                                if($numLin == 0){
                                    $mysqlin = 'INSERT INTO usuarios(nome, email, senha_crip) VALUES("'. $nome .'","'. $email .'","'. $senhaCrip .'");';
        
                                    mysqli_query($conexao, $mysqlin);
        
                                    header('location: ./login.php');
                                }else{
                                    echo("Esse email já está cadastrado");
                                }

                            }
                        }

                    }
                ?>
                <p>
                    Já possui uma Conta? <a href="./login.php"> Entre aqui </a>    
                </p>
            </section>
        </main>
        <?php
            require_once('./footer.php')
        ?>
    </body>
</html>