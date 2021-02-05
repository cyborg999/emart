  <script src="./node_modules/jquery/dist/jquery.min.js"></script>
<header class="section-header">
      <section class="header-top-light border-bottom">
        <div class="container">
          <nav class="d-flex flex-column flex-md-row">
            <?php
                  $social = $model->getAllSocialMedia();
                ?>
            <ul class="nav mr-auto d-none d-md-flex">
              <?php foreach($social as $idx => $s): ?>
                <li><a href="<?= $s['link'];?>" class="nav-link px-2"> <i class="fa fa-<?= $s['social'];?>"></i> </a></li>
                  <?php endforeach ?>
            </ul>
            <ul class="nav">
              <li class="nav-item"><a href="index.php" class="nav-link"> Home </a></li>
          <li class="nav-item"><a href="footer.php?page=about" class="nav-link"> About </a></li>
          <li class="nav-item"><a href="footer.php?page=contact" class="nav-link"> Contact Us </a></li>
            </ul> <!-- navbar-nav.// -->
          </nav>
        </div>
      </section>

      <section class="header-main border-bottom">
        <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-3 col-sm-4 col-12">
          <a href="index.php" class="brand-wrap">
            <style type="text/css">
              #logo {
                background: url(./images/logo.png) no-repeat;
                background-size: contain;
                width: auto;
                height: 30px;
              }
              body {
                background: #f8f9fa;
              }
              header {
                background: white;
              }
            </style>
            <figure id="logo"></figure>
          </a> <!-- brand-wrap.// -->
          </div>
          <div class="col-lg-4 col-xl-5 col-sm-8 col-12">
            <form method="post" action="filtered.php" class="search">
              <div class="input-group w-100">
                  <input type="text" class="form-control" style="width:55%;" name="search" placeholder="I&#39;m looking for...">
                  <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </div>
            </form> <!-- search-wrap .end// -->
          </div> <!-- col.// -->
          <div class="col-lg-5 col-xl-4 col-sm-12">
            <div class="widgets-wrap float-md-right">
              <a href="cart.php" class="widget-header mr-2">
                <div class="icon">
                  <i class="icon-sm rounded-circle border fa fa-shopping-cart"></i>
                  <span class="notify" id="count">0</span>
                </div>
              </a>
              <?php
                $wishlist = 0;
                
                if(isset($_SESSION['id'])){
                  $wishlist = $model->getUserWishlist(true);
                  $wishlist = $wishlist['total'];
                }
              ?>
              <a href="wishlist.php" class="widget-header mr-2">
                <div class="icon">
                  <i class="icon-sm rounded-circle border fa fa-heart"></i>
                  <span class="notify" id="wishListcount"><?= $wishlist; ?></span>
                </div>
              </a>
              <div class="widget-header dropdown">
                <a href="#" data-toggle="dropdown" data-offset="20,10">
                  <div class="icontext">
                    <?php
                                        $url = "./userdashboard.php";
                                        if(isset($_SESSION['usertype'])){
                                            if($_SESSION['usertype'] == "merchant"){
                                                $url = "./dashboard.php";
                                            } elseif($_SESSION['usertype'] == "admin") {
                                                $url = "./admindashboard.php";
                                            }
                                        }
                                        
                                    ?>
                                    <?php if(isset($_SESSION['id'])): ?>
                    <a href="<?= $url;?>">
                      <div class="icon">
                      <i class="icon-sm rounded-circle border fa fa-user"></i>
                    </div>
                    </a>
                                      <?php else : ?>
                    <a href="login.php">
                      <div class="icon">
                      <i class="icon-sm rounded-circle border fa fa-user"></i>
                    </div>
                    </a>
                                      <?php endif ?>
                    <div class="text">
                       <?php if(isset($_SESSION['id'])): ?>
                        <small class="text-muted"> <a href="logout.php">Logout</a></small>

                        <a href="<?= $url;?>"><div>My account</div></a>

                                      <?php else : ?>
                                        <small class="text-muted"><a href="login.php">Sign in</a> | <a href="signup.php">Join</a></small>
                        <a href="login.php"><div>My account</div></a>
                                      <?php endif ?>

                      
                    </div>
                  </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                  <form class="px-4 py-3">
                    <div class="form-group">
                      <label>Email address</label>
                      <input type="email" class="form-control" placeholder="email@example.com">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                    <hr class="dropdown-divider">
                    <a class="dropdown-item" href="#">Have account? Sign up</a>
                    <a class="dropdown-item" href="#">Forgot password?</a>
                </div> <!--  dropdown-menu .// -->
              </div>  <!-- widget-header .// -->
            </div> <!-- widgets-wrap.// -->
          </div> <!-- col.// -->
        </div> <!-- row.// -->
        </div> <!-- container.// -->
      </section> <!-- header-main .// -->

      <script type="text/javascript">
            (function($){
                var total = 0;
                var storeditems = JSON.parse(localStorage.getItem("items"));

                for(var i in storeditems){
                    if(storeditems[i] != null){
                        total += 1;
                    }
                }

                $("#count").html(total);
            })(jQuery);
        </script>

      <nav class="navbar navbar-main navbar-expand-lg border-bottom">
        <div class="container">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav5" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="main_nav5">
            <?php 
                $categories = $model->getAllActiveCategories();
            ?>
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link pl-0" href="#"> <strong>All category</strong></a>
              </li>
              <?php foreach($categories as $idx => $c): ?>
                <?php if($idx <7): ?>
                  <li class="nav-item">
                    <a class="nav-link" href="filtered.php?category=<?= $c['id'];?>"><?= $c['name'];?></a>
                  </li>
              <?php endif ?>
              <?php endforeach ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">More</a>
                <div class="dropdown-menu">
                  <?php foreach($categories as $idx => $c): ?>
                  <?php if($idx >6): ?>
                      <a class="dropdown-item" href="filtered.php?category=<?= $c['id'];?>"><?= $c['name'];?></a>
                <?php endif ?>
                <?php endforeach ?>
                </div>
              </li>
            </ul>
          </div> <!-- collapse .// -->
        </div> <!-- container .// -->
      </nav> <!-- navbar main end.// -->
    </header>