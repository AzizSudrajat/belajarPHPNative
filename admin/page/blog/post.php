<?php
// proses simpan
if(isset($_POST["submit"])){
  $category_id = $_POST["category_id"];
  $title = $_POST["title"];
  $descripton = $_POST["editor1"];
  $date = date("Y-m-d H-i-s");

  $file_name = $_FILES["file"]["name"];
  $temp_name = $_FILES["file"]["tmp_name"];
  $destination = '../upload/';
  $move = move_uploaded_file($temp_name,$destination.$file_name);
  $move = mysqli_query($conn,"insert into gambar (id, nama_gambar, gambar) values ('null',' $file_name')");
  mysqli_query($conn,"insert into post values('','$category_id','$title','$descripton','$file_name','$date')");
  header("location:index.php?post");
}


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
                                        <option value="<?php echo $row_cat["id"] ?>"> <?php echo $row_cat["category_name"]?> </option>
                                      <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" type="text" name="title" />
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" rows="3" name="editor1" id="CKEditor"></textarea>
                            </div>
                            <script>
                            CKEDITOR.replace('editor1');
                            </script>
                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="file" />
                            </div>
                            <button type="submit" name="submit" class="btn btn-success">Save</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
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
                                    <img src="../upload/<?php echo $row_post["image"] ?>" width="88" class="img-responsive" />
                                  <?php } ?>
                                </td>
                                <td class="center"><a href="index.php?post-update=<?php echo $row_post["id"] ?>" class="btn btn-danger btn-xs" type="button">Update</a></td>
                                <td class="center"><a href="index.php?post-delete=<?php echo $row_post["id"] ?>" class="btn btn-danger btn-xs" type="button">Delete</a></td>
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
