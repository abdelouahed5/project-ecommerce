<?php
try{
    require_once "includes/connect.php"; 
    $id=$_GET["id"];
    $sql= " DELETE FROM produit WHERE id=? ";
    $stmt=$db->prepare($sql);
    $supprimer=$stmt->execute([$id]);
    header("location:produits.php");

}
catch(PDOException $ex)
{ 
    die($ex->getMessage());
}

?>