<?php include "./head2.php";?>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-2">
        <a href="./index.php"><figure class="logo"></figure></a>
      </div>
      <div class="col-sm-10">
        <a href="logout.php"><svg class="bi float-right gear" width="20" height="20" fill="currentColor">
          <use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#gear-fill"/></svg> </a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-2 side">
        <?php $active="user"; include "./usersidenav.php";?>
      </div>
      <div class="col-sm-10">

        <div class="content">
          <h3>Welcome back!</h3>
          <p>You have 24 new messages and 5 new notifications.</p>
        </div>


      </div>
    </div>
  </div>
  <?php include "./foot.php"; ?>
</body>
</html>