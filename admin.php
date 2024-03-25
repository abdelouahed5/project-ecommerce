<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"  >
    <title>Admin</title>
</head>
<body>
    <?php 
    include('includes/navbar.php');
    ?>
   <div class="container"> 
   <?php 
   
   $utl=$_SESSION["utilisateur"];
   if(!isset($_SESSION["utilisateur"])){
    header("location:connexion.php");
   }
  
    ?>
    <h5>bonjour <?php echo $utl["login"]?></h5>
 
   </div>
   
    
    
</body>
</html>