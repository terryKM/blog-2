<?php
    if(!empty($_POST) && !empty($_POST['title']) && !empty($_POST['article'])){
        require_once('./include/db.php');
        $titre = $_POST['title'];
        $chapo = $_POST['chapo'];
        $article = htmlentities($_POST['article']);
        $pdo = Database::connect();
        $req = $pdo -> prepare('INSERT into t_articles(ARTTITRE , ARTCHAPO, ARTCONTENU, ARTDATE) VALUES(?,?,?,?)');
        $req -> execute([$titre ,$chapo, $article,date('Y-m-d H-m-s')]);

        $id = $pdo -> lastInsertId();
        $user_id   = $_SESSION['auth']['ID_USER'];
        $user_role = $_SESSION['auth']['T_ROLES_ID_ROLE'];
        $stmt4     = $pdo -> prepare('INSERT INTO t_articles_has_t_users (T_ARTICLES_ID_ARTICLE ,T_USERS_ID_USER ,T_USERS_T_ROLES_ID_ROLE) VALUES (?,?,?)');
        $stmt4     -> execute([$id, $user_id,$user_role]);
        Database::disconnect();
    }
include ('./include/forms/formArticle.php');