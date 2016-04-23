<?php
// varibale limit
$total_data = mysqli_query($conn, "select * from comment order by id desc limit 3");
?>

<aside class="col-md-4">
    <div class="panel panel-default">
    	<div class="panel-heading">
    		<h3 class="panel-title">Komentar Terbaru</h3>
    	</div>
    	<div class="panel-body latest-comments">
    		<ul>
          <?php if(mysqli_num_rows($total_data)) { ?>
            <?php while($row=mysqli_fetch_array($total_data)) { ?>
      		    <li>
                <a href="index.php"><span class="glyphicon glyphicon-comment" aria-hidden="true">
                </span> <strong><?php echo $row["name"] ?></strong>: <?php echo $row["reply"] ?></a>
              </li>
            <?php } ?>
          <?php } ?>
    		</ul>
    	</div>
    </div>
</aside>
