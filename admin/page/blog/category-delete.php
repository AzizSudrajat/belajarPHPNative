<?php
if(isset($_GET["category-delete"])){
  $id_category = $_GET["category-delete"];
  mysqli_query($conn,"delete from category where id = '$id_category'");
  header("location:index.php?category");
}
?>
