<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"  >
    <title>Liste Produit</title>
</head>
<body>
    <?php 
    include('includes/navbar.php');
    ?>
   <div class="container">
   <br>
   <h4>Liste Produit</h4>
   <br>
   
   <a href="Ajouter_produit.php" class=" btn btn-primary  ">Ajouter Produit</a>
   <br>
   <br>
   <?php 
   try{
    require_once "includes/connect.php";
    $stmt=$db->prepare(" SELECT produit.* , categorie.libelle as libelle_categorie FROM produit inner join categorie where produit.id_categorie=categorie.id ");
    $stmt->execute();
    $produits=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    

   }
   catch( PDOException $ex){
    die($ex->getMessage());
   }
   ?>
<table class="table table-striped table-hover  ">

  <caption>List Produit</caption>
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">libelle</th>
      <th scope="col">prix</th>
      <th scope="col">Discount</th>
      <th scope="col">id-categorie</th>
      <th scope="col">Description</th>
      <th scope="col">Image</th>
      <th scope="col">date-creation</th>
      <th scope="col">operation</th>

    </tr>
  </thead>
  <tbody>
    
    <?php
    foreach($produits as $produit){
    ?>
    <tr>
        <td><?php echo $produit["id"] ?></td>
        <td><?php echo $produit["libelle"] ?></td>
        <td><?php echo $produit["prix"] ?> DH</td>
        <td><?php echo $produit["discount"]  ?> %</td>
        <td><?php echo $produit["libelle_categorie"] ?></td>
        <td><?php echo $produit["description"] ?></td>
        <td><img width="80" class="border border-dark mt-1 rounded-circle " src="upload/produit/<?php echo $produit["image"] ?>" alt=""></td>
        <td><?php echo $produit["date_creation"] ?></td>
        <td>
            <a href="modifier_produit.php?id=<?php echo $produit["id"] ?>" class=" btn btn-success  ">Modifier</a>
            <a href="supprimer_produit.php?id=<?php echo $produit["id"] ?>" onclick=" return confirm ('voulez vous vraiment supprimer cette produit 👀👀 ') "   class=" btn btn-danger  ">Supprimer</a> 

        </td>

    </tr>
    <?php
    }
    ?>
  
  </tbody>
</table>




   </div>
    
  
    
    
</body>
</html>