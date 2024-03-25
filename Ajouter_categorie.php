<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"  >
    <title>Ajouter_Categorie</title>
</head>
<body>
    <?php 
    include('includes/navbar.php');
    ?>
   <div class="container">
   <h4>Ajouter Categorie</h4>
   <?php 
   try{
    require_once "includes/connect.php";
    if(isset($_POST["Ajouter"])){
        $libelle=$_POST["libelle"];
        $description=$_POST["description"];
        
        if(!empty($libelle) && !empty($description)){
            // var_dump($libelle);
            // var_dump($description);
            $sql="INSERT INTO categorie(libelle,description) VALUES (?,?) ";
            $stmt=$db->prepare($sql);
            $stmt->execute([$libelle,$description]);
            
            header("location:categories.php");
            // <div class="container">
            // <div class="alert alert-success" role="alert">
            //      Ajouter Succes la categorie <?php echo $libelle 
            //      </div>
            // </div>
             
        }
        else{
            ?>
               <div class="container">
               <div class="alert alert-danger" role="alert">
                s'il vous plait, libelle et description  obligatoire 
              </div>
               </div>
            <?php
            }
    }


   }
   catch( PDOException $ex){
    die($ex->getMessage());
   }
   





   ?>
    
   <form method="post" >
        <label class="form-label ">Libelle</label>
        <input type="text" name="libelle" class="form-control "  >
        <br>
        <label class="form-label ">Description</label>
        <textarea name="description" class="form-control "></textarea>

        <input type="submit" name='Ajouter' value="Ajouter Categorie" class="btn btn-primary my-3 "  >
    </form>
   </div>

   
    
    
</body>
</html>