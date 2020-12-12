    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <?php include "./spinner.php"; ?>
        <section class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <div class="top-right text-right">
                            <style type="text/css">
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
                                <!-- <li class="list-inline-item"><a href=""><img src="./index_files/user.png" alt="">My Account</a></li> -->
                                <li class="list-inline-item"><a href="" class="cart"><svg class="bi" width="20" height="20" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#handbag"/></svg><span id="count">0</span></a></li>
                                <li class="list-inline-item"><a href="signup.php"><svg class="bi" width="20" height="20" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#clipboard"/></svg> SignUp</a></li>
                                <li class="list-inline-item"><a href="login.php"><svg class="bi" width="20" height="20" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#lock"/></svg>Login</a></li>
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