<?php

$conn = new mysqli("localhost","root","","phpdemo");
if($conn->connect_errno)
{
    echo "Connection Error";
}


if(isset($_POST['update']))
{   echo "<pre>";
    print_r($_POST);
    echo"</pre>";
    
    $name =trim($_POST['name']);
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $profilepic = $_FILES['profilepic']['name'];
    $services1= implode(',',$_POST['services']);
   
    $services2= $services1.",";
    
    if($profilepic != "")
    {
      $filext = pathinfo($profilepic, PATHINFO_EXTENSION);
    
      if(!($filext == 'jpg' || $filext == 'jpeg' || $filext == 'png' ||$filext == 'PNG'))
    {
     echo "Incorrect File Format";
    }

    
     else
    {  
    
      if($stmt = $conn->prepare("UPDATE crud SET name=?, email=?, gender=? , profilepic=? , services=?"))
      {   
        
       $stmt->bind_param("sssss", $name, $email, $gender, $profilepic, $services2); // bind parameters for query
       $stmt->execute();
      
       move_uploaded_file($_FILES['profilepic']['tmp_name'], 'userpics/'.$profilepic);
       header('Location: update.php?up');
       echo "updated successfully";
      }
      else
      {
       if($stmt = $conn->prepare("UPDATE crud SET name=?, email=?, gender=?, services=?"))
       {   
        
       $stmt->bind_param("sssss", $name, $email, $gender, $services2); // bind parameters for query
       $stmt->execute();
      
       
       }
      }
    }
}
}

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Update Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
 <center>
  <h2>UPDATE Form</h2>
  <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
     <?php
     if($stmt=$conn->query('SELECT * FROM crud'))
     {
         $r=$stmt->fetch_array(MYSQLI_ASSOC);
     }?>
     <table>
      <tr>
         <td>Name:</td>
         <td><input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo $r['name']?>"></td>
      </tr>
      <tr>
         <td>Email:</td>
         <td><input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php echo $r['email']?>"></td>
      </tr>
      <tr>
         <td>Gender</td>
         <td><input class="form-check-input" type="radio" name="gender"  value="male" <?php echo ($r['gender']=='male')?'checked':'' ?>>Male
             <input class="form-check-input" type="radio" name="gender"  value="famale" <?php echo ($r['gender']=='female')?'checked':'' ?>>Female
             <input class="form-check-input" type="radio" name="gender"  value="other" <?php echo ($r['gender']=='other')?'checked':'' ?>>Other
         </td>
      <tr>  
         <td>Profile Pic:</td> 
         <td><input type="file"  name="profilepic"  value="<?php echo $r['profilepic']?>">
         <?php
         if($r['profilepic'] != "")
         { ?>
         <img src ="userpics/<?php echo $r['profilepic']?>" width="100" height ="100">
         <?php }
         else{ ?>
          <img src ="userpics/default.jpg" width="100" height ="100">
          <?php
         }?>
        </td>
        
      </tr>
      <tr>
      <td>Services:</td>
     <?php $checkbox_array = explode(",", $r['services']);?>
      <td><input type="checkbox" name="services[]"  value="html"<?php  if (in_array("html", $checkbox_array))  {  echo 'checked="checked"';  } ?> >HTML
      
          <input type="checkbox" name="services[]" value="php" <?php  if (in_array("php", $checkbox_array))  {  echo 'checked="checked"';  } ?>>PHP
      </td>
      </tr>
      <tr>
      <td></td>
      <td><button type="Submit" class="btn btn-default" value="update" name="update">Update</button>
        
      </td>
      <?php


      if(isset($_GET['up']))
      {
        ?>
        <span style="color: green;">Updated Successfully</span>
        <?php }?> -->
      </tr>
      <table>
 
  </form>
 </center>
</body>
</html>