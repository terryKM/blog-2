<div class="pc row">
    <div class="col-sm-9" style="box-shadow: 1px 0 0 black">
        <?php
            require_once './include/db.php';
            require_once './functions/functions.php';

            $db = Database::connect();

            $sql = $db -> query('SELECT count(ID_ARTICLE) as nbrArt FROM t_articles');
            $data = $sql -> fetch();
            $nbrArt = $data['nbrArt'];
            isset($_GET['p']) ? $pagec = $_GET['p'] : $pagec = 1;
            $perpage = 4 ;
            $nbPage = ceil($nbrArt/ $perpage);
            $index = ($pagec - 1 ) * $perpage;
            $query ="SELECT * FROM t_articles ORDER by ARTDATE DESC LIMIT $index,$perpage";
            $sql = $db -> query($query);
            while($row = $sql -> fetch()){
                $post = '<section class="post"><h3 style="font-family: fantasy"> '. findCategories($row['ID_ARTICLE'], $db) .'</h3>';
                $post .= '<h2> '. $row['ARTTITRE'] . '</h2>  ';
                $post .= '<h4> '. $row['ARTCHAPO'] . ' -- Posted on '. $row['ARTDATE'].' by <span style="font-weight: bold;text-decoration: underline" ">'.findAuthor($row['ID_ARTICLE'],$db).'</span> </h4>';
                $post .= '<div class="article"> '. html_entity_decode($row['ARTCONTENU']) . '</div></section>';
                echo $post;
                Database::disconnect();
            }
            $pagination = "<div style=\"text-align: right\">";
            for ($i = 1 ; $i <= $nbPage ; $i++){
                $pagination .="<a href=\"index.php?p=$i\"> $i /</a>";
            }
            $pagination .= "</div>";
            echo $pagination;

        ?>
    </div>
    <div class="col-sm-3" style="height: 400vh ">
        <section class="blockL">
            <h2>Social</h2>
            <ul class="list-inline icon-circle icon-zoom social-icons">
                <li> <a href="#"><i class="fa fa-github"></i></a></li>
                <li> <a href="#"><i class="fa fa-linkedin"></i></a></li>
                <li> <a href="#"><i class="fa fa-facebook"></i></a></li>
                <li> <a href="#"><i class="fa fa-twitter"></i></a></li>
            </ul>
            <hr>
        </section>
        <section class="blockL">
            <h2> 5 Derniers articles </h2>
            <?php
                $db        = Database::connect();
                $sql2      = $db -> query('SELECT * FROM `t_articles` ORDER BY `ARTDATE` DESC LIMIT 5');
                $articles  = $sql2 -> fetchAll();
                foreach ($articles as $article ){
                    $last  = "<h3 style='font-size: 28px'>" . $article['ARTTITRE'] ."</h3>";
                    $last .= '<p style = "text-align:left;font-size: 13px" > '. $article['ARTDATE'] .' ';
                    $last .= '<span style="float: right;font-weight: bold; text-decoration:underline;"> By  '. findAuthor($article['ID_ARTICLE'],$db) . ' </span></p><hr>';
                    echo $last;
                }
                Database::disconnect();
            ?>
        </section>
        <section class="blockC">
            <h2> Catégories </h2>
            <ul class="list-horizontal">
            <?php
                $db   = Database::connect();
                $sql3 = $db -> query('SElECT * FROM t_categories');
                $categories = $sql3 -> fetchAll();
                foreach($categories as $category){
                    echo "<li style='text-align: left;font-family: 'Roboto condensed'><h3>" . $category['CATLIBELLE'] ."</h3></li> <hr>";
                }
            ?>
            </ul>
            <hr>
        </section>
    </div>
</div>