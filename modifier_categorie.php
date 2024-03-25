<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"  >
    <title>Modifier Categorie</title>
</head>
<body>
    <?php 
    include('includes/navbar.php');
    ?>
   <div class="container">
   <h4>Modifier Categorie</h4>
   <?php 
   try{
    require_once "includes/connect.php";
    $id=$_GET["id"];
    $sql=$db->prepare("SELECT  * FROM categorie where id=$id ");
    $sql->execute();
    $categorie=$sql->fetch(PDO::FETCH_ASSOC);
   
    //pour la modification:
          
        if(isset($_POST["Modifier"])){
            $libelle=$_POST["libelle"];
            $description=$_POST["description"];
            $date=$_POST["date_creation"];
            
            if(!empty($libelle) && !empty($description) && !empty($date) ){
                $sql=" UPDATE categorie SET libelle=?,description=?,date_creation=? WHERE id=? ";
                $stmt=$db->prepare($sql);
                $stmt->execute([$libelle,$description,$date,$id]);
                
                header("location:categories.php");
                
                 
            }
     


  

   }
}
   catch( PDOException $ex){
    die($ex->getMessage());
   }
   





   ?>
    
   <form method="post" >
    
        
        <input type="hidden" name="id" class="form-control " value="<?php echo $categorie["id"] ?>" >
        <br>
        <label class="form-label ">Libelle</label>
        <input type="text" name="libelle" class="form-control "  value="<?php echo $categorie["libelle"] ?>" >
        <br>
        <label class="form-label ">Description</label>
        <textarea name="description" class="form-control "  ><?php echo $categorie["description"] ?></textarea>
        <br>
        <label class="form-label " >date-creation</label>
        <!-- <input type="da" name="libelle" class="form-control "  > -->
        
        <input type="date" name="date_creation" value=<?php echo $categorie["date_creation"] ?> class="  form-control  " >

        <input type="submit" name='Modifier' value="Modifier Categorie" class="btn btn-primary my-3 "  >
    </form>
   </div>

   
    
    
</body>
</html>