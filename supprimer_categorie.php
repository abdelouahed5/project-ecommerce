<?php
try{
    require_once "includes/connect.php"; 
    $id=$_GET["id"];
    $sql= " DELETE FROM categorie WHERE id=? ";
    $stmt=$db->prepare($sql);
    $supprimer=$stmt->execute([$id]);
    header("location:categories.php");

}
catch(PDOException $ex)
{ 
    die($ex->getMessage());
}

?>