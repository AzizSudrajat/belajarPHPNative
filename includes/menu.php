<?php
$query = mysqli_query($conn, "select * from category ORDER BY id asc");
?>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">
        <span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>
      </a>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <form class="navbar-form navbar-left" role="search" method="post" action="index.php?search">
        <div class="form-group">
          <input type="text" name="keyword" class="form-control" placeholder="Cari...">
        </div>
        <button type="submit" name="search" class="btn btn-default">Cari</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Kategori bla bla <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <?php if(mysqli_num_rows($query) > 0) { ?>
              <?php while($row=mysqli_fetch_array($query)) { ?>
                <li>
                  <a href="index.php?category=<?php echo $row["id"] ?>">
                  <span class="<?php echo $row["icon"]?> " aria-hidden="true">
                  </span> <?php echo $row["category_name"]?></a>
                </li>
              <?php } ?>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
