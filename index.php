<?php
include "db.php";
$message="";
if(isset($_GET['added'])){
  $message="contact already added";  
}
if(isset($_POST['save'])){
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    if($name==""){
        $message="enter name please";
    }
else{
    $stmt=$pdo->prepare("INSERT INTO contact(name,phone,email) VALUES (?,?,?)");
    $stmt->execute([$name,$phone,$email]);
    header("Location:index.php?added=1");
    }
}

$result=$pdo->query("SELECT * FROM contact");
?>
<html>
    <style>
        body{
            font-family:arial;
        }
        table,th,td{
            border:1px solid black;
            border-collapse:collapse;
        }
        form{
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 5px;
            height: 310px;
            width: 300px;
            
        }
        input[type=text]{
            margin: 10px;
            padding: 5px;
            width: 250px;
            height: 40px;
            border:1px solid black;
            border-radius: 5px;
        }
        input[type=number]{
            margin: 10px;
            padding: 5px;
            width: 250px;
            height: 40px;
            border:1px solid black;
            border-radius: 5px;
        }
        input[type=submit]{
            background-color: blue;
            color: white;
            font-size: 15px;
            width: 100px;
            height: 30px;
            border-radius: 5px;
            border:none;
        }
        h1{
            font-size:20px;
        }
        a{
            text-decoration:none;
            color:white;
        }
        .delete{
            color:white;
            background-color:red;
            width:50px;
            height:30px;
            border:none;
            border-radius:5px;
        }
        .edit{
            color:white;
            background-color:blue;
            width:50px;
            border:none;
            border-radius:5px;
            height:30px;
        }
    </style>
    <body><br><br><br><br>
        <center>
        <p><?php echo $message?></p>
        <form method="post">
            <br>
            <h1>Add New Contact</h1>
            <input type="text" name="name" placeholder="enter name">
            <input type="number" name="phone" placeholder="enter phone">
            <input type="text" name="email" placeholder="enter email">
            <input type="submit" name="save">
        </form>
        <br><br>
        <h1>Contacts</h1>
  <table>
    <tr>
        <th>name</th>
        <th>phone</th>
        <th>email</th>
        <th>edit</th>
        <th>delete</th>
    </tr>
    <?php
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
     $id=$row['id'];
     echo "<tr>";
     echo "<td>".$row['name']."</td>";
     echo "<td>".$row['phone']."</td>";
     echo "<td>".$row['email']."</td>";
     echo "<td><button class='edit' ><a href=edit.php?id=$id>edit</a></button></td>";
     echo "<td><button class='delete' ><a href=delete.php?id=$id>delete</a></button></td>";
     echo "</tr>";
    }
    ?>
    </body>
</html>