<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"  >
    
    <title>Document</title>
</head>
<body>
    <?php 
    session_start();
    
    if(!isset($_SESSION["utilisateur"])){
        header("location:../connexion.php");
    }
    
    
    include('../includes/nav_front.php');
    ?>
   <div class="container">
    <?php
    require_once "../includes/connect.php";
    $sql=$db->prepare(" SELECT * FROM categorie ");
    $sql->execute();
    $categories=$sql->fetchAll(PDO::FETCH_OBJ);
    // var_dump($categories);
    ?>
    <br>
    <h4> liste Categories</h4>
    <ul class="list-group">
        <?php
        foreach($categories as $categorie){
        ?>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="categories.php?id=<?= $categorie->id ?>  " class=" text-decoration-none  stretched-link " ><?= $categorie->libelle ?></a>
            <button class=" btn btn-primary badge badge-primary badge-pill " ><?php 
     $sql = $db->prepare("SELECT produit.* FROM produit
     INNER JOIN categorie on produit.id_categorie = categorie.id where categorie.id=? ");
    $id=$categorie->id;
    $sql->execute([$id]);
    $produits=$sql->fetchAll(PDO::FETCH_OBJ);

   echo count($produits);
    ?></button>
        </li>
        <?php
        }
        ?>
</ul>



   </div>
  
    
</body>
</html>
