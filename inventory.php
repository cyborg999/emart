<?php include_once "./head.php"; ?>
<body>
  <?php include_once "./spinner.php"; ?>
  <div class="container-fluid">
    <div class="row">
      <br>
      <div class="col-sm-2 sidenav">
        <?php  $active = "product";  include_once "./sidenav.php"; ?>
      </div>
      <div class="col-sm-10">
        <?php include_once "./dashboardnav.php"; ?>
        <?php
          $products = $model->getAllProducts();

          $materials = $model->getAllMaterialInventory();
          $store = $model->getStoreStockLimit();

        ?>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Product Name</th>
              <!-- <th scope="col">SRP</th> -->
              <th scope="col">Quantity</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
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
            <tr>
              <td>
                <input type="text" class="form-control" id="searchName" placeholder="Name search..."/>
                <a href="" class="advance">
                  <small>advance</small>
                </a>
              </td>
              <td >
                <input type="number" class="form-control" id="searchQuantity" placeholder="Quantity"/>
                <a href="" class="btn-sm clearfilter">clear filter</a>
              </td>
              <td>
                <button id="filter" class="btn btn-sm btn-primary"> <= Filter</button>
                <a href="" id="addnew" data-toggle="modal" data-target="#addModal" class="btn btn-sm btn-success">Add New <svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#plus"/></svg></a>
               <a href="ajax.php?&export=true&products=true" class="export">export csv</a>
              </td>
            </tr>
            <tr  id="search" class="advance_tr hidden">
              <td colspan="2">
                <small style="max-width: 100%;"><i>Set alert when the remaining stock is less than or equal to</i></small>
              </td>
              <td >
                <input type="number" class="form-control" id="stock" value="<?= ($store) ? $store['product_low'] : 20;?>">
              </td>
              <td colspan="2">
                <a href="" class="updateAlert btn btn-sm btn-primary">update</a>
              </td>
            </tr>
            <?php foreach($products as $idx => $product): ?>

            <tr class="result <?=($product['qty'] <= $store['product_low']) ? 'lowstock' : ''; ?>" id="edit<?= $product['id']; ?>">
              <td class="editname"><?= $product['name']; ?></td>
              <!-- <td class="editsrp"><?= $product['srp']; ?></td> -->
              <td class="editqty"><?= $product['qty']; ?></td>
              <td>
                <a href="" data-qty="<?= $product['qty']; ?>" data-expiry="<?= $product['expiry_date']; ?>" data-srp="<?= $product['srp']; ?>" data-id="<?= $product['id']; ?>" data-name="<?= $product['name']; ?>"class="btn btn-sm btn-warning edit"  data-toggle="modal" data-target="#editProductModal" alt="Edit product"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#pencil"/></svg> </a>
                <a href="" data-id="<?= $product['id']; ?>" class="btn btn-sm btn-danger delete" alt="Delete Product"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg></a>
              </td>
            </tr>
            <?php endforeach ?>
           
           
          </tbody>
        </table>
      </div>
    </div>
    
  </div>

