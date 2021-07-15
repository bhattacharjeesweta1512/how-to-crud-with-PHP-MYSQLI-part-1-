<?php

// Create connection
$conn = new mysqli("localhost", "root", "","phpdemo");


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if(isset($_POST['submit']))
{
    $name= trim($_POST['name']);
    $email= $_POST['email'];
    $pwd= md5($_POST['pwd']);
    $gender= $_POST['gender'];
    $profilepic= $_FILES['profilepic']['name'];
    $service1= $_POST['service'];
    
    $chk="";
    foreach($service1 as $chk1)
    {
      $chk .= $chk1.",";
    }
    
    $ext = pathinfo($profilepic, PATHINFO_EXTENSION);
    
    if(!($ext=='JPEG' || $ext=='JPG' || $ext=='PNG' || $ext=='png'|| $ext=='jpg'|| $ext=='jpeg'))
    {
        echo "Check the file format";
    }
    else
    {
        if($stmt= $conn->prepare('INSERT INTO crud (name, email, pwd, gender, profilepic, services) VALUES (?, ?, ?, ?, ?, ?)'))
        {   
            $stmt->bind_param('ssssss',$name, $email, $pwd, $gender, $profilepic, $chk);
            $stmt->execute();
            if($stmt->affected_rows == 1)
          { 
            echo "Data Inserted Successfully";
          }
        }
    }

}
?>

<!DOCTYPE HTML>
<html> 
<head>
<meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> 
</head>
<body>
<center>
<h2>Registration Form </h2>
<form action="" method="POST" enctype="multipart/form-data" style="border: 1px solid black; width: 30%;">
<table>
<tr>
<td>Name:</td>
<td><input type="text" name= "name" ></td>
</tr>
<tr>
<td>Email:</td>
<td><input type="email" name= "email" ></td>
</tr>
<tr>
<td>Password:</td>
<td><input type="password" name= "pwd"></td>
</tr>
<tr>
<td>Sex:</td>
<td><input type="radio" name= "gender" value= "male">Male
<input type="radio" name= "gender" value= "female">Female
<input type="radio" name= "gender" value= "other">Other</td>
</tr>
<tr>
<td>Services:</td>
<td><input type="checkbox"  name="service[]" value="html">HTML
 
    <input type="checkbox" name="service[]" value="php">PHP
    
  
</td>
</tr>
<tr>
<td>Profile Pic:</td>
<td><input type="file"  name="profilepic"></td>
</tr>
<tr>
<td></td>
<td>
<input type="submit" name="submit" value="submit">
<input type="reset" name="reset" value="reset">
</td>
</tr>
</table>
</form>
</center>
</body>
</html>