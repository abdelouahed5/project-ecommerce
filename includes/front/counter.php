<?php
$idUtilisateur=$_SESSION["utilisateur"]["id"];
// if(!isset($idUtilisateur)){
    
//         header("location:../connexion.php"); 

// }
$qty=$_SESSION["panier"][$idUtilisateur][$idProduit] ?? 0 ;
$btn=$qty==0 ? "Ajouter":"Modifier";

?>
<div >
           <form action="Ajouter_panier.php" method="post" class="counter d-flex ">
           <button onclick="return false" class=" btn btn-primary mx-3 counter-moin  ">-</button>
           <input type="hidden" name="id" value="<?= $idProduit ?>">
            <input type="number" name="qty" id="qty" class=" form-control  " value="<?= $qty ?>" max="99">
            <button onclick="return false" class=" btn btn-primary mx-3 counter-plus  ">+</button>
           <input type="submit" class="btn btn-success " value="<?= $btn ?>" name="Ajouter">
          </form>
          </div>


          