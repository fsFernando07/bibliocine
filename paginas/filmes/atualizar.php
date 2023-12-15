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
                        if(isset($_POST["alterar"])){
                            $id = $_POST["id"];
                            $nome = $_POST["nome"];
                            $genero = $_POST["genero"];
                            $status = $_POST["status"];
                            $anoLanc = $_POST["anoLanc"];
                            $anoAssis = $_POST["anoAssis"];

                            if($id == '' || $nome == '' || $genero == '' || $status == '' || $anoLanc == ''){
                                echo("Um ou mais campos está vazio");
                            }else{
                                if($anoAssis == ''){
                                    $anoAssis = '0000-00-00';
                                }
                                $mysqlUp = 'UPDATE filmes SET nome = "'. $nome .'", genero = "'. $genero .'", status = "'. $status .'", ano_lanc = "'. $anoLanc.'", ano_assis = "'. $anoAssis.'" WHERE (id = '. $id .') && (id_usuario = '. $_SESSION["id"].');';

                                mysqli_query($conexao,$mysqlUp);

                                header('location: ./filmes.php');

                            }
                        }

                        $mysqlSel = 'SELECT * FROM filmes WHERE id_usuario = '. $_SESSION['id'].' ORDER BY genero;';

                        $resul = mysqli_query($conexao, $mysqlSel);

                        $numLinhas = mysqli_num_rows($resul);

                        if($numLinhas == 0){
                            echo('<p>Você não possui nenhum filme catalogado.<a href="catalogar.php"> Catalogue aqui</a></p>');
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
                                            for($i = 0; $i < sizeof($statusFilme);$i++){
                                                if($statusFilme[$i] == $contr["status"]){
                                                    echo('<option value="'.$statusFilme[$i].'" selected>'.$statusFilme[$i].'</option>');
                                                }else{
                                                    echo('<option value="'.$statusFilme[$i].'">'.$statusFilme[$i].'</option>');
                                                }
                                            }
                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th> Ano de Lançamento: </th> <th> Ano Assistido: </th>
                                        </tr>
                                        <tr>
                                            <td> 
                                                <input type="date" name="anoLanc" id="anoLanc" value="<?php echo($contr["ano_lanc"]);?>" required> 
                                            </td> 
                                            <td> 
                                                <input type="date" name="anoAssis" id="anoAssis" value="<?php echo($contr["ano_assis"]);?>" min="<?php echo($contr["ano_lanc"]);?>"> 
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