<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../asset/css/produit.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-...your-sha512-code-here..." crossorigin="anonymous" />
</head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Document</title>
</head>

<body>

  <?php 
    session_start();
    include('../includes/nav_front.php');
    

    
    ?>
  <div class="container">
    <?php
    require_once "../includes/connect.php";
     $idUtilisateur=$_SESSION["utilisateur"]["id"];
     $panier=$_SESSION["panier"][$idUtilisateur];
     
    


    
    ?>
    <h4>
     Panier (<?php echo Product_count ?>)
    
    </h4> 
     
    <div class="container">
      <div class="row">
        
       <?php
      
      
    //    var_dump($sql->debugDumpParams);
       
    //    var_dump($produits);
  
       if(empty($panier))
       {
        ?>

    <div  class=" btn btn-warning " >votre panier est vide </div>
        <?php
       }
       else{
        if(!empty($panier)){
          $prix=$_SESSION["prixTotale"][$idUtilisateur];
           $idProduits=array_keys($panier);
           $idProduits=implode(",",$idProduits);
           $produits=$db->query("SELECT * FROM produit where id in ($idProduits) ")->fetchAll(PDO::FETCH_ASSOC);
           $totale=$_SESSION["prixTotaleProduits"];
          
         }
         
                    
         if(isset($_POST["vider"])){
           $_SESSION["panier"][$idUtilisateur]=[];
           header("location:panier.php");
         }
       
         if(isset($_POST["valider"])){
           
           $commande=$db->query("INSERT INTO commande (id_client,Totale) VALUES ($idUtilisateur,$totale ) ");
           $idCommande=$db->lastInsertId();
           foreach($produits as $produit){
             $idproduit=$produit["id"];
             $prixTotaleProduit= $prix[$idproduit]*$panier[$idproduit];
            //  var_dump($prixTotaleProduit);
            $lign_commande=$db->query("INSERT INTO ligne_commande(id_produit,id_commande,prix,quantite,total) values ( $idproduit , $idCommande , $prix[$idproduit],$panier[$idproduit],$prixTotaleProduit ) ");
           
           }
           if($commande && $lign_commande){
             $_SESSION["panier"][$idUtilisateur]=[];
             ?>
             <div class="alert alert-success" role="alert">
             félicitation👏💕✔ validee succes votre commande 
             
           </div>
           <?php
           }
           
           
            
           
          
     }  
       
        ?>
        <div class="list-group">
        <?php
$prixTotaleProduits=0;

        foreach($produits as $produit){
          $prixTotaleProduit=$prix[$produit["id"]]* $panier[$produit["id"]];
          
         
          $prixTotaleProduits+=$prixTotaleProduit;
          
            
            ?>
         
       
         <a href="produit.php?id=<?= $produit["id"] ?>" class="list-group-item list-group-item-action flex-column align-items-start ">
         <div class="col-md-6">
            <img  src="../upload/produit/<?php echo $produit["image"] ?>" alt="<?php echo $produit["libelle"] ?>" class="card-img img-fluid w-25  "
             >
          </div>
         <div class="d-flex w-100 justify-content-between">
      <h5 class="mb-1"><?php echo $produit["libelle"]?> </h5> 
      <div>QUANTITE
      <span class="badge badge-primary bg-success  "><?php echo $panier[$produit["id"]] ?></span>
        </div>
    </div>
    <p class="mb-1"><?php echo $produit["description"] ?></p>
    <div class="   " >Prix : <?php  echo $prix[$produit["id"]]  ?>MAD </div>
    <br>
    <div class="badge badge-primary bg-success  " >Prix * Quantite = <?php  echo $prixTotaleProduit  ?>MAD </div>
    
  </a>

     



            <?php
           

        }
        
        $_SESSION["prixTotaleProduits"]=$prixTotaleProduits;

        ?>
        <button class="btn btn-dark  h1     ">
        
        Totale Prix Produits = <?php echo $prixTotaleProduits ?> MAD 
        <form action="" method="post" class=" mx ">
          <input type="submit" value="Valider" class="btn btn-success " name="valider">
          <input type="submit" onclick="return confirm('voullez vous vider le panier') " value="vide le panier" class="btn btn-danger" name="vider">
        </form>
        </button>
        </div>
        <?php
       }
       

       ?>
     
      </div>

    </div>



    
  
   
    
    <script src="../asset/js/produit/Counter.js"></script>

</body>

</html>