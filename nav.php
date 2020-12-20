    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <?php include "./spinner.php"; ?>
        <section class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <a href="index.php">
                            <img src="./images/logo.png" id="logo">
                        </a>
                    </div>
                    <div class="col-sm-7">
                        <div class="top-right text-right">
                            <style type="text/css">
                                #logo {
                                    width: 60px;
                                    height: auto;
                                    margin-top: 10px;
                                }
                                .cart {
                                    position: relative;
                                }
                                #count {
                                    position: absolute;
                                    bottom: 5px;
                                    font-size: 10px;
                                    background: red;
                                    color: white;
                                    padding: 0px 4px;
                                    border-radius: 100%;
                                    right: 7px;
                                }
                                .headmenu a {
                                    text-decoration: none;
                                }
                                li a
                            </style>
                            <ul class="list-unstyled list-inline headmenu">
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
                                    <li class="list-inline-item"><a href="<?= $url;?>"><img src="./index_files/user.png" alt="">My Account</a></li>
                                <?php endif ?>
                                <li class="list-inline-item"><a href="cart.php" class="cart"><svg class="bi" width="20" height="20" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#handbag"/></svg><span id="count">0</span></a></li>
                                <?php if(isset($_SESSION['id'])): ?>
                                    <li class="list-inline-item"><a href="logout.php">Logout</a></li>

                                <?php else : ?>
                                    <li class="list-inline-item"><a href="signup.php"><svg class="bi" width="20" height="20" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#clipboard"/></svg> SignUp</a></li>
                                    <li class="list-inline-item"><a href="login.php"><svg class="bi" width="20" height="20" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#lock"/></svg>Login</a></li>
                                <?php endif ?>

                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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