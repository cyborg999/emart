
    <?php include_once "./head4.php"; ?>
    <?php include_once "./headnew.php"; ?>


    <main>
        <section class="sec1">
            <article class="container">
                <?php
                    $store = $model->getStoreById($_GET['id']);
                    $products = $model->getProductsByStoreId($_GET['id']);
                    // op($store);
                ?>
                <style type="text/css">
                    h1 {
                        text-align: center;
                        line-height: 1;
                        padding: 0;
                        margin: 0;
                        font-weight: 700;
                    }
                    #storeLogo {
                        width: auto;
                        height: 100px;
                        background-size: contain;
                        background-repeat: no-repeat;
                        background-position: center;
                        margin: 0 auto;
                        max-width: 400px;
                    }
                    i {
                        text-align: center;
                        font-size: 16px;
                        display: block;
                    }
                
                    .products {
                          display: flex;
                          flex-direction: row;
                          justify-content: space-around;
                      }
                     .product {
                      display: block;
                      width: 20%;
                      position: relative;
                      background: #f6f6f6;
                      padding: 0;
                      margin: 5px 0px;
                      box-sizing: border-box;
                     }
                     .product .img {
                      height: auto;
                      max-height: 250px;
                      display: block;
                      margin: 0 auto;
                     }
                    .product .content {
                      position: absolute;
                      display: none;
                      width: 100%;
                      height: 100%;
                      bottom: 0;
                      left: 0;
                      background: rgba(0,0,0,.5);
                     }
                     .product:hover .content {
                      display: block;
                     }
                     a.view {
                      padding: 6px 0;
                      color: white;
                      text-decoration: none;
                      border: 0;
                      border-radius: 5px;
                      font-size: 20px;
                      text-transform: uppercase;
                      font-weight: 600;
                      text-align: center;
                      background: #5677fc;
                      display: block;
                      width: 200px;
                      margin: 42% auto 0;
                     }
                     .bottom-content {
                      display: flex;
                      flex-direction: column;
                      justify-content: space-around;
                      padding: 5px;
                      box-sizing: border-box;
                      background: white;
                      margin-bottom: 0px;
                     }
                     .bottom-content h4 {
                          display: block;
                          position: relative;
                          overflow: hidden;
                          line-height: 1;
                          font-size: 18px;
                          margin: 0;
                          font-size: 20px;
                     }
                     .bottom-content em {
                          font-size: 18px;
                          font-style: normal;
                          font-weight: 600;
                          color: #5677fc;
                          margin: 0;
                          line-height: 1;
                     }
                     .rating {
                      display: flex;
                      width: 100px;
                      margin: 10px auto;
                      flex-direction: row;
                      justify-content: space-around;
                     }
                     .rate {
                      display: flex;
                      flex-direction: column;
                      justify-content: center;
                      width: 50%;
                      text-align: center;
                     }
                     .rate a {
                      display: block;
                      margin: 0 auto;
                      text-align: center;
                     }
                     .rate label {
                      text-align: center;
                      font-size: 16px;
                      display: block;
                      font-weight: 800;
                     }
                     .rate.active a {
                      color: blue;
                     }
                </style>
                <br>
                <br>
                <figure id="storeLogo" style="background-image:url(<?= ($store['logo'] !="") ? $store['logo'] : './node_modules/bootstrap-icons/icons/image-alt.svg';?>);"></figure>
                <h1><?= ($store) ? $store['name'] : '';?></h1>
                <i><?= ($store) ? $store['description'] : '';?></i>
                <br>
                <div class="rating">
                  <?php
                    $liked = $model->getLikesByStoreId($_GET['id']);
                    $disliked = $model->getLikesByStoreId($_GET['id'],true);
                    $likedIds = $model->getLikedIdByStoreId($_GET['id']);
                    $dislikedIds = $model->getLikedIdByStoreId($_GET['id'], true);
                  ?>
                  <div class="rate <?= (in_array($_SESSION['id'], $dislikedIds)) ? 'active' : '';?>">
                    <a href="" data-storeid="<?= $_GET['id'];?>"  data-userid="<?= (isset($_SESSION['id'])) ? $_SESSION['id'] : '0';?>" class="like disliked"><svg class="bi float-right gear" width="20" height="20" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#hand-thumbs-down"/></svg></a>
                    <label id="dislike"><?= count($disliked);?></label>
                  </div>
                  <div class="rate <?= (in_array($_SESSION['id'], $likedIds)) ? 'active' : '';?>">
                    <a href="" data-storeid="<?= $_GET['id'];?>" data-userid="<?= (isset($_SESSION['id'])) ? $_SESSION['id'] : '0';?>" class="liked like"><svg class="bi float-right gear" width="20" height="20" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#hand-thumbs-up"/></svg></a>
                    <label id="like"><?= count($liked);?></label>
                  </div>
                </div>
                <hr>

            </article>


            <article class="container">
              <div class="card card-body">
                  <div class="row">

                    <?php foreach($products as $idx => $p): ?>
                       <div class="col-md-3">
                        <figure class="card-product-grid mb-0 card-sm">
                          <div class="img-wrap"> <img src="./uploads/merchant/<?= $p['storeid'];?>/<?= $p['id'];?>/<?= $p['filename'];?>"> </div>
                          <figcaption class="info-wrap text-center">
                            <a href="productdetail.php?id=<?= $p['id'];?>" class="title"><?= $p['name'];?></a>
                            <div class="price mt-2">₱<?= number_format($p['price'],2);?></div> <!-- price-wrap.// -->
                          <a href="productdetail.php?id=<?= $p['id'];?>" class="btn btn-light text-primary btn-sm"> View Item </a>
                          </figcaption>
                        </figure> <!-- card // -->
                      </div> <!-- col.// -->
                      <?php endforeach ?>

                  </div> <!-- row.// -->
                </div>
            </article>
            <br>
            <br>
            <br>
            <br>
        </section>
    <?php include "./newfooter.php"; ?>
    </main>

    <!-- start tpl -->
    <script type="text/html" id="tpl">
 
    </script>
    <?php include "./foot.php"; ?>
    <script type="text/javascript">
        (function($){
            $(document).ready(function(){
                $(".like").on("click", function(e){
                  e.preventDefault();

                  var me = $(this);
                  var id = me.data("userid");


                  if(id){
                    $(".active").removeClass("active");
                    me.parents(".rate").addClass("active");

                    $.ajax({
                      url  : "ajax.php",
                      data : {
                        likeShop : true, 
                        like : me.hasClass("liked") ? "liked" : "disliked",
                        storeid : me.data("storeid"), 
                        userid : id
                      },
                      type : "post",
                      dataType : "json",
                      success : function(response){
                        console.log(response);
                        $("#like").html(response[0].liked);
                        $("#dislike").html(response[0].disliked);
                      }
                    });
                  } 
                });
            });
        })(jQuery);
    </script>
</body>
</html>