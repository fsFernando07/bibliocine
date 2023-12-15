<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/bibliocine/src/IconePreto.ico" type="image/x-icon">
        <title> Home </title>
        <link rel="stylesheet" href="/bibliocine/css/estilos.css">
    </head>
    <body>
        <?php
            require_once('./headerHome.php');
        ?>
        <main class="home">
            <nav>
                <a href="/bibliocine/paginas/filmes/filmes.php" class="linkNav"> Filmes </a>
                <a href="/bibliocine/paginas/livros/livros.php" class="linkNav"> Livros </a>
                <a href="/bibliocine/paginas/series/series.php" class="linkNav"> Series </a>
            </nav>
            <section class="home">
                <h1> Conta </h1>
                        <?php
                            require_once('./conexao.php');

                            if(isset($_POST["alterar"])){
                                $nome = $_POST["nome"];
                                $email = $_POST["email"];
                                $senha = $_POST["senha"];

                                $mysqlSel = 'SELECT email FROM usuarios WHERE (email = "'. $email .'") && (id != '. $_SESSION['id'] .');';

                                $consul = mysqli_query($conexao , $mysqlSel);

                                $numLin = mysqli_num_rows($consul);

                                if($nome == '' || $email == ''){
                                    echo("<p> Algum dos campos está vazio</p>");
                                }else{
                                    if($senha == ''){
                                        if($numLin == 0){
                                            $mysqlin = 'UPDATE usuarios SET nome = "'.$nome.'", email = "'.$email.'";';
                
                                            mysqli_query($conexao, $mysqlin);
                
                                            header('location: ./usuarios.php');
                                        }else{
                                            echo("Esse email já está cadastrado");
                                        }
                                    }else{
                                        $senhaCrip = password_hash($senha,PASSWORD_DEFAULT);
                                        if($numLin == 0){
                                            $mysqlin = 'UPDATE usuarios SET nome = "'.$nome.'", email = "'.$email.'",senha_crip = "'.$senhaCrip.'";';
                
                                            mysqli_query($conexao, $mysqlin);
                
                                            header('location: ./usuarios.php');
                                        }else{
                                            echo("Esse email já está cadastrado");
                                        }
                                    }
                                }
                            }
                            if(isset($_POST["excluir"])){
                                $mysqlExFilmes = 'DELETE FROM filmes WHERE id_usuario = '.$_SESSION['id'].';';
                                $mysqlExLivros = 'DELETE FROM livros WHERE id_usuario = '.$_SESSION['id'].';';
                                $mysqlExSeries = 'DELETE FROM series WHERE id_usuario = '.$_SESSION['id'].';';
                                $mysqlExUsuario = 'DELETE FROM usuarios WHERE id = '.$_SESSION['id'].';';

                                mysqli_query($conexao,$mysqlExFilmes);
                                mysqli_query($conexao,$mysqlExLivros);
                                mysqli_query($conexao,$mysqlExSeries);
                                mysqli_query($conexao,$mysqlExUsuario);

                                header('location: ./sair.php');
                                
                            }
                            $mysqlSel = 'SELECT * FROM usuarios WHERE id = '. $_SESSION['id'].';';

                            $resul = mysqli_query($conexao, $mysqlSel);

                            while($contr = mysqli_fetch_array($resul)){
                                ?>
                            <section class="form">
                                <section class="secForm">
                                    <form action="#" method="POST">
                                        <label for="nome"> Nome: </label>
                                        <input type="text" name="nome" id="nome" value="<?php echo($contr["nome"]);?>">
                                        
                                        <label for="email"> Email: </label>
                                        <input type="email" name="email" id="email" value="<?php echo($contr["email"]);?>"> 
                                        
                                        <label for="senha"> Senha: </label>
                                        <td> <input type="password" name="senha" id="senha" placeholder="Altere sua senha"> 
                                        
                                        <input type="submit" name="alterar" value="Alterar">
                                        
                                        <p> Deseja sair da conta? <a href="./sair.php" class="sair"> Sair </a></p>
                                        <p> Deseja excluir a conta? <input type="submit" name="excluir" value="Excluir" class="sair"></p>
                                    </form>
                                </section>
                                    <?php
                                }
                                ?>
                        </section>
            </section>
        </main>
        <?php
            require_once('./footer.php')
        ?>
    </body>
</html>