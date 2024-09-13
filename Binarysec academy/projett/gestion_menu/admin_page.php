<?php

@include 'config.php';

if(isset($_POST['add_product'])){
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_desc = $_POST['desc'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'images/'.$product_image;

   if(empty($product_name) || empty($product_price) || empty($product_image)){
      $message[] = 'Remplissez les champs Obligatoires';
   }else{

      $img_ex = pathinfo($product_image, PATHINFO_EXTENSION);
      $img_ex_lc = strtolower($img_ex);
      $allowed_exs = array('jpg', 'jpeg', 'png');

      if (in_array($img_ex_lc, $allowed_exs)) {
          $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
          $img_upload_path = 'images/' . $new_img_name;
          move_uploaded_file($tmp_name, $img_upload_path);

         $insert = "INSERT INTO produits(image, nom, prix,description) VALUES( '$new_img_name','$product_name', '$product_price','$product_desc')";
         $upload = mysqli_query($conn,$insert);
         if($upload){
            move_uploaded_file($product_image_tmp_name, $product_image_folder);
            $message[] = 'Nouveau produit ajouté avec succès';
         }else{
            $message[] = 'Echec d\'ajout du produit';
         }
         }   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM produits WHERE id = $id");
   header('location:admin_page.php');
};

?>



<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
   <link rel="stylesheet" href="css/styles.css">
   <style>
      .message{
         color:red;
      }
   </style>
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   <a href="../index.php" style='font-size:28px; text-align:end; '>RETOUR</a>

<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>add a new product</h3>
         <input type="text" placeholder="Entrer le nom du produit" name="product_name" class="box">
         <input type="number" placeholder="Entrer le prix du produit" name="product_price" class="box">
         <input type="text" placeholder="Une pétite description" name="desc" class="box">
         <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php

   $select = mysqli_query($conn, "SELECT * FROM produits");
   
   ?>
   
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>Image du produit</th>
            <th>Nom du produit</th>
            <th>Prix du produit</th>
            <th>Description du produit</th>
            <th>action</th>
         </tr>
         </thead>
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="images/<?php echo $row['image']; ?>" height="100" alt="image"></td>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['prix']; ?>FCFA</td>
            <td><?php echo $row['description']; ?></td>
            <td>
               <a href="admin_update.php?edit=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="admin_page.php?delete=<?php echo $row['id']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>
</div>


</body>
</html>