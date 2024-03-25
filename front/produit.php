<!DOCTYPE html>
<html lang="en">
<?php
        session_start();
        require_once "../includes/connect.php";
    
      $id=$_GET["id"];
      
      $sql=$db->prepare("SELECT * FROM produit where id=$id ");
       $sql->execute();
       $produit=$sql->fetch(PDO::FETCH_OBJ);
    
    
  
   ?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../asset/css/produit.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <title> Produit
    <?php echo $produit->libelle ?>
  </title>
</head>

<body>
  <?php 
    include('../includes/nav_front.php');
    ?>

  <div class="container">
    <br>
    
    <h4> Produit <?php echo $produit->libelle ?> </h4>
    <div class="row">
     
          <div class="col-md-6">
            <img  src="../upload/produit/<?php echo $produit->image ?>" alt="<?php echo $produit->libelle ?>" class="card-img img-fluid w-75  "
             >
          </div>
          <div class="col-md-6">
            <div class="card-body">
              <h1>
              <button class="card-title btn badge bg-light text-dark  position-relative  "><?php echo $produit->libelle ?>
              <?php 
             $discount=$produit->discount;
             $valdiscunt=0;
             if(!empty ( $discount)){
              $valdiscunt=$discount;
              ?>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              <?php echo $valdiscunt ?> %
              <span class="visually-hidden">unread messages</span>
              </span>
            <?php
             }
             else{

                 ?>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
              <?php echo $valdiscunt ?> %
              <span class="visually-hidden">unread messages</span>
              </span>
            <?php

             }
            
             ?>
             
            
</button>
</h1>
              
            
              <p class="card-text"><?php echo $produit->description ?></p>
              
               <div class=" d-flex " >
              <?php
               $prix=$produit->prix;
               $discount=$produit->discount;
               $totale=$prix;
               
              
              if(!empty ( $discount)){
                $totale=$prix-(($prix*$discount)/100);
                ?>
                <h2 class=" mx-1  " ><span class=" badge bg-danger  " ><strike><?php echo $prix ?> MAD</strike></span></h2>
                <h2 class=" mx-1  " ><span class=" badge bg-success  " > <?php echo $totale  ?> MAD </span></h2>
                <?php
              }
              else{
               $totale=$prix;
               ?>
               <h2><span class=" badge bg-success  " > <?php echo $totale  ?> MAD </span></h2>
              <?php
              }
              $idUtilisateur=$_SESSION["utilisateur"]["id"];
              $_SESSION["prixTotale"][$idUtilisateur][$produit->id]=$totale;
              // var_dump( $_SESSION["prixTotale"][$idUtilisateur][$produit->id]);
              
              
              ?>
              </div>
              
              <p class="card-text"><small class="text-muted"> <?php echo date_format(new DateTime($produit->date_creation), 'Y-m-d'); ?></small></p>
              
             
            </div>
            <div class=" card-footer  " >
              <?php 
              $idProduit=$produit->id;
              include '../includes/front/counter.php'?>
              </div>
          </div>
        </div>
      </div>
    </div>



  </div>
  <script src="../asset/js/produit/Counter.js"></script>

</body>

</html>