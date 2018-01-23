<?php

require_once './include/db.php';
require_once './functions/functions.php';

if(isset($_POST['Addcategory']) ){

    if(!empty($_POST['category'])) {
    $category   = $_POST['category'];
    $connexion = Database::connect();
    $sql = $connexion -> prepare('INSERT into t_categories (CATLIBELLE) VALUES(?)');
    $sql -> execute(array($category));
    $success_cat = "<div class='alert alert-success'>Catégorie ajoutée</div>";
    }else
    $success_cat = "<div class='alert alert-danger'>Veuillez vérifier les informations saisies</div>";
}


include "./include/forms/formAddCategory.php";
