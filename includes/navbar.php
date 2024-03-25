<?php
session_start();
$connect=false;
if(isset($_SESSION["utilisateur"])){
  $connect=true;
}

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ECOMMERCE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Ajouter Utilisateur</a>
        </li>
        <?php
        if($connect){
          ?>
       
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="categories.php">Liste Categories</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="produits.php">Liste Produits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="Ajouter_categorie.php">Ajouter Categorie</a>
        </li>

           <li class="nav-item">
          <a class="nav-link " aria-current="page" href="Ajouter_produit.php">Ajouter Produit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="commandes.php">Commandes</a>
        </li>
         <li class="nav-item">
          <a class="nav-link float-end  " aria-current="page" href="Deconnexion.php">Deconnexion</a>
        </li>
        
          <?php
        }
        else{
          ?>
          <li class="nav-item">
          <a class="nav-link" href="connexion.php">Connexion</a>
        </li>
          <?php

        }
        ?>
        
      </ul>
    </div>
  </div>
</nav>
