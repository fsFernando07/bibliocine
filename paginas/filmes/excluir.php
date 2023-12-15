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
            <section class="home">
                <h1> Filmes </h1>
                <section class="tabelas">
                    <?php
                        require_once('../conexao.php');

                        if(isset($_POST["excluir"])){
                            $id = $_POST["id"];

                            $mysqlEx = 'DELETE FROM filmes WHERE id = '.$id.' && id_usuario = '.$_SESSION['id'].';';

                            mysqli_query($conexao,$mysqlEx);

                            header('location: filmes.php');
                        }
                        $mysqlSel = 'SELECT * FROM filmes WHERE id_usuario = '. $_SESSION['id'].' ORDER BY genero;';

                        $resul = mysqli_query($conexao, $mysqlSel);

                        $numLinhas = mysqli_num_rows($resul);

                        if($numLinhas == 0){
                            echo('<p>Você não possui nenhum filme catalogado. <a href="catalogar.php"> Catalogue aqui</a></p>');
                        }else{
                            while($contr = mysqli_fetch_array($resul)){
                                ?>
                                <table>
                                    <form action="#" method="POST">
                                        <input type="hidden" name="id" value="<?php echo($contr["id"]);?>">
                                        <tr><td colspan="2"> <h2> <?php echo($contr["nome"]);?> </h2> </td></tr>
                                        <tr><th> Gênero: </th> <th> Status: </th> </tr>
                                        <tr> <td> <?php echo($contr["genero"]);?> </td> <td> <?php echo($contr["status"]);?> </td></tr>
                                        <tr><th> Ano de Lançamento: </th> <th> Ano Assistido: </th></tr>
                                        <tr> <td> <?php echo($contr["ano_lanc"]);?> </td> <td> <?php echo($contr["ano_assis"]);?> </td></tr>
                                        <tr><th> Excluir: </th><td> <input type="submit" name="excluir" value="Excluir"></td></tr>
                                    </form>
                                </table>
                                <?php
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