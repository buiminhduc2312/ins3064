<?php
include "connection.php";

$id = $_GET["id"];
?>

<script type="text/javascript">
    var confirmDelete = confirm("Are you sure you want to delete?");
    if (confirmDelete) {
        <?php
        mysqli_query($link, "DELETE FROM table1 WHERE id=$id");
        ?>
        alert("Deleted successfully!");
        window.location = "index.php";
    } else {
        window.location = "index.php";
      history.back();
    }
</script>