<?php
include "db.php";
$id=$_GET['id'];
if(isset($_POST['edit'])){
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $stmt=$pdo->prepare("UPDATE contact SET name=?,phone=?,email=? WHERE id=?");
    $stmt->execute([$name,$phone,$email,$id]);
    header("Location:index.php");

}
$stmt=$pdo->prepare("SELECT * FROM contact WHERE id=? ");
$stmt->execute([$id]);
$row=$stmt->fetch(PDO::FETCH_ASSOC);
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
        </style>
    <body><br><br><br><br><br>
        <center>
        <form method="post"><br>
            <h1>Edit Details</h1>
            <input type="text" name="name" value="<?php echo $row['name'] ?>">
            <input type="number" name="phone" value="<?php echo $row['phone'] ?>">
            <input type="text" name="email" value="<?php echo $row['email'] ?>">
            <input type="submit" name="edit">
        </form>
        
    </body>
</html>