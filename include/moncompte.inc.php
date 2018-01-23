
    <div class="pc row">
        <?php
            if(isset($_SESSION['auth'])){
                if(session_status() == PHP_SESSION_NONE){
                    session_start();
                }
                $welcome = "<p> Bienvenue sur votre espace membre " . $_SESSION['auth']['USERNAME'] . ' ' .$_SESSION['auth']['USERFNAME']."<br>"  ;
//                $welcome .= " Nombre de visites = " . $_COOKIE['visite'];
                echo $welcome;
            } else {
                echo '<h2>Veuillez vous connecter </h2>';
            }

        ?>
    </div>