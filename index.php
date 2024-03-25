<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"  >
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Document</title>
</head>
<body>
    <?php 
    include('includes/navbar.php');
    ?>
   <div class="container">
   <h4>Ajouter Utilisateur</h4>
    <?php
    try{


        if(isset($_POST['Ajouter'])){
            $login=$_POST["login"] ;
            $password=$_POST["password"] ;
            $date=date("Y-m-d");
                
            if(!empty($login && !empty($password))){
            require_once "includes/connect.php";
            $sql="INSERT INTO utilisateur  VALUES (null,?,?,?)";
            $stmt=$db->prepare($sql);
            $stmt->execute([$login,$password,$date]);
            ?>
           <div class="container">
           <div class="alert alert-success" role="alert">
                Ajouter Succes
        
                </div>
           </div>
            <?php
            header('location:connexion.php');
            }
            
            else{
            ?>
               <div class="container">
               <div class="alert alert-danger" role="alert">
                s'il vous plait, Login et password  obligatoire 
              </div>
               </div>
            <?php
            }
        }
        }
        catch(PDOException $ex)
        {
            die($ex->getMessage());
        }
        ?>
    
    
   <form method="post" >
        <label class="form-label ">login</label>
        <input type="text" name="login" class="form-control "  >
        <br>
        <label class="form-label ">password</label>
        <input type="password" name="password" class="form-control " >

        <input type="submit" name='Ajouter' value="Ajouter Utilisateur" class="btn btn-primary my-3 "  >
    </form>
   </div>
   
    
    
</body>
</html>