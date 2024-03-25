<?php 
   try{
    require_once "includes/connect.php";
    $idCommande=$_GET["id"];
    $commande=$db->query("SELECT commande.*,utilisateur.login as 'login' FROM commande INNER JOIN utilisateur on commande.id_client=utilisateur.id where commande.id=$idCommande ")->fetch(PDO::FETCH_ASSOC);
   
    
    
   }
   catch( PDOException $ex){
    die($ex->getMessage());
   }
   ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"  >
    <title>commande // N: <?php echo $idCommande ?> </title>
</head>
<body>
    <?php 
    include('includes/navbar.php');
    ?>
   <div class="container">
   <br>
   
   <?php
   
   $sqlstatelign_commande=$db->prepare("SELECT ligne_commande.*,produit.libelle,produit.image  FROM ligne_commande INNER JOIN produit on ligne_commande.id_produit=produit.id where id_commande=? ");
   $sqlstatelign_commande->execute([$idCommande]); 
   $lign_commandes=$sqlstatelign_commande->fetchAll(PDO::FETCH_ASSOC);
//    var_dump($lign_commandes);
   ?>
   <br>
   <br>

<table class="table table-striped table-hover  ">

  
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

    <tr>
        <td><?php echo $commande["id"] ?></td>
        <td><?php echo $commande["login"] ?></td>
        <td><?php echo $commande["Totale"]  ?> MAD</td>
        <td><?php echo $commande["date"] ?></td>
        <td>
           <a class="btn btn-primary"  href="commandes.php?id=<?php $commande["id"] ?>">Liste Commandes </a>
        </td>

    </tr>

  
  </tbody>
</table>


   
   <br>
   <br>
   <h4>Detaills commande </h4>

<table class="table table-striped table-hover  ">

  <caption>destaills commande</caption>
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">produit</th>
      <th scope="col">image</th>
      <th scope="col">prix</th>
      <th scope="col">quantite</th>
      <th scope="col">totale</th>

    </tr>
  </thead>
  <tbody>
<?php
foreach($lign_commandes as $lign_commande){
    ?>
        <tr>
        <td><?php echo $lign_commande["id"] ?></td>
        <td><?php echo $lign_commande["libelle"] ?></td>
        <td><img width="80" class="border border-dark mt-1 rounded-circle " src="upload/produit/<?php echo $lign_commande["image"] ?>" alt=""></td>
        <td><?php echo $lign_commande["prix"]  ?> MAD</td>
        <td><?php echo $lign_commande["quantite"] ?></td>
        <td><?php echo $lign_commande["total"] ?></td>


       

    </tr>
    <?php
}
  ?>
  </tbody>
</table>




   </div>
    
  
    
    
</body>
</html>