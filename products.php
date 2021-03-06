<?php include "./head2.php";?>
<?php include "./spinner.php";?>
<body>
   <style type="text/css">
    .advance {
      display: block;
    }
    tr.lowstock {
      background: #e6e6e6;
    }
    .lowstock .editqty {
      color: red;
      font-weight: 700;
    }
    .export {
      display: block;
      margin-top: 10px;
    }
  </style>
  <div class="container">
    <div class="row">
      <br>
    </div>
    <div class="row">
      <div class="col-sm-2 side">
        <?php $active="product"; include "./sidenav.php";?>
      </div>
      <div class="col-sm-10">

        <div class="content row">
          <h5>Product Inventory</h5>
        </div>
        <div class="content row">
           <?php
            $products = $model->getAllProducts();
            $store = $model->getStoreStockLimit();
          ?>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">Product</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Cost</th>
                <th scope="col">Quantity</th>
                <th scope="col">Brand</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr id="search">
                <td colspan="6">
                  <input type="text" class="form-control" id="searchName" placeholder="Name search..."/>
                  <a href="" class="advance">
                    <small>advance</small>
                  </a>
                </td>
              </tr>

              <tr  id="search" class="advance_tr hidden">
              <td colspan="4">
                <small style="max-width: 100%;"><i>Set alert when the remaining stock is less than or equal to</i></small>
              </td>
              <td colspan="2">
                <input type="number" class="form-control" id="stock" value="<?= ($store) ? $store['material_low'] : 20;?>">
              </td>
              <td colspan="1">
                <a href="" class="updateAlert btn btn-sm btn-primary">update</a>
              </td>
            </tr>
              <?php foreach($products as $idx => $product): ?>

              <tr class="result <?=($product['quantity'] <= $store['material_low']) ? 'lowstock' : ''; ?>" id="edit<?= $product['id']; ?>">
                <td class="editphoto"><img height="50" width="auto" src="uploads/merchant/<?= $_SESSION['storeid'];?>/<?= $product['id']; ?>/<?= $product['filename']; ?>" /></td>
                <td class="editname"><?= $product['name']; ?></td>
                <td class="editprice"><?= $product['price']; ?></td>
                <td class="editcost"><?= $product['cost']; ?></td>
                <td class="editqty"><?= $product['quantity']; ?></td>
                <td class="editbrand"><?= $product['brand']; ?></td>
                <td>

                  <a href="" data-expiration="<?= $product['expiration']; ?>" data-quantity="<?= $product['quantity']; ?>" data-description="<?= $product['description']; ?>" data-brand="<?= $product['brand']; ?>" data-price="<?= $product['price']; ?>" data-cost="<?= $product['cost']; ?>" data-id="<?= $product['id']; ?>" data-name="<?= $product['name']; ?>" class="btn btn-sm  edit"  data-toggle="modal" data-target="#editProductModal" alt="Edit product"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#pencil"/></svg> </a>
                  <a href="" data-id="<?= $product['id']; ?>" class="btn btn-sm  delete" alt="Delete Product"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg></a>
                </td>
              </tr>
              <?php endforeach ?>
             
             
            </tbody>
          </table>
        </div>


      </div>
    </div>
  </div>

  <!-- scripts -->

