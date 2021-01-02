<div class="col-md-12">
    <div class="bt-deal">
        <div class="sec-title">
            <h6>Best Sellers</h6>
        </div>
        <div class="row">
            <?php
                $bestsellers = $model->getBestSeller();
                // op($bestsellers);
            ?>
            <style type="text/css">
                .item {
                    display: flex;
                    flex-direction: row;
                    justify-content: space-between;
                }
                .item .img {
                    width: 100%;
                    height: auto;
                }
                .item .content {
                    display: block;
                    width: 20%;
                }
                .item .bottom-content {
                    display: block;
                    width: 80%;
                }
                .item a {
                    font-size: 12px;
                    line-height: 1;
                    text-decoration: none;
                    display: block;
                }
                .item h4 {
                    font-size: 14px!important;
                }
            </style>
             <?php foreach($bestsellers as $idx => $p): ?>
              <div class="item col-sm-12">
                  <div class="content">
                    <img class="img" src="./uploads/merchant/<?= $p['storeid'];?>/<?= $p['id'];?>/<?= $p['filename'];?>"/>
                  </div>
                  <div class="bottom-content">
                      <a href="productdetail.php?id=<?= $p['id'];?>" target="_blank"><?= $p['name'];?></a>
                      <h4>₱<?= $p['price'];?></h4>
                  </div>
              </div>
             <?php endforeach ?>
        </div>
    </div>
</div>

