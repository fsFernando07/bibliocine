<header>
    <?php
        session_start();
        if(!isset($_SESSION['id'])){
            header('location: ../../index.php');
        }
    ?>
    <section>
        <img src="/bibliocine/src/logoBranca.png" class="logo" />
    </section>
    <section class="headerHome">
        <a href="/bibliocine/paginas/home.php" class="linkHeader"> Home </a>
        <a href="/bibliocine/paginas/filmes/filmes.php" class="linkHeader"> Filmes </a>
        <a href="/bibliocine/paginas/livros/livros.php" class="linkHeader"> Livros </a>
        <a href="/bibliocine/paginas/series/series.php" class="linkHeader"> Series </a>
        <a href="/bibliocine/paginas/usuarios.php" class="usuario"> <img src="/bibliocine/src/usuario.png" class="usuario" /> </a>
    </section>
</header>