<!-- Modal -->
<div class="modal fade" id="editProductModal" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row  ">
          <div class="col-sm msg hidden"></div>
        </div>
        <div class="row">

          <div class="col-sm">
            <form method="post" id="editform">
            <div class="row">
              <div class="col-sm-6">
                <input type="hidden" name="editmaterial" id="editid" value="">
                  <div class="form-group">
                    <label>Name :
                      <input type="text" id="editname" required class="form-control" name="name" value="" placeholder="Material Name..."/>
                    </label>
                  </div>
                  <div class="form-group">
                    <label>Price:
                      <input type="text" id="editprice" required class="form-control" name="price" placeholder="Price..."/>
                    </label>
                  </div>
                  <div class="form-group">
                    <label>Cost:
                      <input type="text" id="editcost" required class="form-control" name="cost" placeholder="Cost..."/>
                    </label>
                  </div>
                  <div class="form-group">
                    <label>Expiration Date:
                      <input type="date" id="editexpiration" required class="form-control" name="expiration" placeholder="Expiration Date..."/>
                    </label>
                  </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Quantity:
                    <input type="number" readonly="" id="editqty" required class="form-control" name="quantity" placeholder="Quantity..."/>
                  </label>
                </div>
                <div class="form-group">
                  <label>Brand:
                    <input type="text" id="editbrand" required class="form-control" name="brand" placeholder="Brand..."/>
                  </label>
                </div>
                <div class="form-group">
                  <label>Description: </label>
                  <textarea id="editdescription" required class="form-control" name="description"></textarea>
                </div>
                <br>
                <input type="submit" class="btn btn-lg btn-success" value="Update">
              </div>
            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script type="text/html" id="productTPL">
      <tr class="result [LOWSTOCK]" id="edit[ID]">
         <td class="editphoto"><img height="50" width="auto" src="uploads/merchant/[STOREID]/[PRODUCTID]/[FILENAME]" /></td>
          <td class="editname">[NAME]</td>
          <td class="editprice">[PRICE]</td>
          <td class="editcost">[COST]</td>
          <td class="editqty">[QUANTITY]</td>
          <td class="editbrand">[BRAND]</td>
          <td>
            <a href="" data-expiration="[EXPIRATION]"  data-quantity="[QTY]" data-expiry="[EXPIRY]" data-cost="[COST]" data-price="[SRP]" data-id="[ID]" data-name="[NAME]" data-brand="[BRAND]" data-description="[DESCRIPTION]" class="btn btn-sm edit"  data-toggle="modal" data-target="#editProductModal" alt="Edit product"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#pencil"/></svg> </a>
            <a href="" data-id="[ID]" class="btn btn-sm  delete" alt="Delete Product"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg></a>
          </td>
        </tr>
</script>
<script type="text/html" id="mats">
  <tr>
    <td>[NAME]</td>
    <td>[PRICE]</td>
    <td>[QTY]</td>
    <td>
      <button  class="btn btn-sm btn-danger deleteMaterial" data-id="[ID]"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg></button>
    </td>
  </tr>
