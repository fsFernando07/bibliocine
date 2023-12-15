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
                    <h1> Pesquisar </h1>
                    <form action="#" method="POST">
        
                        <label for="txtPesquisa"> Pesquisar </label>
                        <input type="text" name="txtPesquisa" id="txtPesquisa" placeholder="Pesquise" required>
        
                        <label for="filtro"> Escolha o filtro de pesquisa </label>
                        <select name="filtro" id="filtro">
                            <option value="nome"> Nome </option>
                            <option value="genero"> Gênero </option>
                            <option value="ano"> Ano de Lançamento</option>
                        </select>
                        
                        <input type="submit" value="Pesquisar" name="pesquisar">
                        
                    </form>
                </section>
                <section class="tabelas">

                    <?php
                        if(isset($_POST["pesquisar"])){
                            $txtPesquisa = $_POST["txtPesquisa"];
                            $filtro = $_POST["filtro"];

                            if($txtPesquisa == '' || $filtro == ''){
                                echo("Um ou mais campos está vázio");
                            }else{
                                require_once('../conexao.php');

                                if($filtro == 'nome'){
                                    $mysqlPesq = 'SELECT * FROM filmes WHERE (id_usuario = '. $_SESSION['id'].') && ((nome LIKE "'.$txtPesquisa.'%") || (nome LIKE "%'.$txtPesquisa.'%") || (nome LIKE "%'.$txtPesquisa.'")) ;';
                                }else if($filtro == 'genero'){
                                    $mysqlPesq = 'SELECT * FROM filmes WHERE (id_usuario = '. $_SESSION['id'].') && ((genero LIKE "'.$txtPesquisa.'%") || (genero LIKE "%'.$txtPesquisa.'%") || (genero LIKE "%'.$txtPesquisa.'")) ;';
                                }else{
                                    $mysqlPesq = 'SELECT * FROM filmes WHERE (id_usuario = '. $_SESSION['id'].') && ((ano_lanc LIKE "'.$txtPesquisa.'%") || (ano_lanc LIKE "%'.$txtPesquisa.'%") || (ano_lanc LIKE "%'.$txtPesquisa.'")) ;';
                                }

                                $resul = mysqli_query($conexao, $mysqlPesq);
                                $numLinhas = mysqli_num_rows($resul);

                                if($numLinhas == 0){
                                    echo('<p>Nenhum resultado encontrado.');
                                }else{
                                    while($contr = mysqli_fetch_array($resul)){
                                        ?>
                                        <table>
                                            <tr><td colspan="2"> <h2> <?php echo($contr["nome"]);?> </h2> </td></tr>
                                            <tr><th> Gênero: </th> <th> Status: </th> </tr>
                                            <tr> <td> <?php echo($contr["genero"]);?> </td> <td> <?php echo($contr["status"]);?> </td></tr>
                                            <tr><th> Ano de Lançamento: </th> <th> Ano Assistido: </th></tr>
                                            <tr> <td> <?php echo($contr["ano_lanc"]);?> </td> <td> <?php echo($contr["ano_assis"]);?> </td></tr>
                                        </table>
                    <?php
                                    }
                                }
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