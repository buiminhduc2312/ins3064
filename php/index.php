<?php
include "connection.php";
?>

<html lang="en">
<head>
    <title>Computer Components</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <div class="col-lg-4">
        <h2>Computer Parts Form</h2>
        <form action="" name="form1" method="post">
            <div class="form-group">
                <label for="component_name">Component Name:</label>
                <input type="text" class="form-control" id="component_name" placeholder="Enter Component Name" name="component_name">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" class="form-control" id="description" placeholder="Enter Description" name="description">
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" placeholder="Enter Price" name="price">
            </div>
            <button type="submit" name="insert" class="btn btn-default">Insert</button>
            <button type="submit" name="update" class="btn btn-default">Update</button>
            <button type="submit" name="delete" class="btn btn-default">Delete</button>
        </form>
    </div>
</div>

<div class="col-lg-12">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Component Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (!empty($link)) {
            $res = mysqli_query($link,"SELECT * FROM computer_parts");
        }
        while($row=mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["component_name"]."</td>";
            echo "<td>".$row["description"]."</td>";
            echo "<td>".$row["price"]."</td>";
            echo "<td><a href='edit.php?id=".$row["id"]."'><button type='button' class='btn btn-success'>Edit</button></a></td>";
            echo "<td><a href='delete.php?id=".$row["id"]."'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>

<?php
if(isset($_POST["insert"])) {
    mysqli_query($link,"INSERT INTO computer_parts VALUES (NULL,'$_POST[component_name]','$_POST[description]','$_POST[price]')");
    ?>
    <script type="text/javascript">window.location.href=window.location.href;</script>
    <?php
}

if(isset($_POST["delete"])) {
    mysqli_query($link,"DELETE FROM computer_parts WHERE component_name='$_POST[component_name]'");
    ?>
    <script type="text/javascript">window.location.href=window.location.href;</script>
    <?php
}

if(isset($_POST["update"])) {
    mysqli_query($link,"UPDATE computer_parts SET description='$_POST[description]', price='$_POST[price]' WHERE component_name='$_POST[component_name]'");
    ?>
    <script type="text/javascript">window.location.href=window.location.href;</script>
    <?php
}
?>
</html>
