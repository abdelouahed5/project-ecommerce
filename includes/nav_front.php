<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">ECOMMERCE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse  " id="navbarNav"  >
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Liste Categories</a>
        </li>        
      </ul>
   
    </div>
    <?php
  
    $idUser=$_SESSION["utilisateur"]["id"];
    // var_dump($_SESSION["panier"][$idUser]);
    
    // var_dump($idUser);
    
    
    if(isset($_SESSION["panier"][$idUser])){
      define("Product_count",count($_SESSION["panier"][$idUser]));
      ?>
       <a  href="panier.php" class=" btn float-end ">  <i class="fa fa-shopping-cart"></i> Panier ( <?php echo Product_count ?> ) </a> 
      <?php

    }
    else{

      ?>
       <a  href="panier.php" class=" btn float-end ">  <i class="fa fa-shopping-cart"></i> Panier ( 0 ) </a> 
      <?php
    }
    
  
    ?>
   
  </div>
</nav>