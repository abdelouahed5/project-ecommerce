<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"  >
    <title>Liste Categorie</title>
</head>
<body>
    <?php 
    include('includes/navbar.php');
    ?>
   <div class="container">
   <br>
   <h4>Liste Categories</h4>
   <br>
   
   <a href="Ajouter_categorie.php" class=" btn btn-primary  ">Ajouter categorie</a>
   <br>
   <br>
   <?php 
   try{
    require_once "includes/connect.php";
    $stmt=$db->prepare("SELECT * FROM categorie ");
    $stmt->execute();
    $categories=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    

   }
   catch( PDOException $ex){
    die($ex->getMessage());
   }
   ?>
<table class="table table-striped table-hover  ">

  <caption>List Categories</caption>
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">libelle</th>
      <th scope="col">description</th>
      <th scope="col">date-creation</th>
      <th scope="col">operation</th>

    </tr>
  </thead>
  <tbody>
    
    <?php
    foreach($categories as $categorie){
    ?>
    <tr>
        <td><?php echo $categorie["id"] ?></td>
        <td><?php echo $categorie["libelle"] ?></td>
        <td><?php echo $categorie["description"] ?></td>
        <td><?php echo $categorie["date_creation"] ?></td>
        <td>
            <a href="modifier_categorie.php?id=<?php echo $categorie["id"] ?>" class=" btn btn-success  ">Modifier</a>
            <a href="supprimer_categorie.php?id=<?php echo $categorie["id"] ?>" onclick="return confirm('voulez vous vraiment supprimer cette categorie 👀👀 ') "  class=" btn btn-danger  ">Supprimer</a> 

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