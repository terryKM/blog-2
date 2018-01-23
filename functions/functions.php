<?php
    function callPage() {
        if (isset($_GET['page'])) {
            if  ($_GET['page'] == "")
                $page = "accueil";
            else
                $page = $_GET['page'];
        }
        else {
            $page = "accueil";
        }
        $page = "./include/" . $page . ".inc.php";
        $incFiles = glob("./include/*.inc.php");
        if (in_array($page, $incFiles)) {
            include($page);
        }
        else {
            include("./include/default.inc.php");
        }
    }

    function debug($variable){
        echo '<pre>' . print_r($variable,true) . '</pre>';
    }

    function str_random($length){
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    function findCategories($idarticle, $pdo){
            $req = $pdo -> prepare('SELECT * FROM t_categories LEFT JOIN t_categories_has_t_articles ON ID_CATEGORIE = T_CATEGORIES_ID_CATEGORIE WHERE T_ARTICLES_ID_ARTICLE = ?');
            $req -> execute([$idarticle]);
            $cat = '<ul>';
            while($row = $req -> fetch()){
                $cat .=  "<li>" . $row['CATLIBELLE'] . "</li>"; ;
            };
            $cat .= "</ul>";
            return $cat;
    }

    function findRole($idrole, $pdo){
        $req = $pdo -> prepare('SELECT * FROM t_roles WHERE ID_ROLE = ?');
        $req -> execute([$idrole]);
        $row = $req -> fetch();
        return $row['ROLEDESI'] ;
    }

    function findIdCategorie($category, $pdo){
        $req = $pdo -> prepare('SELECT ID_CATEGORIE FROM  t_categories  WHERE CATLIBELLE = ?');
        $req -> execute([$category]);
        $row = $req -> fetch();
        return $row['ID_CATEGORIE'];
    }

    function findAuthor($idarticle , $db){
        $req = $db -> prepare('SELECT * FROM `t_users`left join t_articles_has_t_users on ID_USER = t_users_id_user WHERE t_articles_id_article = ?');
        $req -> execute([$idarticle]);
        $row = $req -> fetch();
        return $row['PSEUDO'];
    }

    function checkInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function isChecked($category, $idarticle , $db){

        $req = $db -> prepare('SELECT * FROM t_categories LEFT JOIN t_categories_has_t_articles ON ID_CATEGORIE = T_CATEGORIES_ID_CATEGORIE WHERE T_ARTICLES_ID_ARTICLE = ? AND CATLIBELLE = ?');
        $req -> execute([$idarticle,$category]);
        $res = $req-> fetch();
            if($res){
                $option = $category .'" checked>';
            }else{
                $option = $category . '">';
            }
        return $option ;
    }

    function returnXWords($article, $length){

        if(strlen($article) > $length) $article = substr($article, 0, $length).'...';
        return $article;

        }


