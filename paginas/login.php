<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/bibliocine/src/IconePreto.ico" type="image/x-icon">
        <title> Login </title>
        <link rel="stylesheet" href="/bibliocine/css/estilos.css">
    </head>
    <body>
        <?php
            require_once('./headerIn.php');
        ?>
        <main class="index">
            <section class="secForm">

                <h1> Login </h1>
                <form action="#" method="POST">

                    <label for="email"> Digite seu email: </label>
                    <input type="email" name="email" id="email" placeholder="Digite seu email" autocomplete="off">

                    <label for="senha"> Digite sua senha: </label>
                    <input type="password" name="senha" id="senha" placeholder="Digite sua senha" autocomplete="off">

                    <input type="submit" name="entrar" value="Entrar">

                </form>
                <?php
                    session_start();
                    if(isset($_POST['entrar'])){

                        $email = $_POST['email'];
                        $senha = $_POST['senha'];

                        if($email == '' || $senha == ''){
                            echo('Um ou mais campos estão vázios');
                        }else{

                                require_once('./conexao.php');

                                $mysql = 'SELECT * from usuarios WHERE email = "'. $email .'";';

                                $resul = mysqli_query($conexao, $mysql);

                                $numLinhas = mysqli_num_rows($resul);

                                if($numLinhas > 0){
                                    while($contr = mysqli_fetch_array($resul)){
                                        if(password_verify($senha , $contr['senha_crip'])){
                                            $_SESSION['id'] = $contr['id'];
                                            $_SESSION['nome'] = $contr['nome'];
                                            header('location: ./home.php');
                                        }
                                    }

                                    echo("A senha está incorreta");


                                }else{

                                    echo("Não existe um usuário com este email");

                                }



                            }
                        }

                ?>
                <p>
                    Ainda não possui uma Conta? <a href="./cadastrar.php"> Cadastre-se aqui </a>    
                </p>
            </section>
        </main>
        <?php
            require_once('./footer.php')
        ?>
    </body>
</html>