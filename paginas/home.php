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
                <h1> Home </h1>
                <section class="home">
                    <h2> Filmes </h2>
                    <section class="tabelas">
                        <?php
                            require_once('./conexao.php');

                            $mysqlSel = 'SELECT * FROM filmes WHERE id_usuario = '. $_SESSION['id'].' ORDER BY genero;';

                            $resul = mysqli_query($conexao, $mysqlSel);

                            $numLinhas = mysqli_num_rows($resul);

                            if($numLinhas == 0){
                                echo('<p>Você não possui nenhum filme catalogado. <a href="./filmes/catalogar.php">Catalogue aqui</a></p>');
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
                        ?>
                    </section>
                    <h2> Livros </h2>
                    <section class="tabelas">
                        <?php
                            require_once('./conexao.php');

                            $mysqlSel = 'SELECT * FROM livros WHERE id_usuario = '. $_SESSION['id'].' ORDER BY genero;';

                            $resul = mysqli_query($conexao, $mysqlSel);

                            $numLinhas = mysqli_num_rows($resul);

                            if($numLinhas == 0){
                                echo('<p> Você não possui nenhum livro catalogado. <a href="./livros/catalogar.php">Catalogue aqui</a></p>');
                            }else{
                                while($contr = mysqli_fetch_array($resul)){
                                    ?>
                                    <table>
                                        <tr><td colspan="2"> <h2> <?php echo($contr["nome"]);?> </h2> </td></tr>
                                        <tr><th> Gênero: </th> <th> Status: </th> </tr>
                                        <tr> <td> <?php echo($contr["genero"]);?> </td> <td> <?php echo($contr["status"]);?> </td></tr>
                                        <tr><th> Número de Páginas: </th> <th> Páginas Lidas: </th></tr>
                                        <tr> <td> <?php echo($contr["num_paginas"]);?> </td> <td> <?php echo($contr["pag_lidas"]);?> </td></tr>
                                        <tr> <th> Ano lido </th> </tr>
                                        <tr> <td> <?php echo($contr["ano_lido"]);?> </td></tr>
                                    </table>
                                    <?php
                                }
                            }
                        ?>
                    </section>
                    <h2> Séries </h2>
                    <section class="tabelas">
                        <?php
                            require_once('./conexao.php');

                            $mysqlSel = 'SELECT * FROM series WHERE id_usuario = '. $_SESSION['id'].' ORDER BY genero;';

                            $resul = mysqli_query($conexao, $mysqlSel);

                            $numLinhas = mysqli_num_rows($resul);

                            if($numLinhas == 0){
                                echo('<p>Você não possui nenhuma série catalogada. <a href="./series/catalogar.php">Catalogue aqui</a></p>');
                            }else{
                                while($contr = mysqli_fetch_array($resul)){
                                    ?>
                                    <table>
                                        <tr><td colspan="2"> <h2> <?php echo($contr["nome"]);?> </h2> </td></tr>
                                        <tr><th> Gênero: </th> <th> Status: </th> </tr>
                                        <tr> <td> <?php echo($contr["genero"]);?> </td> <td> <?php echo($contr["status"]);?> </td></tr>
                                        <tr><th> Total de Temporadas: </th><th> Episódio Parado:</th></tr>
                                        <tr><td><?php echo($contr["total_temp"]);?></td><td><?php echo($contr["episodio_parado"]);?></td></tr>
                                        <tr><th> Temporada Parada: </th> <th> Ano Assistido: </th></tr>
                                        <tr> <td> <?php echo($contr["temp_parada"]);?> </td> <td> <?php echo($contr["ano_ass"]);?> </td></tr>
                                        <tr><th> Ano de Lançamento:</th></tr>
                                        <tr><td> <?php echo($contr["ano_lanc"]);?></td></tr>
                                    </table>
                                    <?php
                                }
                            }
                        ?>
                    </section>
                </section>
            </section>
        </main>
        <?php
            require_once('./footer.php')
        ?>
    </body>
</html>