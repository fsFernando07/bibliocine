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
            <section class="home">
                <h1> Livros </h1>
                <section class="tabelas">
                    <?php
                        require_once('../conexao.php');
                        if(isset($_POST["alterar"])){
                            $id = $_POST["id"];
                            $nome = $_POST["nome"];
                            $genero = $_POST["genero"];
                            $status = $_POST["status"];
                            $numPag = $_POST["numPag"];
                            $pagLidas = $_POST["pagLidas"];
                            $anoLido = $_POST["anoLido"];

                            if($id == '' || $nome == '' || $genero == '' || $status == '' || $numPag == ''){
                                echo("Um ou mais campos está vazio");
                            }else{
                                if($anoLido == ''){
                                    $anoLido = '0000-00-00';
                                }
                                $mysqlUp = 'UPDATE livros SET nome = "'. $nome .'", genero = "'. $genero .'", status = "'. $status .'", num_paginas = '. $numPag.', pag_lidas = '. $pagLidas.', ano_lido = "'.$anoLido.'" WHERE (id = '. $id .') && (id_usuario = '. $_SESSION["id"].');';

                                mysqli_query($conexao,$mysqlUp);

                                header('location: ./livros.php');

                            }
                        }

                        $mysqlSel = 'SELECT * FROM livros WHERE id_usuario = '. $_SESSION['id'].' ORDER BY genero;';

                        $resul = mysqli_query($conexao, $mysqlSel);

                        $numLinhas = mysqli_num_rows($resul);

                        if($numLinhas == 0){
                            echo('<p>Você não possui nenhum livro catalogado.<a href="catalogar.php"> Catalogue aqui</a></p>');
                        }else{
                            while($contr = mysqli_fetch_array($resul)){
                    ?>
                                <table>
                                    <form action="#" method="POST">
                                        <input type="hidden" name="id" value="<?php echo($contr["id"]);?>">
                                        <tr>
                                            <th> <h2> Título: </h2> </th>
                                            <td>
                                                <input type="text" name="nome" id="nome" value="<?php echo($contr["nome"]);?>" required> 
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Gênero: </th> <th> Status: </th> </tr>
                                        <tr>
                                             <td>
                                                <select name="genero" id="genero">
                    <?php
                                            for($i = 0; $i < sizeof($generos);$i++){
                                                if($generos[$i] == $contr["genero"]){
                                                    echo('<option value="'.$generos[$i].'" selected>'.$generos[$i].'</option>');
                                                }else{
                                                    echo('<option value="'.$generos[$i].'">'.$generos[$i].'</option>');
                                                }
                                            }
                    ?>
                                                </select>  
                                            </td>
                                            <td> 
                                                <select name="status" id="status">
                    <?php
                                            for($i = 0; $i < sizeof($statusLivro);$i++){
                                                if($statusLivro[$i] == $contr["status"]){
                                                    echo('<option value="'.$statusLivro[$i].'" selected>'.$statusLivro[$i].'</option>');
                                                }else{
                                                    echo('<option value="'.$statusLivro[$i].'">'.$statusLivro[$i].'</option>');
                                                }
                                            }
                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Número de Páginas: </th> <th> Páginas Lidas: </th>
                                        </tr>
                                        <tr>
                                            <td> 
                                                <input type="number" name="numPag" id="numPag" value="<?php echo($contr["num_paginas"]);?>" min="0" required> 
                                            </td> 
                                            <td> 
                                                <input type="number" name="pagLidas" id="pagLidas" value="<?php echo($contr["pag_lidas"]);?>" min="0" max="<?php echo($contr["num_paginas"]);?>"> 
                                            </td>
                                        </tr>
                                        <tr> <th> Ano Lido: </th> </tr>
                                        <tr> 
                                            <td> 
                                            <input type="date" name="anoLido" id="anoLido" value="<?php echo($contr["ano_lido"]);?>" min="1900-01-01"> 
                                            </td>
                                        </tr>
                                        <tr> 
                                            <td colspan="2">
                                                <input type="submit" value="Alterar" name="alterar">
                                            </td>
                                        </tr>
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