<!-- Modal -->
<div class="modal fade" id="editProductModal" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
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
          <div class="col-sm-5">
            <h5>Product Information</h5>
            <form method="post" id="editform">
              <input type="hidden" name="editproduct2" id="editid" value="">
              <div class="form-group">
                <label>Product Name:</label>
                <input type="text" id="editname" required class="form-control" name="name" value="" placeholder="Product Name..."/>
              </div>
           <!--    <div class="form-group">
                <label>Price:</label>
                <input type="text" id="editprice" required class="form-control" name="price" placeholder="Price..."/>
              </div> -->
              <div class="form-group">
                <label>Quantity:</label>
                <input type="number" readonly id="editqty" required class="form-control" name="qty" placeholder="Quantity..."/>

              </div>
              <!-- <div class="form-group">
                <label>Expiry Date:</label>
                <input type="date" id="editexpiry" required class="form-control" name="expiry" placeholder="Expiry Date..."/>
              </div> -->
              <input type="submit" class="btn btn-lg btn-success" value="Update">

            </form>
          </div>
          <div class="col-sm-7">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#raw" role="tab" aria-controls="home" aria-selected="true">Raw Materials Used</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#expenses" role="tab" aria-controls="profile" aria-selected="false">Expenses</a>
              </li> -->
            </ul>
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="raw" role="raw" aria-labelledby="home-tab">
                <table class="table table-hover table-sm" id="material">
                  <thead>
                    <tr>
                      <th scope="col">Name</th>
                      <!-- <th scope="col">Price</th> -->
                      <th scope="col">Unit</th>
                      <th scope="col">Quantity</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  </tbody>
                  <tfoot>
                    <tr>
                      <td style="width: 200px;">
                        <style type="text/css">
                          .chosen-container-single .chosen-single,
                          .chosen-container {
                            width: 200px!important;
                          }
                        </style>
                        <select  id="materialName" class="form-control" >
                          <?php foreach($materials as $idx => $material): ?>
                            <?php if($idx == 0): ?>
                            <option selected>Select</option>
                            <?php endif ?>
                            <option data-price="<?= $material['price'];?>"  data-max="<?= $material['qty'];?>"  data-name="<?= $material['name'];?>" value="<?= $material['id'];?>"><?= $material['name'];?></option>
                          <?php endforeach ?>
                        </select>

                      </td>
                     <!--  <td>
                        <input type="text" id="materialSrp" readonly class="form-control" name="price" placeholder="SRP..." required />
                      </td> -->
                      <td>
                        <select id="unit"  class="form-control" name="unit">
                          <option value="millilitre">Millilitre</option>
                          <option value="gram">Gram</option>
                          <option value="piece">Piece</option>
                        </select>
                      </td>
                      <td>
                        <input type="number" id="materialQty" class="form-control" name="qty" placeholder="Quantity..." min="1" required/>
                      </td>
                      <td>
                        <button id="addMaterial" class="btn btn-sm btn-primary" ><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#plus"/></svg></button>
                      </td>
                    </tr>
                  </tfoot> 
                </table>
                <!-- <h4 >Total Material Cost/<small>product quantity</small> : P<span id="total">0.00</span></h4> -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addModal" data-id="" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row  ">
          <div class="col-sm msg hidden"></div>
        </div>
        <div class="row">
          <div class="col-sm-5">
            <form method="post" id="addnewproduct">
              <input type="hidden" name="addproduct" value="true">
              <div class="form-group">
                <label>Product Name:
                  <input type="text" id="addname" required class="form-control" name="name" value="<?= isset($_POST['name']) ? $_POST['name'] : '';?>" placeholder="Product Name..."/>
                </label>
              </div>
              <div class="form-group hidden">
                <label>Price:
                  <input type="text"  class="form-control" name="price" placeholder="Price..."/>
                </label>
              </div>
              <div class="form-group hidden">
                <label>Quantity:
                  <input type="number"  class="form-control" name="qty" placeholder="Quantity..." value="0" />
                </label>
              </div>
              <div class="form-group hidden">
                <label>Expiry Date:
                  <input type="date"  class="form-control" name="expiry" placeholder="Expiry Date..."/>
                </label>
              </div>
              <input type="submit" class="btn btn-lg btn-primary" value="submit">
            </form>
          </div>
          <div class="col-sm-7">
            <table class="table table-hover table-sm">
              <thead>
                <tr>
                  <th scope="col">Name</th>
                  <th scope="col">Unit</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="tbody2">
                
              </tbody>
              <tfoot>
                <tr>
                  <td style="width: 200px;">
                    <select class="material form-control" >
                      <?php foreach($materials as $idx => $material): ?>
                        <?php if($idx == 0): ?>
                        <option selected>Select</option>
                        <?php endif ?>
                        <option data-price="<?= $material['price'];?>"  data-max="<?= $material['qty'];?>"  data-name="<?= $material['name'];?>" value="<?= $material['id'];?>"><?= $material['name'];?></option>
                      <?php endforeach ?>
                    </select>
                  </td>
                  <td>
                    <select class="unit form-control" name="unit">
                      <option value="millilitre">Millilitre</option>
                      <option value="gram">Gram</option>
                      <option value="piece">Piece</option>
                    </select>
                  </td>
                  <td>
                    <input type="number" class="qty form-control" name="qty" placeholder="Quantity..." min="1" required/>
                  </td>
                  <td>
                    <button id="addMaterial2" class="btn btn-sm btn-primary" ><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#plus"/></svg></button>
                  </td>
                </tr>
              </tfoot> 
            </table>
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
          <td class="editname">[NAME]</td>
          <!-- <td class="editsrp">[SRP]</td> -->
          <td class="editqty">[QTY]</td>
          <td>
            <a href="" data-qty="[QTY]" data-expiry="[EXPIRY]" data-srp="[SRP]" data-id="[ID]" data-name="[NAME]" class="btn btn-sm btn-warning edit"  data-toggle="modal" data-target="#editProductModal" alt="Edit product"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#pencil"/></svg> </a>
            <a href="" data-id="[ID]"" class="btn btn-sm btn-danger delete" alt="Delete Product"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg></a>
          </td>
        </tr>
