<?php // Create connection
$conn = new mysqli("localhost", "root", "","phpdemo");


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
$r= $conn->prepare('INSERT INTO crud (name, email, pwd, gender, service, profilepic) VALUES (?, ?, ?, ?, ?, ?)')?>
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
 
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.25/datatables.min.css"/>
 
    <script>
    $('document').ready(function(e){
            $(document).ready(function(){
            $('#myTable').dataTable();

            });
        });
        function del()
        {   
            var del=confirm("are you sure , you want to delete");
            if(del==true)
            {
                return true;

            }
            else 
            {
                return false;

            }

        }
        function update()
        {   
            var update=confirm("are you sure , you want to update");
            if(update==true)
            {
                return true;

            }
            else 
            {
                return false;

            }

        }
        </script>
   
</head>
<body>
<table border=1 id="myTable">
<thead>
<tr>
<th>S.NO</th>
<th>Name</th>
<th>Email</th>
<th>Gender</th>
<th>Services</th>
<th>DOC</th>
<th>Profile</th>
<th>Action</th>
</tr>
</thead>
<?php
if($stmt= $conn->query('SELECT * FROM crud'))
        {   
            while($r = $stmt->fetch_array(MYSQLI_ASSOC))
            {   ?>
                
                <tbody>
                    <tr>
                                <td><?php echo $r['registration_id'];?></td>
                                <td><?php echo $r['name'];?></td>
                                <td><?php echo $r['email'];?></td>
                                <td><?php echo $r['gender'];?></td>
                                <td><?php echo $r['services'];?></td>
                                <td><?php echo $r['doc'];?></td>
                                <td><?php echo $r['profilepic'];?>
                                    <?php if($r['profilepic']!="")
                                    {?>
                                    <img src='../userpics/<?php echo $r['profilepic']?>' width="100" height ="100">
                                    <?php }
                                    else{?>
                                    <img src='../userpics/default.jpg' width="100" height ="100">
                                    <?php
                                    } ?>
                                </td>
                                <td><a href="../del.php?id=<?php echo $r['registration_id']?>"onclick ="del()">delete</a><a href="../update.php?id=<?php echo $r['registration_id']?>"onclick ="update()">Update</a></td>
                    </tr>
                </tbody>
                <?php 
            } 
        }?>
</table>
</body>
</html>
