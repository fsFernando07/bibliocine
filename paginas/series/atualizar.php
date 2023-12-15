<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/bibliocine/src/IconePreto.ico" type="image/x-icon">
        <title> Séries </title>
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
                <h1> Séries </h1>
                <section class="tabelas">
                    <?php
                        require_once('../conexao.php');
                        if(isset($_POST["alterar"])){
                            $id = $_POST["id"];
                            $nome = $_POST["nome"];
                            $genero = $_POST["genero"];
                            $status = $_POST["status"];
                            $totalTemp = $_POST["totalTemp"];
                            $epParad = $_POST["epParad"];
                            $tempParad = $_POST["tempParad"];
                            $anoAssis = $_POST["anoAssis"];
                            $anoLanc = $_POST["anoLanc"];

                            if($id == '' || $nome == '' || $genero == '' || $status == '' || $totalTemp == '' || $anoLanc == ''){
                                echo("Um ou mais campos está vazio");
                            }else{
                                if($anoAssis == ''){
                                    $anoAssis = '0000-00-00';
                                }
                                $mysqlUp = 'UPDATE series SET nome = "'. $nome .'", genero = "'. $genero .'", status = "'. $status .'", total_temp = '. $totalTemp.', episodio_parado = '. $epParad.', temp_parada = '.$tempParad.',ano_ass = "'.$anoAssis.'",ano_lanc = "'.$anoLanc.'" WHERE (id = '. $id .') && (id_usuario = '. $_SESSION["id"].');';

                                mysqli_query($conexao,$mysqlUp);

                                header('location: ./series.php');

                            }
                        }

                        $mysqlSel = 'SELECT * FROM series WHERE id_usuario = '. $_SESSION['id'].' ORDER BY genero;';

                        $resul = mysqli_query($conexao, $mysqlSel);

                        $numLinhas = mysqli_num_rows($resul);

                        if($numLinhas == 0){
                            echo('<p>Você não possui nenhuma série catalogada.<a href="catalogar.php"> Catalogue aqui</a></p>');
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
                                            for($i = 0; $i < sizeof($statusSerie);$i++){
                                                if($statusSerie[$i] == $contr["status"]){
                                                    echo('<option value="'.$statusSerie[$i].'" selected>'.$statusSerie[$i].'</option>');
                                                }else{
                                                    echo('<option value="'.$statusSerie[$i].'">'.$statusSerie[$i].'</option>');
                                                }
                                            }
                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Total de Temporadas: </th> <th> Episódio Parado: </th>
                                        </tr>
                                        <tr>
                                            <td> 
                                                <input type="number" name="totalTemp" id="totalTemp" value="<?php echo($contr["total_temp"]);?>" min="1" required> 
                                            </td> 
                                            <td> 
                                                <input type="number" name="epParad" id="epParad" value="<?php echo($contr["episodio_parado"]);?>" min="0"> 
                                            </td>
                                        </tr>
                                        <tr> <th> Temporada Parada: </th><th> Ano Assistido: </th></tr>
                                        <tr>
                                            <td>
                                                <input type="number" name="tempParad" id="tempParad" value="<?php echo($contr["temp_parada"]);?>" min="1">
                                            </td>
                                            <td>
                                                <input type="date" name="anoAssis" id="anoAssis" value="<?php echo($contr["ano_ass"]);?>" min="<?php echo($contr["ano_lanc"]);?>">
                                            </td>
                                        </tr>
                                        <tr> <th> Ano de Lançamento: </th> </tr>
                                        <tr> 
                                            <td> 
                                            <input type="date" name="anoLanc" id="anoLanc" value="<?php echo($contr["ano_lanc"]);?>" min="1900-01-01"> 
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