</script>
<script type="text/html" id="success">
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!!</strong> You have sucessfully updated this product.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
</script>
  <!-- end scripts -->
  <?php include "./foot.php"; ?>
  <script src="./node_modules/chosen-js/chosen.jquery.min.js" ></script>
  <script type="text/javascript">
    (function($){
      $(document).ready(function(){
        $("#editvendorname").chosen();

        $(".advance").on("click", function(e){
          e.preventDefault();

          $(".advance_tr").toggleClass("hidden");
        });

        $(".updateAlert").on("click", function(e){
          e.preventDefault();

          showPreloader();
          $.ajax({
            url : "ajax.php",
            data : {updateStock :true, type :'product', val : $("#stock").val() },
            type : "post",
            dataType : "json",
            success : function(response){
              hidePreloader();
            }
          });
        });

          
        function __listen(){
          $("#editform").off().on("submit", function(e){
            e.preventDefault();
            e.stopPropagation();

            var me = $(this);
            var cost = $("#editcost").val();
            var price = $("#editprice").val();

            if(parseFloat(cost) >= parseFloat(price)){
              alert("Cost Price should be less than Retail Price");

              return;
            }

            $.ajax({
              url : "ajax.php",
              data : me.serialize(),
              type : "post",
              dataType : "json",
              success : function(response){
                var tr = $("#edit"+response.editmaterial);

                tr.find(".editname").html(response.name);
                tr.find(".editcost").html(response.expiry);
                tr.find(".editprice").html(response.price);
                tr.find(".editqty").html(response.qty);
                tr.find(".editbrand").html(response.brand);

                $(".msg").append($("#success").html());
                $(".msg").removeClass("hidden");
                $(".preloader").addClass("hidden");
                
              }
            });
          });

          $(".edit").off().on("click", function(e){
            e.preventDefault();
            
            var me = $(this);
            var data = me.data();

            $("#editname").attr("value", data.name);
            $("#editprice").attr("value", data.price);
            $("#editcost").attr("value", data.cost);
            $("#editqty").attr("value", data.quantity);
            $("#editid").val(data.id);
            $("#editexpiration").val(data.expiration);
            $("#editbrand").attr("value", data.brand);
            $("#editdescription").html(data.description);

            console.log(data);
            $(".msg").addClass("hidden");
          });

          $(".delete").off().on("click", function(e){
            e.preventDefault();

            var me = $(this);
            var id = me.data("id");

            $(".preloader").removeClass("hidden");

            $.ajax({
              url : "ajax.php",
              data : { deleteMaterialInventory: true, id :id},
              type : "post",
              dataType : "json",
              success : function(response){
                me.parents("tr").remove();

                $(".preloader").addClass("hidden");
              }
            });
          });
        }

        __listen();

        function throttle(){
          setTimeout(function(){
            console.log('test');
          },1000);
        }

        const debounce = (func, wait) => {
          let timeout;

          return function executedFunction(...args) {
            const later = () => {
              clearTimeout(timeout);
              func(...args);
            };

            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
          };
        };

        var returnedFunction = debounce(function() {
          var txt = $("#searchName").val();

          $(".result").remove();
          $(".preloader").removeClass("hidden");

           $.ajax({
              url : "ajax.php"
              , data : { searchMaterial : true, txt : txt }
              , type : "post"
              , dataType : "json"
              , success : function(response){
                // productTPL
                console.log(response);
                for(var i in response){
                  console.log(response[i].name);
                  var tpl = $("#productTPL").html();
         

                  tpl = tpl.replace("[ID]", response[i].id).replace("[ID]", response[i].id).replace("[ID]", response[i].id).replace("[NAME]", response[i].name).replace("[NAME]", response[i].name).
                  replace("[PRICE]", response[i].price).
                  replace("[SRP]", response[i].price).
                  replace("[DESCRIPTION]", response[i].description).
                  replace("[NAME]", response[i].name).
                  replace("[LOWSTOCK]", (response[i].quantity <= $("#stock").val()) ? 'lowstock' : '').
                  replace("[BRAND]", response[i].brand).
                  replace("[STOREID]", response[i].storeid).
                  replace("[EXPIRY]", response[i].id).
                  replace("[QTY]", response[i].quantity).
                  replace("[REM]", response[i].remaining_qty).
                  replace("[PRICE]", response[i].price).
                  replace("[EXPIRATION]", response[i].expiration).
                  replace("[COST]", response[i].cost).
                  replace("[PRODUCTID]", response[i].id).
                  replace("[FILENAME]", response[i].filename).
                  replace("[PRICE]", response[i].price).replace("[COST]", response[i].cost).replace("[QUANTITY]", response[i].quantity).replace("[QUANTITY]", response[i].quantity).replace("[BRAND]", response[i].brand).replace("[BRAND]", response[i].brand);

                  $("#search").after(tpl);
                }
                
                __listen();
                setTimeout(function(){
                  $(".preloader").addClass("hidden");
                },200);


              }
            });

        }, 250);

        window.addEventListener('resize', returnedFunction);

        $('#searchName').on("keyup", returnedFunction);

        $("#addMaterial").on("click", function(e){
          e.preventDefault();

          var name = $("#materialName").val();
          var srp = $("#materialSrp").val();
          var qty = $("#materialQty").val();
          var id = $(this).data("id");
          
          $(".preloader").removeClass("hidden");

          $.ajax({
            url : "ajax.php",
            data : { 
              addMaterial : true, 
              name : name,
              srp : srp,
              id : id,
              qty : qty
            },
            type : "post",
            dataType : "json",
            success :  function(response){
              if(response.added){
                var tpl = $("#mats").html();

                tpl = tpl.replace("[NAME]", name).
                  replace("[ID]", response.id).
                  replace("[PRICE]", srp).replace("[QTY]", qty);

                $("#material tbody").append(tpl);

                $(".preloader").addClass("hidden");

                __listen();
              } else {
                alert("You already added this material to this product.");
              }
              
            }
          });
        });

      });

    })(jQuery);

  </script>
</body>
</html>