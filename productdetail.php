<!DOCTYPE html>
<html>
    <?php include_once "./head.php"; ?>
<body>
    <?php include_once "./nav.php"; ?>
    <main>
    <script src="./node_modules/jquery-zoom/jquery.zoom.min.js"></script>
        <section class="sec1">
            <style type="text/css">
            .sec1 {
                margin-top: 40px;
            }
            .product {
                background: #eee;
            }
                .sec1_product {
                    height: 300px;
                    width: initial;
                    margin: 0 auto;
                    display: block;
                }
                .sec1_thumb {
                    height: 50px;
                    width: auto;
                    cursor: pointer;
                    display: block;
                    margin: 0 auto;
                }
                .thumbs {
                    display: flex;
                    flex-direction: row;
                    justify-content: center;
                }
                .thumbnails {
                    display: block;
                    width: 60px;
                    margin: 10px 0;
                    padding: 0;
                    height: 100px;
                }
                .star_rating {
                    list-style-type: none;
                }
                .star_rating li {
                    display: inline;
                }
                .price {
                    font-size: 40px;
                    font-style: normal;
                    color: #0d6efd;
                    display: block;
                    font-weight: 600;
                }
                h1 {
                    font-size: 30px;
                    padding: 0;
                    margin: 0;
                    line-height: 1;
                    font-weight: 600;
                }
                ul li button.btn,
                .pagination-sm .page-item .page-link {
                    font-size: 16px;
                    padding: 5px 15px;
                }
                .qty {
                    margin: 20px 0;
                }
                .tab-pane{
                    padding: 20px 10px;
                }
                #zoomProduct {
                    max-height: 306px;
                }
            </style>
            <article class="container">
                <?php
                    $product = $model->getProductById($_GET['id']);
                    $media = $model->getMediaByProductId($_GET['id']);
                    $total = $model->getReviewCountByProductId($_GET['id']);
                    $comments  = $model->getAllProductCommentsById($_GET['id']);
                    $average = $model->GetAvgCommentByProductId($_GET['id']);
                    $related = $model->getRelatedProductsByCategoryId($product['categoryid']);


                    $fees = $model->getGlobalFeesByStoreId($_GET['id']);
                    $activeMedia = "";

                    foreach($media as $idx => $m){
                        if($m['active']){
                            $activeMedia = $m;

                            break;
                        }
                    }
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm product" id="zoomProduct">
                                <img class="sec1_product" id="zoomImg" src="./uploads/merchant/<?= $activeMedia['storeid'];?>/<?= $activeMedia['productid'];?>/<?= $activeMedia['name'];?>">
                            </div>
                        </div>
                        <div class="row thumbs">
                                <?php foreach($media as $idx => $m): ?>
                                    <div class="thumbnails">
                                       <img class="sec1_thumb" src="./uploads/merchant/<?= $m['storeid'];?>/<?= $m['productid'];?>/<?= $m['name'];?>"/>

                                    </div>
                                <?php endforeach ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <h1><?= $product['name'];?></h1>
                        <p>by: <a href="./shop.php?id=<?= $product['storeid'];?>"><?= $product['storename'];?></a></p>
                        <figure class="star_rating"></figure>
                        <style type="text/css">
                            .star_rating {
                                float: left;
                                margin: 0 10px 0 0;
                            }
                            .instock {
                                color: green;
                            }
                            .instock span {
                                color: black;
                                font-weight: normal;
                            }
                        </style>
                        <ul class="star_rating">
                            <?php for($i = 1;$i<=5;$i++) : ?>
                                <?php if($i <= $average['average']): ?>
                                    <li><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#star-fill"/></svg></li>
                                <?php else : ?>
                                    <li><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#star"/></svg></li>
                                <?php endif ?>
                            <?php endfor ?>
                        </ul>
                        <?php if($product['quantity'] > 0):?>
                            <b class="instock">In Stock (<span><?= $product['quantity'];?></span>)</b>
                        <?php else : ?>
                            <b style="color: red; line-height: 2;">Out of Stock</b>
                        <?php endif ?>
                        <em class="price">₱<?= $product['price'];?></em>
                        <p><?= $product['description'];?></p>
                        <ul id="tags">
                            <li><a href="./filtered.php?category=<?= $product['categoryid'];?>"><?= $product['categoryname'];?></a></li>
                        </ul>
                        <nav aria-label="..." id="maxQty" data-max="<?= $product['quantity'];?>" class="qty">
                          <ul class="pagination pagination-sm">
                            <li class="page-item"><a class="page-link count" data-action="minus" href="#">
                                <svg class="bi" width="15" height="15" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#dash"/></svg>
                            </a></li>
                            <li  class="page-item">
                                <button class="btn  page-link" id="qty"><?=($product['quantity'] >0) ? 1 : 0;?></button>
                            </li>
                            <li class="page-item"><a class="page-link count" data-action="plus" href="#">
                                <svg class="bi" width="15" height="15" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#plus"/></svg>
                            </a></li>
                          </ul>
                        </nav>
                        <a href="cart.php" data-id="<?= $_GET['id'];?>"  data-btn="buy" class="btn btn-primary btn-lg add2Cart">Buy Now</a>
                        <a href="" data-btn="add"  data-id="<?= $_GET['id'];?>" class="btn btn-lg btn-light add2Cart" id="add2Cart">Add to Cart</a>
                        <br>
                        <style type="text/css">
                            #tags {
                                list-style-type: none;
                            }
                            #tags li {
                                display: inline;
                            }
                            #tags a {
                                text-decoration: none;
                                color: red;
                                color: #000000;
                                font-size: 12px;
                            }
                            #rating li {
                                cursor: pointer;
                            }
                        </style>
                        
                    </div>
                </div>
            </article>
        </section>
        <section class="sec2">
            <article class="container">
                <div class="row">
                    <div class="col-sm">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
                          </li>
                           <li class="nav-item">
                            <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="review" aria-selected="false">Shipping Details</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Reviews(<span id="reviewCount"><?= $total; ?></span>)</a>
                          </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <p><?= $product['description'];?></p>
                            </div>
                            <style type="text/css">
                                .review_rating,
                                #rating {
                                    display: flex;
                                    flex-direction: row;
                                    justify-content: space-around;
                                    width: 150px;
                                }
                                .review_rating  figure.active,
                                #rating figure.active {
                                    background: url(./node_modules/bootstrap-icons/icons/star-fill.svg);
                                    background-size: contain;
                                    background-repeat: no-repeat;
                                    width: 15px;
                                    height: 15px;
                                    margin: 0;
                                }
                                .review_rating  figure,
                                #rating figure {
                                    background: url(./node_modules/bootstrap-icons/icons/star.svg);
                                    background-size: contain;
                                    background-repeat: no-repeat;
                                    width: 15px;
                                    margin: 0;
                                    height: 15px;
                                    display: block;
                                    cursor: pointer;
                                }
                            </style>
                            <div class="tab-pane fade shosw actsive" id="review" role="tabpanel" aria-labelledby="home-tab">
                               
                                <?php if(!isset($_SESSION['id'])):?>
                                    <p>Please <a href="login.php">login</a> first to add a review.</p>
                                <?php else : ?>
                                    <label>Rating</label>
                                     <div id="rating">
                                        <figure class="stars"></figure>
                                        <figure class="stars"></figure>
                                        <figure class="stars"></figure>
                                        <figure class="stars"></figure>
                                        <figure class="stars"></figure>
                                    </div>
                                    <br>
                                    <label>Comment</label>
                                    <textarea class="form-control textarea" id="comment" placeholder="type here..."></textarea>
                                    <br>
                                    <input data-id="<?= $product['id'];?>" type="submit" id="addRating" class="btn  btn-primary" name="">
                                <?php endif ?>

                                <style type="text/css">
                                    .reviews {
                                        display: flex;
                                        flex-direction: column;
                                        justify-content: space-around;
                                    }
                                    .box {
                                         display: flex;
                                        flex-direction: row;
                                        justify-content: left;
                                        margin: 10px 0;
                                    }
                                    .box_left {
                                        display: block;
                                        width: 100px;
                                        height: 100px;
                                    }
                                    .box_right {
                                        display: block;
                                    }
                                </style>
                                <br>
                                <div class="reviews row">
                                    <span id="appendbefore"></span>
                                    <?php foreach($comments as $idx => $c): ?>
                                        <div class="box">
                                            <div class="box_left">
                                                <img height="30" src="<?= ($c['profilePicture'] !='') ? $c['profilePicture'] : './node_modules/bootstrap-icons/icons/person-badge.svg';?>">
                                            </div>
                                            <div class="box_right">
                                                <div class="review_rating">
                                                    <?php for($i = 1;$i<=5;$i++) : ?>
                                                        <?php if($i <= $c['rating']): ?>
                                                            <figure class="stars active"></figure>
                                                        <?php else : ?>
                                                            <figure class="stars"></figure>
                                                        <?php endif ?>
                                                    <?php endfor ?>
                                                    
                                                </div>
                                                <p><?= $c['comment'];?></p>
                                                <i><?= $c['date_added'];?></i>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                               
                            </div>
                             <div class="tab-pane fade shosw actsive" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
                                    <div class="row">
                                        <p><?= ($fees) ? $fees['shipping_details'] : '';?></p>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
        <section class="sec3">
            <article class="container">
                <div class="row">
                    <div class="col-sm">
                        <h5>Related Products</h5>
                        <br>
                    </div>
                </div>
            </article>
            <article class="container">
                <style type="text/css">
                    .related {
                        display: flex;
                        flex-direction: row;
                        justify-content: space-around;
                    }
                    .related_product {
                        display: block;
                    }
                    .related_product {
                        background: #eee url(./images/14.jpg) center no-repeat;
                        width: 100%;
                        height: 200px;
                        background-size: contain;
                        margin: 0;
                    }
                </style>
                <div class="row related">
                    <?php foreach($related as $idx => $r): ?>
                        <div class="col-sm">
                            <a href="./productdetail.php?id=<?= $r['id'];?>"><figure class="related_product" style="background-image: url(./uploads/merchant/<?= $r['storeid'];?>/<?= $r['id'];?>/<?= $r['filename'];?>);"></figure></a>
                        </div>
                    <?php endforeach ?>
                </div>
                <br>
                <br>
            </article>
        </section>
    </main>

    <!-- start tpl -->
    <script type="text/html" id="tpl">
         <div class="box">
            <div class="box_left">
                <img height="30" src="[PROFILE]">
            </div>
            <div class="box_right">
                <div class="review_rating">
                    [RATING]
                </div>
                <p>[COMMENT]</p>
                <i>[DATE]</i>
            </div>
        </div>
    </script>
    <!-- end tpl -->
    <script src="./js/popper.min.js"></script>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js" ></script>
    <script type="text/javascript">
        (function($){
            $(document).ready(function(){
                var __listen = function(){

                }

                __listen();

                var qty = $("#qty");
                
                $("#zoomProduct").zoom();

                $("#addRating").on("click", function(e){
                    e.preventDefault();

                    var me = $(this);
                    var rating = $("#rating .stars.active").length;
                    var comment = $("#comment").val();

                    if(comment != ""){
                        showPreloader();

                        $.ajax({
                            url  : "ajax.php",
                            data : { addRating : true, comment : comment, id : me.data("id"), rating : rating},
                            type : "post",
                            dataType : "json",
                            success : function(response){
                                $("#reviewCount").html(response.count);
                               
                                hidePreloader();

                                var tplrating = $("#rating").html();
                                var tpl = $("#tpl").html();
                                var profile = response.profile;
                                tpl = tpl.replace("[COMMENT]", comment).
                                    replace("[RATING]", tplrating).
                                    replace("[PROFILE]", ( profile.profilePicture !=null) ? profile.profilePicture : './node_modules/bootstrap-icons/icons/person-badge.svg').
                                    replace("[DATE]", "a few seconds ago");

                                $("#appendbefore").before(tpl);
                                $("#comment").val("");
                                $("#rating .stars.active").removeClass("active");
                            }
                        });
                    } else {
                        alert("Please enter a comment");
                    }
                    console.log(comment, rating);
                }); 

                $(".sec1_thumb").on("click", function(e){
                    e.preventDefault();

                    var me = $(this);
                    var src = me.attr("src");

                    $(".zoomImg").remove();
                    $("#zoomImg").attr("src", src);
                    $("#zoomProduct").zoom();
                });

                $(".count").on("click", function(e){
                    e.preventDefault();

                    var me = $(this);
                    var action = me.data("action");
                    var current = qty.html();
                    var max = $("#maxQty").data("max");

                    if(action == "plus"){
                        if(parseInt(current) < max){
                            qty.html(parseInt(current) + 1);
                        }
                    } else {
                        if(parseInt(current) > 1){
                            qty.html(parseInt(current) - 1);
                        }
                    }
                    console.log(action);
                });

                $(".add2Cart").on("click", function(e){
                    e.preventDefault();

                    var me = $(this);
                    var btn = me.data("btn");

                    
                    var count = parseInt(qty.html());
                    var total = 0;
                    var cartData = Array();
                    cartData[0] = null;

                    if(localStorage.getItem("items") == null){
                        localStorage.setItem("items", JSON.stringify(cartData));
                    }

                   cartData = JSON.parse(localStorage.getItem("items"));

                    cartData[me.data("id")] = parseInt($("#qty").html());

                    localStorage.setItem("items", JSON.stringify(cartData));

                    var storeditems = JSON.parse(localStorage.getItem("items"));
                    console.log(storeditems);

                    for(var i in storeditems){
                        if(storeditems[i] != null){
                            total += 1;
                        }
                    }

                    $("#count").html(total);

                    if(btn == "add"){
                        me.removeClass("btn-light");
                        me.addClass("btn-success");
                        me.html("Added to Cart!");
                    } else {
                        window.location.href = "cart.php";
                    }
                    
                });

                $("#rating figure").on("click", function(){
                    var me = $(this);

                    $("#rating .stars").removeClass("active");

                    me.addClass("active");
                    me.prevAll(".stars").addClass("active");

                });
            });
        })(jQuery);
    </script>
</body>
</html>