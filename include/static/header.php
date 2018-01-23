<header>

    <h1 class ="brand"> <a href="index.php" style="color: #FFF;"> NFactory Blog</a></h1>
    <ul>
        <li class="active"><a href="index.php?page=accueil">Accueil</a></li>

        <?php
        if(session_status() == PHP_SESSION_NONE){
            session_start();
        }
        if (!isset($_SESSION['auth'])) {
            echo("<li><a href=\"index.php?page=inscription\">Inscription</a></li>");
            echo("<li><a href=\"index.php?page=login\">Login</a></li>");
        }
        else {
            echo("<li><a href=\"index.php?page=admin\">Admin</a></li><li><a href=\"index.php?page=moncompte\">Mon compte</a></li>");
            echo ("<li><a href=\"index.php?page=logout\">Logout</a></li>");
        }
        ?>
    </ul>
</header>

   