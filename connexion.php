<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet"  >
    <title>connexion</title>
</head>
<body>
    <?php 
    include('includes/navbar.php');
    ?>
    <?php
    
   
    if(isset($_POST["Connexion"])){
        $login=$_POST["login"] ;
        $password=$_POST["password"] ;
        if(!empty($login) && !empty($password)){
            require_once "includes/connect.php";
            //admin pass and log
            // $admin="SELECT * FROM utilisateur WHERE id=2";
            // $adminstmt=$db->prepare($admin);
            // $adminstmt->execute();
            // $isAdmin=$adminstmt->fetch();
            // var_dump($isAdmin);
    
            $sql="SELECT * FROM utilisateur WHERE login=? AND password=?";
            $stmt=$db->prepare($sql);
            $stmt->execute([$login,$password]);
            if($stmt->rowCount()>=1){
                // $row=$stmt->fetch();
                // var_dump($row);
                // if($isAdmin["password"]==$row["password"] && $isAdmin["login"]==$row["login"] )
                // {
                //     header("location:admin.php");
                // }
                // else
                // {
                //     header("location:user.php");
                // }
            // var_dump($stmt->fetch());
            // var_dump($admin);  
                $_SESSION["utilisateur"]=$stmt->fetch();
                header("location:admin.php");

            }
            else{
                ?>
                <div class="container">
                <div class="alert alert-danger" role="alert">
                 Connexion invalide
               </div>
                </div>
             <?php
            }

            
            
            
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


     ?>
   
   <div class="container">

   
   <h4>Connexion</h4>
   <form method="post" >
        <label class="form-label ">login</label>
        <input type="text" name="login" class="form-control "  >
        <br>
        <label class="form-label ">password</label>
        <input type="password" name="password" class="form-control " >

        <input type="submit" name='Connexion' value="Connexion" class="btn btn-primary my-3 "  >
    </form>
   </div>
   
    
    
</body>
</html>