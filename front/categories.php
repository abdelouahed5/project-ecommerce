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
    $id = $_GET["id"];
    $sql = $db->prepare("SELECT * FROM  categorie  where id=? ");
    $sql->execute([$id]);
    $categorie=$sql->fetch(PDO::FETCH_OBJ);
    

    
    ?>
    <br>
    <h4>
      <?php 
     $sql = $db->prepare("SELECT produit.* FROM produit
     INNER JOIN categorie on produit.id_categorie = categorie.id where categorie.id=? ");

    $sql->execute([$id]);
    $produits=$sql->fetchAll(PDO::FETCH_OBJ);

    ?>

      <button type="button" class="btn  position-relative">
        <h2>
          <?php echo $categorie->libelle  ?>
        </h2>
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          <?php echo count($produits)?>
          <span class="visually-hidden"></span>
        </span>
      </button>
    </h4>
    <div class="container">
      <div class="row">
        <?php
      foreach($produits as $produit){
    $idProduit=$produit->id ;
    
 ?>

        <div class="card col-md-4    ">
          <img class="card-img-top" width="280" height="230" src="../upload/produit/<?php echo $produit->image ?>"
            alt="Card image cap">
          <div class="card-body">
            <a href="produit.php?id=<?= $idProduit ?>" class="btn  stretched-link">afficher detaille</a>
            <h5 class="card-title">
              <?php echo $produit->libelle ?>
            </h5>

            <p class="card-text">
              <?php echo $produit->prix ?> MAD
            </p>
            <p class="card-text"><small class="text-muted">
                <?php echo date_format(new DateTime($produit->date_creation), 'Y-m-d'); ?>
              </small></p>

          </div>
          <div class="card-footer  " style=" z-index:10">
         <?php include("../includes/front/counter.php")?>
        </div>
        </div>
       


        <?php
      }
      if(empty($produits)){
        ?>
        <span class="alert alert-danger">pas de produits pour l'instant </span>
        <?php
      }
      ?>

      </div>

    </div>



    
   
    
    <script src="../asset/js/produit/Counter.js"></script>

</body>

</html>