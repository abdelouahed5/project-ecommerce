<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"  >
    <title>Ajouter_produit</title>
</head>
<body>
    <?php 
    include('includes/navbar.php');
    ?>
   <div class="container">
   <h4>Ajouter Produit</h4>
   <?php
  try{
    require_once "includes/connect.php";
    if (isset($_POST["Ajouter"])){
        $libelle=$_POST["libelle"];
        $prix=$_POST["prix"];
        $discount=$_POST["discount"];
        $categorie=$_POST["categorie"];
        $date=date("Y-m-d");
        $description=$_POST["description"];
        //recupertaion de file 
       $filename='produit.png';
       if(!empty($_FILES["image"]["name"])){
         $image=$_FILES['image']["name"];
        $filename=uniqid().$image;
         move_uploaded_file($_FILES["image"]['tmp_name'],'upload/produit/'.$filename);
         
        }
        
        if(!empty($libelle) && !empty($prix) && !empty($categorie) ){
          
            $stmt=$db->prepare("INSERT INTO produit VALUES (null,?,?,?,?,?,?,?) ");
            $stmt->execute([$libelle,$prix,$discount,$categorie,$date,$description,$filename]);
            
            header("location:produits.php");
            
            // <div class="container">
            // <div class="alert alert-success" role="alert">
            //      Ajouter le produit <?php echo $libelle 
            //      </div>
            // </div>
             
        }
        else{
            ?>
               <div class="container">
               <div class="alert alert-danger" role="alert">
                s'il vous plait, tout les champ  obligatoire 
              </div>
               </div>
            <?php
            }


     
    }

  }
  catch(PDOException $ex){
    die($ex->getMessage());
  }
   ?>

   <form method="post" enctype="multipart/form-data" >
        <label class="form-label ">Libelle</label>
        <input type="text" name="libelle" class="form-control "  >
        <br>
        <label class="form-label ">Prix</label>
        <input type="number" name="prix" step="0.1" class="form-control " min="0" >
        <br>
        <label class="form-label ">Discount</label>
        <input type="range" value=0 name="discount" class="form-control "  min="0" max="99">
        <br>
        <label  class=""form-label  >Description</label>
        <textarea name="description" class=" form-control " ></textarea>
        <br>
        <label class="form-label ">Image</label>
        <input type="file" name="image" class="form-control "  >
        <br>
        <?php
         $data=$db->prepare("SELECT * FROM categorie ");
         $data->execute();
         $categories=$data->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label class="form-label ">Choissez categorie</label>
        <select name="categorie"  class="form-control">
       <option value="id1">Choissez categorie</option>
       <?php
       foreach($categories as $ctg){
        echo "<option value=".$ctg['id'].">".$ctg['libelle']."</option>";
       }
        ?>
      
       </select>
        <input type="submit" name='Ajouter' value="Ajouter Produit" class="btn btn-primary my-3 "  >
    </form>
   </div>
   
    
    
</body>
</html>