<?php

include '../db.php';
if(isset($_GET['id']))
{    
    if($conn->query("DELETE FROM crud where registration_id=$_GET[id]") == "true")
    {
      echo "Record Deleted Successfully";
      header('Location: display.php/');
      } else {
        echo "Error deleting record: " . $conn->error;
      }
    
}?>