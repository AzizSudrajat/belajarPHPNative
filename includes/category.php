<?php
$category_id = $_GET["category"];
// paging post
$per_page = 4;
$cur_page = 1;
if(isset($_GET["page-category"])){
  $cur_page = $_GET["page"];
  $cur_page = ($cur_page > 1) ? $cur_page : 1 ;
}
$total_data = mysqli_num_rows(mysqli_query($conn, "select * from post where category_id = '$category_id'"));
$total_page = ceil($total_data/$per_page);
$offset = ($cur_page - 1) * $per_page;

// tampilkan data post
$query = mysqli_query($conn, "select post.*, category.category_name, category.icon from post, category where category.id = post.category_id
and post.category_id = '$category_id' order by id desc limit $per_page offset $offset");
?>

<article>
<?php if(mysqli_num_rows($query)) { ?>
  <?php while($row=mysqli_fetch_array($query)) { ?>
    <div class="row latest-post">
      <div class="col-md-3">
        <img src="images/<?php echo $row["image"]?>" class="img-responsive btn-block">
      </div>
      <div class="col-md-9">
        <h2><a href="index.php?detail=<?php echo $row["id"]?>"><?php echo $row["title"]?></a></h2>
        <div class="meta">
          <a href="index.php?category=<?php echo $row["category_id"]?>">
          <span class="<?php echo $row["icon"]?>" aria-hidden="true">
          </span> <?php echo $row["category_name"]?></a> - <?php echo tgl_indonesia($row["date"])?>
      </div>
        <p><?php echo $row["description"]?></p>
      </div>
    </div>
  <?php } ?>
<?php } ?>
</article>

<?php if(isset($total_page)) { ?>
  <?php if($total_page > 1) { ?>
    <nav class="text-center">
      <ul class="pagination">
        <?php if($cur_page > 1) { ?>
        <li>
            <a href="index.php?page-category=<?php echo ($cur_page - 1)."$category=".$category_id ?>" aria-label="Previous">
                <span aria-hidden="true">Prev</span>
            </a>
        </li>
        <?php }else{ ?>
        <li class="disabled"><span aria-hidden="true">Prev</span></li>
        <?php } ?>
        <?php if($cur_page < $total_page) { ?>
        <li>
          <a href="index.php?page-category=<?php echo ($cur_page + 1)."$category=".$category_id  ?>" aria-label="Next">
            <span aria-hidden="true">Next</span>
          </a>
        </li>
        <?php }else{ ?>
        <li class="disabled"><span aria-hidden="true">Next</span></li>
        <?php } ?>
      </ul>
    </nav>
  <?php } ?>
<?php } ?>
