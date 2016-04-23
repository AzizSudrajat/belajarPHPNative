<?php
// proses update data
if(isset($_POST["update"])){
  $id_post = $_POST["id_post"];
  $category_id = $_POST["category_id"];
  $title = $_POST["title"];
  $description = $_POST["editor1"];

  $file_name = $_FILES["file"]["name"];
  $tmp_name = $_FILES["file"]["tmp_name"];
  if($file_name=="" || empty($file_name)){
    mysqli_query($conn,"update post set category_id = '$category_id', title='$title', description='$description' where id='$id_post'");
  }else{
    move_uploaded_file($tmp_name,"../images/".$file_name);
    mysqli_query($conn,"update post set category_id = '$category_id', title='$title', description='$description', image='$file_name' where id='$id_post'");
  }
  header("location:index.php?post");
}



// tampilkan data pada form
$post_id = $_GET["post-update"];
$edit = mysqli_query($conn,"select * from post where id = '$post_id'");
$row_edit = mysqli_fetch_array($edit);

// tampilkan data category
$category = mysqli_query($conn,"select * from category order by id asc");

// tampilkan data dari database
$post = mysqli_query($conn,"select post.*, category.category_name from post, category where post.category_id = category.id order by post.id desc");
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Blog &raquo; Post</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Input Data
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id">
                                    <option value=""> - choose - </option>
                                    <?php if(mysqli_num_rows($category)) { ?>
                                      <?php while($row_cat=mysqli_fetch_array($category)) { ?>
                                        <option <?php echo $row_edit["category_id"]==$row_cat["id"] ? "selected='selected'" : "" ?>
                                        value="<?php echo $row_cat["id"] ?>"> <?php echo $row_cat["category_name"]?> </option>
                                      <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" type="text" name="title" value="<?php echo $row_edit["title"] ?>"/>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="editor1" id="CKEditor"><?php echo $row_edit["description"] ?></textarea>
                            </div>
                            <script>
                            CKEDITOR.replace('editor1');
                            </script>
                            <div class="form-group">
                                <label>Image</label>
                                <?php if($row_edit["image"]==""){
                                  echo "<p><img src='../images/no-image.png' width='88' /></p>";
                                }else{ ?>
                                  <p><img src="../images/<?php echo $row_edit["image"] ?>" width="88"  alt="" /></p>
                                <?php } ?>
                                <input type="file" name="file" />
                            </div>
                            <button type="submit" name="update" class="btn btn-success">Update</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                            <input type="hidden" name="id_post" value="<?php echo $row_edit["id"] ?>">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                List Data
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php if(mysqli_num_rows($post)) { ?>
                            <?php while($row_post=mysqli_fetch_array($post)) { ?>
                            <tr>
                                <td><?php echo $row_post["category_name"] ?></td>
                                <td><?php echo $row_post["title"] ?></td>
                                <td><?php echo $row_post["description"] ?></td>
                                <td>
                                  <?php if($row_post["image"]==""){
                                    echo "<img src='asset/no-image.png' width='88' />";
                                  }else{ ?>
                                    <img src="../images/<?php echo $row_post["image"] ?>" width="88" class="img-responsive" />
                                  <?php } ?>
                                </td>
                                <td class="center"><a href="index.php?post-update=<?php echo $row_post["id"] ?>" class="btn btn-primary btn-xs" type="button">Update</a></td>
                                <td class="center"><a href="index.php?post-delete=<?php echo $row_post["id"] ?>" class="btn btn-primary btn-xs" type="button">Delete</a></td>
                            </tr>
                            <?php } ?>
                          <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
