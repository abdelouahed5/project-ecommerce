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
   <h4>Modifier Produit</h4>
   <?php 
   try{
    require_once "includes/connect.php";
    $id=$_GET["id"];
    $sql=$db->prepare("SELECT  * FROM produit where id=$id ");
    $sql->execute();
    $produit=$sql->fetch(PDO::FETCH_ASSOC);
    
    
   
    //pour la modification:
          
        if(isset($_POST["Modifier"])){
            $libelle=$_POST["libelle"];
            $prix=$_POST["prix"];
            $discount=$_POST["discount"];
            $produitt=$_POST["produit"];
            $description=$_POST["description"];
            $date=$_POST["date_creation"];
            $filename='';
            if(!empty($_FILES["image"]["name"])){
              $image=$_FILES['image']["name"];
             $filename=uniqid().$image;
              move_uploaded_file($_FILES["image"]['tmp_name'],'upload/produit/'.$filename);
              
             }
            
            if(!empty($libelle) && !empty($prix) && !empty($date)  ){
                if(!empty($filename)){
                    $sql=" UPDATE produit SET libelle=?,prix=? , discount=? , description=? , image=? , id_categorie=? ,date_creation=? WHERE id=? ";
                    $stmt=$db->prepare($sql);
                    $updated=$stmt->execute([$libelle,$prix,$discount,$description,$filename ,$produitt,$date,$id]);

                }
                else{
                    $sql=" UPDATE produit SET libelle=?,prix=? , discount=? , description=?  , id_categorie=? ,date_creation=? WHERE id=? ";
                    $stmt=$db->prepare($sql);
                    $updated=$stmt->execute([$libelle,$prix,$discount,$description,$produitt,$date,$id]);
                }
                if($updated){
                    header("location:produits.php");
                }
                
                 
            }
         
            
   }
}
   catch( PDOException $ex){
    die($ex->getMessage());
   }

   ?>
    
    <form method="post" enctype="multipart/form-data">
    
        <input type="hidden" name="libelle" class="form-control "  value="<?= $produit['id']?>" >
        <br>
        <label class="form-label ">Libelle</label>
        <input type="text" name="libelle" class="form-control "  value="<?= $produit['libelle']?>" >
        <br>
        <label class="form-label ">Prix</label>
        <input type="number" name="prix" step="0.1" class="form-control " min="0" value="<?= $produit['prix']?>"  >
        <br>
        <label class="form-label ">Discount</label>
        <input type="range"  name="discount" class="form-control "  min="0" max="99" value="<?= $produit['discount']?>" >
        <br>
        <label  class=""form-label  >Description</label>
        <textarea name="description" class=" form-control " > <?php echo $produit["description"] ?> </textarea>
        <br>
        <label class="form-label ">Image</label>
        <input type="file" name="image" class="form-control "  >
        <img width="200" class="border border-dark mt-4 rounded-circle " src="upload/produit/<?php echo $produit["image"] ?>" alt="">
        
     
         <br>
        <br>
        <br>
      <?php
         $data=$db->prepare("SELECT * FROM categorie ");
         $data->execute();
         $categories=$data->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <label class="form-label ">Choissez categorie</label>
        <select name="produit"  class="form-control">
       
       <?php
       foreach($categories as $ctg){
        $selected='';
        if ($produit["id_categorie"] == $ctg["id"]) {
            $selected="selected";
            
        }
           
            echo "<option $selected value=" . $ctg['id'] . ">" . $ctg['libelle'] . "</option>";
        
        
       }
        ?>
      
       </select>
       <br>
        <label class="form-label ">date_creation</label>
        <input type="date" name="date_creation" value=<?php echo $produit["date_creation"] ?> class="  form-control  " >

        <input type="submit" name='Modifier' value="Ajouter Produit" class="btn btn-primary my-3 "  >
    </form>
   </div>

   
    
    
</body>
</html>