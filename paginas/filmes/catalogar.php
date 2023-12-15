<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/bibliocine/src/IconePreto.ico" type="image/x-icon">
        <title> Filmes </title>
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
        
                        <label for="nome"> Digite o nome do Filme </label>
                        <input type="text" name="nome" id="nome" placeholder="Digite o nome do Filme" required>
        
                        <label for="genero"> Escolha o gênero do Filme </label>
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
        
                        <label for="anoLanc"> Digite o ano de Lançamento </label>
                        <input type="date" name="anoLanc" id="anoLanc" required>
        
                        <input type="submit" value="Catalogar" name="catalogar">
        
                    </form>
                    <?php
                        if(isset($_POST["catalogar"])){
                            $nome = $_POST["nome"];
                            $genero = $_POST["genero"];
                            $anoLanc = $_POST["anoLanc"];

                            if($nome == '' || $genero == '' || $anoLanc == ''){
                                echo("Um ou mais campos está vázio");
                            }else{
                                require_once('../conexao.php');

                                $mysqlIn = 'INSERT INTO filmes(nome,genero,status,ano_lanc,ano_assis,id_usuario) VALUES("'. $nome .'","'. $genero .'", "Não assistido" ,"'. $anoLanc.'","0000-00-00",'. $_SESSION['id'].');';

                                mysqli_query($conexao, $mysqlIn);

                                header('location: ./filmes.php');
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