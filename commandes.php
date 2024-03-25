<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"  >
    <title>Liste Commandes</title>
</head>
<body>
    <?php 
    include('includes/navbar.php');
    ?>
   <div class="container">
   <br>
   <h4>Liste commandes</h4>
   
   <br>
   <br>
   <?php 
   try{
    require_once "includes/connect.php";
    $stmt=$db->prepare("SELECT commande.*,utilisateur.login as 'login' FROM commande INNER JOIN utilisateur on commande.id_client=utilisateur.id order by commande.date ");
    $stmt->execute();
    $commandes=$stmt->fetchAll(PDO::FETCH_ASSOC);
    
    

   }
   catch( PDOException $ex){
    die($ex->getMessage());
   }
   ?>
<table class="table table-striped table-hover  ">

  <caption>List commandes</caption>
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">id_client</th>
      <th scope="col">totale</th>
      <th scope="col">date-creation</th>
      <th scope="col">operation</th>

    </tr>
  </thead>
  <tbody>
    
    <?php
    foreach($commandes as $commande){
    ?>
    <tr>
        <td><?php echo $commande["id"] ?></td>
        <td><?php echo $commande["login"] ?></td>
        <td><?php echo $commande["Totale"]  ?> MAD</td>
        <td><?php echo $commande["date"] ?></td>
        <td>
           <a class="btn btn-primary"  href="commande.php?id=<?php echo $commande["id"] ?>">Afficher detaille </a>
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