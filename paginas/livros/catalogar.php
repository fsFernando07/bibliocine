<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/bibliocine/src/IconePreto.ico" type="image/x-icon">
        <title> Livros </title>
        <link rel="stylesheet" href="/bibliocine/css/estilos.css">
    </head>
    <body>
        <?php
            require_once('../headerHome.php');
        ?>
        <main class="home">
            <?php
                require_once('../nav.php');
            ?>
            <section class="form">
                <section class="secForm">
                    <h1> Catalogar </h1>
                    <form action="#" method="POST">
        
                        <label for="nome"> Digite o nome do Livro </label>
                        <input type="text" name="nome" id="nome" placeholder="Digite o nome do Livro" required>
        
                        <label for="genero"> Escolha o gênero do Livro </label>
                        <select name="genero" id="genero">
                            <option value="Ação"> Ação </option>
                            <option value="Comédia"> Comédia </option>
                            <option value="Drama"> Drama </option>
                            <option value="Romance"> Romance </option>
                            <option value="Documentário"> Documentário </option>
                            <option value="Suspense"> Suspense </option>
                            <option value="Terror"> Terror </option>
                            <option value="Terror"> Ficção Científica </option>
                        </select>
        
                        <label for="numPag"> Digite o número de páginas </label>
                        <input type="number" name="numPag" id="numPag" placeholder="Digite o número de páginas" min="0" required>


        
                        <input type="submit" value="Catalogar" name="catalogar">
        
                    </form>
                    <?php
                        if(isset($_POST["catalogar"])){
                            $nome = $_POST["nome"];
                            $genero = $_POST["genero"];
                            $numPag = $_POST["numPag"];

                            if($nome == '' || $genero == '' || $numPag == ''){
                                echo("Um ou mais campos está vázio");
                            }else{
                                require_once('../conexao.php');

                                $mysqlIn = 'INSERT INTO livros(nome,genero,status,num_paginas,pag_lidas,ano_lido,id_usuario) VALUES("'. $nome .'","'. $genero .'", "Não lido" ,"'. $numPag.'",0,"0000-00-00",'. $_SESSION['id'].');';

                                mysqli_query($conexao, $mysqlIn);

                                header('location: ./livros.php');
                            }

                        }
                    ?>
                </section>
            </section>
        </main>
        <?php
            require_once('../footer.php')
        ?>
    </body>
</html>