</script>
<script type="text/html" id="mats">
  <tr>
    <td class="name">[NAME]</td>
    <td>[UNIT]</td>
    <td>[QTY]</td>
    <td>
      <button  class="btn btn-sm btn-danger deleteMaterial" data-mid="[MID]" data-id="[ID]" data-price="[PRICE]" data-qty="[QTY]" data-unit="[UNIT]"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg></button>
    </td>
  </tr>
</script>
<script type="text/html" id="expensesTpl">
  <tr>
    <td>[NAME]</td>
    <td>[COST]</td>
    <td>[DATE]</td>
    <td>
      <button  class="btn btn-sm btn-danger deleteExpenses"  data-id="[ID]"><svg class="bi" width="18" height="18" fill="currentColor"><use xlink:href="./node_modules/bootstrap-icons/bootstrap-icons.svg#trash"/></svg></button>
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
  <?php include_once "./foot.php"; ?>
  <script src="./node_modules/chosen-js/chosen.jquery.min.js" ></script>
  <script type="text/javascript">
    (function($){
      $(document).ready(function(){
        $("#addnew").on("click", function(){
          $("#addname").val("");
          $("#tbody2").html("");
        });

        function __listen(){
          // $(".preloader").addClass("hidden");
          
          $(".deleteMaterial").off().on("click", function(e){
            e.preventDefault();

            var me = $(this);
            var qty = me.data("qty");
            var price = me.data("price");
            var total = $("#total").html();


            $(".preloader").removeClass("hidden");

            $.ajax({
              url : "ajax.php",
              data : { deleteMaterial : true, qty : me.data("qty") ,id : me.data("mid")},
              type : "post",
              dataType : "json",
              success : function(response){
                $(".preloader").addClass("hidden");

                me.parents("tr").remove();

                $("#total").html(parseFloat(total) - (qty*price));
              }
            });

          });

          $(".deleteExpenses").off().on("click", function(e){
            e.preventDefault();

            var me = $(this);

            $(".preloader").removeClass("hidden");

            $.ajax({
              url : "ajax.php",
              data : { deleteExpenses : true, id : me.data("id")},
              type : "post",
              dataType : "json",
              success : function(response){
                $(".preloader").addClass("hidden");

                me.parents("tr").remove();
              }
            });

          });

          $("#editform").off().on("submit", function(e){
            e.preventDefault();

            var me = $(this);

            $.ajax({
              url : "ajax.php",
              data : me.serialize(),
              type : "post",
              dataType : "json",
              success : function(response){
                var tr = $("#edit"+response.editproduct);

                tr.find(".editname").html(response.name);
                tr.find(".editexpiry").html(response.expiry);
                tr.find(".editsrp").html(response.price);
                tr.find(".editqty").html(response.qty);

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
            $("#editqty").attr("value", data.qty);
            $("#editprice").attr("value", data.srp);
            $("#editid").attr("value", data.id);
            $("#addMaterial").data("id", data.id);
            $("#addExpenses").data("id", data.id);
            $("#editexpiry").attr("value", data.expiry);
            $(".msg").addClass("hidden");
            $(".preloader").removeClass("hidden");
            $("#material").find("tbody").html("");
            $("#total").html("");
            $("#expensesTbl tbody").html("");
            
            //get expenses
            $.ajax({
              url : "ajax.php",
              data : { getExpensesById : true, id : data.id},
              type : "post",
              dataType : 'json',
              success : function(response){

                for(var i in response){
                  var tpl = $("#expensesTpl").html();
                  tpl = tpl.replace("[NAME]", response[i].name).
                    replace("[ID]", response[i].id).
                    replace("[DATE]", response[i].date_produced).
                    replace("[COST]", response[i].cost);

                  $("#expensesTbl tbody").append(tpl);
                }

                __listen();
                $(".preloader").addClass("hidden");

              }
            });
            //get materials
            $.ajax({
              url : "ajax.php",
              data : { getMaterials : true, id : data.id},
              type : "post",
              dataType : 'json',
              success : function(response){
                var total = 0;

                for(var i in response){
                  var tpl = $("#mats").html();

                  tpl = tpl.replace("[NAME]", response[i].name).
                    replace("[ID]", response[i].id).
                    replace("[UNIT]", response[i].unit).
                    replace("[PRICE]", response[i].price).replace("[QTY]", response[i].qty).replace("[QTY]", response[i].qty).replace("[PRICE]", response[i].price).replace("[MID]", response[i].materialid);

                  total += response[i].price * response[i].qty;

                  $("#material tbody").append(tpl);
                }

                __listen();
                $("#total").html(total);
                $(".preloader").addClass("hidden");

              }
            });
          });

          $(".delete").off().on("click", function(e){
            e.preventDefault();

            var me = $(this);
            var id = me.data("id");

            $(".preloader").removeClass("hidden");

            $.ajax({
              url : "ajax.php",
              data : { deleteProduct: true, id :id},
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

        $(".clearfilter").on("click", function(e){
          e.preventDefault();

          $("#searchName, #searchQuantity").val("");
          $("#searchName").trigger("keyup");
        });
        
        $("#materialName").on("change", function(){
          var me = $(this);

          $("#materialSrp").val(me.find("option:selected").data("price"));
          $("#materialQty").attr("max", me.find("option:selected").data("max"));
          // $("#materialQty").attr("placeholder", me.find("option:selected").data("max"));
          $("#materialQty").val("");
        });

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
              , data : { searchProduct : true, txt : txt }
              , type : "post"
              , dataType : "json"
              , success : function(response){
                // productTPL
                console.log(response);
                for(var i in response){
                  console.log(response[i].name);
                  var tpl = $("#productTPL").html();

                  tpl = tpl.replace("[ID]", response[i].id).replace("[ID]", response[i].id).replace("[ID]", response[i].id).replace("[NAME]", response[i].name).
                  replace("[LOWSTOCK]", (response[i].qty <= $("#stock").val()) ? 'lowstock' : '').
                  replace("[NAME]", response[i].name)
                  .replace("[SRP]", response[i].srp).replace("[SRP]", response[i].srp).replace("[QTY]", response[i].qty).replace("[QTY]", response[i].qty);

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

        $("#materialName").chosen();
        $("#unit").chosen();

        $("#addnewproduct").on("submit", function(e){
          e.preventDefault();

          var me = $(this);
          var materials = Array();

          $("#tbody2 tr").each(function(){
            var meTr = $(this);
            var data = meTr.find(".deleteMaterial").data();

            materials.push(data);
          });

          $.ajax({
            url : "ajax.php",
            data : { addNewProduct : true, name : $("#addname").val(), data : materials},
            type : "post",
            dataType : "json",
            success :function(response){
              if(response.errors.length){
                alert("Product already exists");
              } else {
                console.log("added");
                window.location.href = "products.php";
              }
            }
          })
        });

        $("#addMaterial2").on("click", function(e){
          e.preventDefault();

          var me = $(this);

          var tr = me.parents("tr");
          var material = tr.find(".material").val();
          var materialHTML = tr.find(".material option:selected").html();
          var qty = tr.find(".qty").val();
          var unit = tr.find(".unit").val();
          var max = tr.find(".material option:selected").data("max");

          console.log(material, qty, unit, max);

          if(qty == ""){
            alert("Please Input Quantity");
            
          } else if(qty > max) {
            alert("Not enough stocks");

          } else {
            var found = false;

            $("#tbody2 tr").each(function(){
              var meTr = $(this);

              if(meTr.find(".name").html() == materialHTML){
                alert("You already added this material");

                found = true;
                return;
              }

            });

            if(found){
              return;
            }

            var tpl = $("#mats").html(); 

            tpl = tpl.replace("[NAME]", materialHTML).
              replace("[QTY]", qty).
              replace("[UNIT]", unit).
              replace("[QTY]", qty).
              replace("[ID]", material).
              replace("[UNIT]", unit);

            $("#tbody2").append(tpl);

            __listen();
          }
      
        });

        $("#addMaterial").on("click", function(e){
          e.preventDefault();

          var material = $("#materialName option:selected").data();
          var srp = $("#materialSrp").val();
          var qty = $("#materialQty").val();
          var unit = $("#unit").val();
          var id = $(this).data("id");
          var max = $("#materialQty option:selected").data();

          if(qty == ""){
            alert("Please Input Quantity");
            
          } else if(qty > material.max) {
            alert("Not enough stocks");

          } else {
            $.ajax({
              url : "ajax.php",
              data : { 
                addMaterial : true, 
                materialId : $("#materialName").val(),
                id : id,
                unit : unit,
                qty : qty
              },
              type : "post",
              dataType : "json",
              success :  function(response){
                if(response.added){
                  var tpl = $("#mats").html(); 

                  tpl = tpl.replace("[NAME]", material.name).
                    replace("[ID]", response.id).
                    replace("[UNIT]", unit).
                    replace("[PRICE]", material.price).replace("[QTY]", qty).replace("[QTY]", qty).replace("[PRICE]", material.price).replace("[MID]", $("#materialName").val());

                  $("#material tbody").append(tpl);
                  var total = $("#total").html();

                  $("#total").html(parseFloat(total) + (qty*material.price));
                  __listen();
                } else {
                  alert("You already added this material to this product.");
                }
                
                $(".preloader").addClass("hidden");
                
              }
            });

          }
      
        });

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

        $("#filter").on("click", function(e){
          e.preventDefault();

          var qty = $("#searchQuantity").val();

          $(".result").remove();
          $(".preloader").removeClass("hidden");

           $.ajax({
              url : "ajax.php"
              , data : { searchProductByQuantity : true, qty : qty }
              , type : "post"
              , dataType : "json"
              , success : function(response){
                // productTPL
                console.log(response);
                for(var i in response){
                  console.log(response[i].name);
                  var tpl = $("#productTPL").html();

                  tpl = tpl.replace("[ID]", response[i].id).replace("[ID]", response[i].id).replace("[ID]", response[i].id).replace("[NAME]", response[i].name).
                  replace("[LOWSTOCK]", (response[i].qty <= $("#stock").val()) ? 'lowstock' : '').
                  replace("[NAME]", response[i].name)
                  .replace("[SRP]", response[i].srp).replace("[SRP]", response[i].srp).replace("[QTY]", response[i].qty).replace("[QTY]", response[i].qty);

                  $("#search").after(tpl);
                }
                
                __listen();
                setTimeout(function(){
                  $(".preloader").addClass("hidden");
                },200);


              }
            });
        });

        $("#addExpenses").on("click", function(e){
          e.preventDefault();

          var name = $("#expName").val();
          var cost = $("#expCost").val();
          var date = $("#dateProduced").val();
          var productId = $(this).data("id");

          $(".preloader").removeClass("hidden");

          $.ajax({
            url : "ajax.php",
            data : { 
              addExpenses : true, 
              name : name,
              date : date,
              id : productId,
              cost : cost
            },
            type : "post",
            dataType : "json",
            success :  function(response){

              if(response.added){
                var tpl = $("#expensesTpl").html();

                tpl = tpl.replace("[NAME]", name).
                  replace("[ID]", response.id).
                  replace("[DATE]", date).
                  replace("[COST]", cost);

                $("#expensesTbl tbody").append(tpl);

                __listen();
              } else {
                alert("You already added this material to this product.");
              }
              
              $(".preloader").addClass("hidden");
              
            }
          });
      
        });


      });

    })(jQuery);

  </script>
</body>
</html>