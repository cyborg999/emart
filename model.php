<?php
session_start();

class Model {
	public $db;
	public $errors = array();
	public $success;

	public function __construct(){
		require_once "config.php";

		$this->db = $db;

		$this->signUpListener();
		$this->loginListener();
		$this->addStoreListener();
		$this->addSubscriptionListener();
		$this->getAllUnverifiedStores();
		$this->addProductListener();
		$this->deleteProductListener();
		$this->editproductListener();
		$this->addMaterialListener();
		$this->getMaterialsListener();
		$this->deleteMaterialListener();
		$this->updateUserInfoListener();
		$this->uploadProfileListener();
		$this->searchProductListener();
		$this->addVendorListener();
		$this->deleteVendorListener();
		$this->editvendorListener();
		$this->searchVendorListener();
		$this->addProductionListener();
		$this->deleteProductionListener();
		$this->addSaleListener();
		$this->deleteSaleListener();
		$this->addPurchaseListener();
		$this->deletePurchaseListener();
		$this->addMaterialInventoryListener();
		$this->deleteMaterialInventoryListener();
		$this->editMaterialListener();
		$this->searchMaterialListener();
		$this->updatePurchaseTypeListener();
		$this->filterPurchaseListener();
		$this->exportPurchaseReportListener();
		$this->getMonthlyProductionReport();
		$this->getMonthlyProductionReportByYear();
		$this->getMonthlySalesReportListener();
		$this->loadMonthlyDataListener();
		$this->loadLineChartListener();
		$this->resetPasswordListener();
		$this->verifyUserListener();
		$this->dropZoneTest();
		$this->addSliderListener();
		$this->deleteSlideListener();
		$this->updateSliderStatus();
		$this->addLogoListener();
		$this->addPlanListener();
		$this->deletePlanListener();
		$this->activatePlanListener();
		$this->addCategoryListener();
		$this->deleteCategoryListener();
		$this->updateCategoryStatus();
		$this->addRatingListener();
		$this->updateUserTypeListener();
		$this->getCartItemsListener();
		$this->updateGlobalFeeListener();
		$this->checkoutListener();
		$this->checkoutPayListener();
		$this->updateShippingDetailsListener();
		$this->updateStoreListener();
		$this->likeShopListener();
		$this->addStoreSubscriptionListener();
		$this->codPaymentListener();
		$this->updateOrderStatusListener();
		$this->payListener();
		$this->loadSalesReportListener();
		$this->loadMonthlyListener();
		$this->loadInventoryListener();
		$this->exportListener();
	}

	public function exportListener(){
		if(isset($_GET['export'])){
			if(isset($_GET['inventory'])){
				// output headers so that the file is downloaded rather than displayed
				header('Content-Type: text/csv; charset=utf-8');
				header('Content-Disposition: attachment; filename=InventoryReport.csv');

				// create a file pointer connected to the output stream
				$output = fopen('php://output', 'w');

				// output the column headings
				fputcsv($output, array('Product', 'Price', 'Quantity', "Brand", "Category"));

				$records = $this->db->query($_SESSION['lastQuery'])->fetchAll();

				foreach($records as $idx => $r){
					$data = array($r['name'],$r['price'],$r['quantity'],$r['brand'],$r['category']);
					fputcsv($output, $data);
				}

			}
		}
	}

	public function payListener(){
		if(isset($_POST['pay'])){
			//insert transaction
			$sql = "
				INSERT INTO transaction(userid,total,status)
				VALUES(?,?,?)
			";

			$this->db->prepare($sql)->execute(array($_SESSION['id'], $_POST['grandTotal'], "pos"));

			$transactionId = $this->db->lastInsertId();

			foreach($_POST['products'] as $idx => $p){
				$sql = "
					INSERT INTO pos(userid,productid,qty,price,storeid,tax,transaction_id)
					VALUES(?,?,?,?,?,?,?)
				";

				$this->db->prepare($sql)->execute(array($_SESSION['id'], $p[2], $p[0], $p[1], $_SESSION['storeid'], $_POST['tax'], $transactionId));

				$this->updateProductQuantityById($p[2],$p[0]);
			}

			die(json_encode("added"));
		}
	}
	
	public function sendMail($email){
		$msg = "Your order:product has been processed. Expected delivery is on :";
		$msg = wordwrap($msg,70);

		mail($email,"eMart - Delivery Notice",$msg);

		return $this;
	}


	public function updateOrderStatusListener(){
		if(isset($_POST['updateOrderStatus'])){
			if($_POST['status'] == "processed" || $_POST['status'] == "delivered"){
				//update delivery date
				// $orderDetail = $this->getProductById($_POST['id']);
				$sql = "
					select *
					from fees
					where storeid = ".$_POST['storeid']."
					limit 1
				";

				$fees = $this->db->query($sql)->fetch();

				$shippingDays = ($fees) ? ($fees['shipping_day'] == "") ? 1 : $fees['shipping_day'] : 1;

				$deliveryDate = date('Y-m-d', strtotime("+".$shippingDays." days", strtotime($_POST['date_added'])));

				$sql = "
					UPDATE cart
					set status = ?, delivery_date = ?
					where id = ?
				";

				$this->db->prepare($sql)->execute(array($_POST['status'], $deliveryDate, $_POST['id']));
			} else {
				if($_POST['status'] == "returned"){
					$sql = "
						UPDATE cart
						set status = ?, reason = ?
						where id = ?
					";

					$this->db->prepare($sql)->execute(array($_POST['status'], $_POST['reason'], $_POST['id']));

				} else {
					$sql = "
						UPDATE cart
						set status = ?
						where id = ?
					";

					$this->db->prepare($sql)->execute(array($_POST['status'], $_POST['id']));
				}
			}

			if($_POST['status'] == "cancelled"){
				$this->updateProductQuantityById($_POST['productid'], $_POST['qty'], true);
			}

			die(json_encode("updated"));
		}
	}

	public function getBestSeller(){
		$sql = "
			SELECT  t2.*, t3.name as 'filename'
			FROM cart t1
			left join productt t2
			on t1.productid = t2.id
			left join media t3
			on t3.productid = t2.id
			where t1.status = 'delivered'
			and t3.active = 1
			GROUP BY t1.productid
			limit 10
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function codPaymentListener(){
		if(isset($_POST['codPayment'])){
			$sql = "INSERT INTO payments(payment_id, amount, currency, payment_status,userid) VALUES(?,?,?,?,?)
                          ";

          	$this->db->prepare($sql)->execute(array("COD", $_POST['amount'], 'PHP', 'Pending', $_SESSION['id']));

          	//add transaction
			$sql = "
			  INSERT INTO transaction(userid,total)
			  VALUES(?,?)
			";

			$this->db->prepare($sql)->execute(array($_SESSION['id'], $_SESSION['cart']['total']));
			$transactionId = $this->db->lastInsertId();

			//add cart detail
			$sql = "
			  INSERT INTO cart_details(transactionid,userid,fullname,address,contact,email,instruction,total,tax_total,grand_total,shipping_total)
			  VALUES(?,?,?,?,?,?,?,?,?,?,?)
			";

			$this->db->prepare($sql)->execute(array($transactionId,$_SESSION['id'],$_POST['fullname'],$_POST['address'],$_POST['contact'],$_POST['email'],$_SESSION['cart']['instruction'],$_SESSION['cart']['total'],$_SESSION['cart']['taxTotal'],$_SESSION['cart']['grandTotal'],$_SESSION['cart']['shippingTotal']));

			//add cart products
			if(isset($_SESSION['cart']['products'])){
				foreach($_SESSION['cart']['products'] as $idx0 => $i){
                    foreach($i['products'] as $idx => $p){
						$sql = "
						  INSERT INTO cart(userid,productid,price,quantity,shipping,tax,transactionid,storeid,status)
						  VALUES(?,?,?,?,?,?,?,?,?)   
						";          
						$this->db->prepare($sql)->execute(array($_SESSION['id'],$p['productId'],$p['detail']['price'],$p['qty'],$p['detail']['shipping'],$p['detail']['tax'], $transactionId, $p['detail']['storeid'], 'pending'));

						$this->updateProductQuantityById($p['productId'], $p['qty']);
                    }
                }
			}

			header("Location: success.php");
		}
	}

	public function loadSalesReportListener(){
		if(isset($_POST['loadSalesReport'])){
			$data = $this->getCurrentYearAnnualEarnings("ecom", $_POST['year']);

			die($data);
		}
	}

	public function loadMonthlyListener(){
		if(isset($_POST['loadMonthly'])){
			$storeid = $_SESSION['storeid'];
			$status = "delivered";
			$month = $_POST['month'];
			$products = array();

			$sql = "
				select t1.*,t2.name as 'product'
				from cart t1
				left join productt t2
				on t2.id = t1.productid
				where t1.storeid = $storeid
				and  t1.status = '$status'
				and MONTH( t1.date_created) = '$month'
				and YEAR( t1.date_created) = YEAR(CURDATE())
			";

			$_SESSION['lastQuery'] = $sql;

			$record = $this->db->query($sql)->fetchAll();

			foreach($record as $idx => $r){
				$total = ((($r['price'] * $r['quantity']) * ($r['tax']/100)) + ($r['price'] * $r['quantity'])) + $r['shipping'];

				// $months[$m] += $total;
				$products[$r['productid']]['name'] = $r['product'];
				@$products[$r['productid']]['total'] += $total;
			}

			$labels = array();
			$items = array();

			foreach($products as $idx => $p){
				$labels[] = $p['name'];
				$items[] = $p['total'];
			}

			$data =  json_encode(array("total" => $items,  "labels"=> $labels, "record" => $record));

			die($data);
		}
	}

	public function loadAnnualUsersListener(){
		$sql = "
			select year(date_created) as 'year', count(t1.id) as 'total'
			from user t1
			group by year(date_created)
		";

		$record = $this->db->query($sql)->fetchAll();


		$labels = array();
		$items = array();

		foreach($record as $idx => $p){
			$labels[] = $p['year'];
			$items[] = $p['total'];
		}

		$data =  array("total" => $items,  "labels"=> $labels, "record" => $record);

		return $data;
	}

	public function loadInventoryListener(){
		if(isset($_POST['loadInventory'])){
			$storeid = $_SESSION['storeid'];
			$products = array();
			$filter = $_POST['filter'];
			$txt = $_POST['txt'];
			$and = "";

			if($filter == "name"){
				$and = "and t1.name like '%$txt%'";
			} else if($filter == "brand"){
				$and = "and t1.brand like '%$txt%'";
			} else if($filter == "qty"){
				$and = "and t1.quantity <= $txt";
			}  else {
				$and = "and t3.name like '%$txt%'";
			} 

			$sql = "
				select t1.*, t3.name as 'category'
				from productt t1
				left join category t3
				on t3.id = t1.categoryid
				where t1.storeid = $storeid
				$and

			";

			$_SESSION['lastQuery'] = $sql;
			// op($sql);
			// oppd();
			$record = $this->db->query($sql)->fetchAll();

			die(json_encode(array("record" => $record)));
		}
	}

	public function getCurrentYearAnnualEarnings($type = "ecom", $year = false, $json = true){
		$storeid = $_SESSION['storeid'];
		$status = "delivered";
		$month = "todo";
		$record = null;
		$months = array(
			"Jan" => 0,
			"Feb" => 0,
			"Mar" => 0,
			"Apr" => 0,
			"May" => 0,
			"Jun" => 0,
			"Jul" => 0,
			"Aug" => 0,
			"Sep" => 0,
			"Oct" => 0,
			"Nov" => 0,
			"Dec" => 0
		);

		if($year){
			$sql = "
				select t1.*,t2.name as 'product'
				from cart t1
				left join productt t2
				on t2.id = t1.productid
				where t1.storeid = $storeid
				and  t1.status = '$status'
				and YEAR( t1.date_created) = $year
			";

		} else {
			$sql = "
				select *
				from cart
				where storeid = $storeid
				and status = '$status'
				and YEAR(date_created) = YEAR(CURDATE())
			";
		}
		
		$_SESSION['lastQuery'] = $sql;

		$record = $this->db->query($sql)->fetchAll();

		foreach($record as $idx => $r){
			$total = ((($r['price'] * $r['quantity']) * ($r['tax']/100)) + ($r['price'] * $r['quantity'])) + $r['shipping'];
			$m = date_format(date_create($r['date_created']), "M");
			$y = date_format(date_create($r['date_created']), "Y");

			$months[$m] += $total;
		}

		$totalOnly = array_values($months);

		if(!$json){
			return array("total" => $totalOnly, "record" => $record);

		}

		return json_encode(array("total" => $totalOnly, "record" => $record));
	}

	public function getStoreMonthlyEarnings($type = "ecom", $getTotal = false){
		$total = 0;
		$storeid = $_SESSION['storeid'];
		$status = "delivered";
		$month = "todo";

		if($type == "pos"){
			$sql = "
				select *
				from pos
				where storeid = $storeid
				and MONTH(date_created) = MONTH(CURDATE())
			";

			$record = $this->db->query($sql)->fetchAll();

			foreach($record as $idx => $r){
				$total += ((($r['price'] * $r['qty']) * ($r['tax']/100)) + ($r['price'] * $r['qty'])) ;
			}
		} else {
			$sql = "
				select *
				from cart
				where storeid = $storeid
				and status = '$status'
				and MONTH(date_created) = MONTH(CURDATE())
			";
			$record = $this->db->query($sql)->fetchAll();

			foreach($record as $idx => $r){
				$total += ((($r['price'] * $r['quantity']) * ($r['tax']/100)) + ($r['price'] * $r['quantity'])) + $r['shipping'];
			}
		}

		if($getTotal){
			return $total;
		}

	}

	public function updateProductQuantityById($id, $qty, $add = false){
		$sql = "
			update productt
			set quantity = quantity-?
			where id = ?
		";

		if($add){
			$sql = "
				update productt
				set quantity = quantity+?
				where id = ?
			";
		}
		
		$this->db->prepare($sql)->execute(array($qty, $id));

		return $this;
	}

	public function addStoreSubscriptionListener(){
		if(isset($_POST['addStoreSubscription'])){
			$_SESSION['setup']['subscriptionId'] = $_POST['subscriptionId'];
			
			die(json_encode(array("added" => true)));
		}
	}

	public function likeShopListener(){
		if(isset($_POST['likeShop'])){
			// oppd();
			$userid = $_POST['userid'];
			$storeId = $_POST['storeid'];

			$sql = "
				SELECT *
				FROM likes
				WHERE userid = $userid
				AND storeid = $storeId
				LIMIT 1
			";

			$exists = $this->db->query($sql)->fetch();

			if($exists){
				if($_POST['like'] == "disliked"){
					$sql = "
						UPDATE likes
						SET dislike = 1, liked = 0
						WHERE userid = ?
						AND storeid = ?
					";
				} else {
					$sql = "
						UPDATE likes
						SET dislike = 0, liked = 1
						WHERE userid = ?
						AND storeid = ?
					";
				}

				$this->db->prepare($sql)->execute(array($_POST['userid'], $_POST['storeid']));
				
			} else {
				if($_POST['like'] == "disliked"){
					$sql = "
						INSERT INTO likes(storeid,liked,dislike,userid)
						VALUES(?,?,?,?)
					";
					$this->db->prepare($sql)->execute(array($_POST['storeid'], 0, 1, $_POST['userid'], ));
				} else {
					$sql = "
						INSERT INTO likes(storeid,liked,dislike,userid)
						VALUES(?,?,?,?)
					";
					$this->db->prepare($sql)->execute(array($_POST['storeid'], 1, 0, $_POST['userid'], ));
				}
			}

			$data = array(
				"liked" => count($this->getLikesByStoreId($_POST['storeid'])),
				"disliked" => count($this->getLikesByStoreId($_POST['storeid'],true))
			);

			die(json_encode(array($data)));
		}
	}

	public function updateStoreListener(){
		if(isset($_POST['updateStore'])){
			$files = $_FILES['storelogo']['tmp_name'];

			if($files != ""){

				//start
				$merchantPath = 'uploads/merchant/'.$_SESSION['storeid']."/logo/";
				
			
				if(!file_exists($merchantPath)){
					mkdir($merchantPath,0777,true);
				}

				$folder_name = $merchantPath;

				 $temp_file = $_FILES['storelogo']['tmp_name'];
				 $ext = strtolower(pathinfo($_FILES["storelogo"]["name"],PATHINFO_EXTENSION));
				 $newName = md5($_FILES['storelogo']['name']) .".".$ext;
				 $location = $folder_name . $newName;

				 if(move_uploaded_file($temp_file, $location)){
				 	$sql = "
						UPDATE store
						SET description = ?, logo = ?
						WHERE id = ?
					";

					$this->db->prepare($sql)->execute(array($_POST['description'], $location, $_SESSION['storeid']));

					$this->success = "You have succesfully updated your store.";
				}

			} else {
				$sql = "
					UPDATE store
					SET description = ?
					WHERE id = ?
				";

				$this->db->prepare($sql)->execute(array($_POST['description'], $_SESSION['storeid']));

				$this->success = "You have succesfully updated your store.";
			}

		}

		return $this;

	}

	public function checkoutPayListener(){
		if(isset($_POST['checkoutPay'])){

			oppd();
			$transactionId = $this->addTransaction();
			$this->addCartDetails($transactionId);
			$this->addCartProducts($transactionId);
		}
	}

	protected function addCartProducts($transactionId){
		if(isset($_SESSION['cart']['products'])){
			foreach($_SESSION['cart']['products'] as $idx => $p){
				$sql = "
					INSERT INTO cart(userid,productid,price,quantity,shipping,tax,transactionid)
					VALUES(?,?,?,?,?,?,?)	
				";			
				$this->db->prepare($sql)->execute(array($_SESSION['id'],$p['productId'],$p['detail']['price'],$p['detail']['quantity'],$p['detail']['shipping'],$p['detail']['tax'], $transactionId));
			}

		}

		return $this;
	}

	protected function addCartDetails($transactionId){
		$sql = "
			INSERT INTO cart_details(transactionid,userid,fullname,address,contact,email,instruction,total,tax_total,grand_total,shipping_total)
			VALUES(?,?,?,?,?,?,?,?,?,?,?)
		";

		$this->db->prepare($sql)->execute(array($transactionId,$_SESSION['id'],$_POST['fullname'],$_POST['address'],$_POST['contact'],$_POST['email'],$_SESSION['cart']['instruction'],$_SESSION['cart']['total'],$_SESSION['cart']['taxTotal'],$_SESSION['cart']['grandTotal'],$_SESSION['cart']['shippingTotal']));

		return $this;
	}

	protected function addTransaction(){
		$sql = "
			INSERT INTO transaction(userid,total)
			VALUES(?,?)
		";

		$this->db->prepare($sql)->execute(array($_SESSION['id'], $_SESSION['cart']['total']));

		return $this->db->lastInsertId();
	}

	public function checkoutListener(){
		if(isset($_POST['checkout'])){
			$products = $_POST['products'];
			$modifiedQty = $_POST['modifiedQty'];

			foreach($products as $idx => &$p){
				foreach($p['products'] as $idx2 => &$pp ){
					$pId = $pp['productId'];
					$qty = $pp['qty'];
					$pp['qty'] = $modifiedQty[$pp['productId']];
				}
			}

			$_POST['products'] = $products;

			$_SESSION['cart'] = $_POST;

			die(json_encode(array("added")));
		}
	}

	public function updateShippingDetailsListener() {
		if(isset($_POST['updateShippingDetails'])){
			$exists = $this->getGlobalFees();

			if(!$exists){
				$sql = "
					INSERT INTO fees(storeid,shipping_details,shipping_day)
					VALUES(?,?,?)
				";	

				$this->db->prepare($sql)->execute(array($_SESSION['storeid'],$_POST['details'],$_POST['ship_days']));

				$this->success = "You have succesfully added this record";
			} else {
				$sql = "
					UPDATE fees
					SET shipping_details = ?, shipping_day=?
					WHERE storeid = ?
				";	

				$this->db->prepare($sql)->execute(array($_POST['details'],$_POST['ship_days'],$_SESSION['storeid']));

				$this->success = "You have succesfully updated this record";
			}

			return $this;
		}			
	}

	public function getGlobalFeesByStoreId($id){
		$sql = "
			SELECT *
			FROM fees
			WHERE storeid = $id
			LIMIT 1
		";

		 // PDO::FETCH_ASSOC
		return $this->db->query($sql)->fetch();
		
	}

	public function getGlobalFees(){
		$sql = "
			SELECT *
			FROM fees
			WHERE storeid = ".$_SESSION['storeid']."
			LIMIT 1
		";

	// PDO::FETCH_ASSO
		$fees = $this->db->query($sql);
		return $fees->fetch();
		if($fees){
			return $fees->fetch();

		} else {
			
			return false;
		}
	}

	public function updateGlobalFeeListener(){
		if(isset($_POST['updateGlobalFee'])){
			if(!is_numeric($_POST['shipping'])){
				$this->errors[] = "Shipping fee should be number.";
			}
			if(!is_numeric($_POST['tax'])){
				$this->errors[] = "Tax fee should be number.";
			}

			if(!count($this->errors)){
				$exists = $this->getGlobalFees();

				if(!$exists){
					$sql = "
						INSERT INTO fees(storeid,shipping,tax)
						VALUES(?,?,?)
					";	

					$this->db->prepare($sql)->execute(array($_SESSION['storeid'],$_POST['shipping'],$_POST['tax']));

					$this->success = "You have succesfully added this record";
				} else {
					$sql = "
						UPDATE fees
						SET shipping = ?, tax = ?
						WHERE storeid = ?
					";	

					$this->db->prepare($sql)->execute(array($_POST['shipping'],$_POST['tax'],$_SESSION['storeid']));

					$this->success = "You have succesfully updated this record";
				}
			
			}

			return $this;
		}
	}

	public function getCartItemsListener(){
		if(isset($_POST['getCartItems'])){
			$products = $_POST['products'];
			$products = str_replace("[", "", $products);
			$products = str_replace("]", "", $products);
			$products = explode(",", $products);

			$cartItems = array();
			foreach($products as  $idx => $p){
				if($p != "null"){

					$sql = "
						SELECT t5.name as 'storename', t5.logo as 'storelogo',t1.*,t2.name as 'filename', t3.name as 'category', t4.shipping, t4.tax
						FROM productt t1
						LEFT JOIN media t2
						ON t1.id = t2.productid
						LEFT JOIN category t3
						ON t1.categoryid = t3.id
						LEFT JOIN fees t4 
						ON t4.storeid = t1.storeid
						LEFT JOIN store t5
						ON t5.id = t1.storeid
						WHERE t1.id = $idx
						AND t2.active = 1
						LIMIT 1
					";
					$detail = $this->db->query($sql)->fetch();

					if(!$detail){
						die(json_encode($cartItems));
					}

					$cartItems[$detail['storeid']]['storetax'] = $detail['tax'];
					$cartItems[$detail['storeid']]['storeshipping'] = $detail['shipping'];
					$cartItems[$detail['storeid']]['storename'] = $detail['storename'];
					$cartItems[$detail['storeid']]['storelogo'] = ($detail['storelogo']!="") ? $detail['storelogo'] : './node_modules/bootstrap-icons/icons/image-alt.svg';
					$cartItems[$detail['storeid']]['products'][] = array(
						"productId" => $idx, 
						"detail" => $detail, 
						"qty" => $p );

				}
			}

			die(json_encode($cartItems));
		}
	}

	public function getRelatedProductsByCategoryId($id){
		$sql = "
			SELECT t2.name as 'filename',t1.*
			FROM productt t1
			RIGHT JOIN media t2
			ON t1.id = t2.productid
			LEFT JOIN store t3
			ON t3.id = t1.storeid
			LEFT JOIN user t4
			ON t4.id = t3.userid
			WHERE t1.categoryid = $id
			AND t2.active =1
			AND t4.verified = 1
			LIMIT 5
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function updateUserTypeListener(){
		if(isset($_POST['updateUserType'])){
			$_SESSION['setup']['usertype'] = $_POST['usertype'];

			die(json_encode(array("added" => true)));
		}
	}

	public function getAllProductCommentsById($id){
		$sql = "
			SELECT t1.*, t2.photo as 'profilePicture' 
			FROM rating t1
			LEFT JOIN user t2
			ON t2.id = t1.userid
			WHERE t1.productid = $id
			ORDER BY t1.date_added DESC
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function GetAvgCommentByProductId($id){
		$sql = "
			SELECT AVG(rating) as 'average'
			FROM rating
			WHERE productid = $id
			ORDER BY date_added DESC
		";

		return $this->db->query($sql)->fetch();
	}

	public function getReviewCountByProductId($id){
		$sql = "
			SELECT count(*) as 'total'
			FROM rating
			WHERE productid = $id
		";

		$count = $this->db->query($sql)->fetch();

		return $count['total'];
	}

	public function addRatingListener(){
		if(isset($_POST['addRating'])){
			$sql = "
				INSERT INTO rating(productid,userid,rating,comment)
				VALUES(?,?,?,?)
			";

			$this->db->prepare($sql)->execute(array($_POST['id'], $_SESSION['id'], $_POST['rating'], $_POST['comment']));

			$count = $this->getReviewCountByProductId($_POST['id']);
			$profile = $this->getUserProfile();

			die(json_encode(array("count" => $count, "profile" => $profile)));
		}
	}

	public function getLikedIdByStoreId($id, $disliked = false){
		$sql = "
			SELECT userid
			FROM likes 
			WHERE storeid = $id
			AND liked = 1
		";

		if($disliked){
			$sql = "
				SELECT userid
		 		FROM likes 
		 		WHERE storeid = $id
		 		AND dislike = 1
		 	";
		}

		$data = $this->db->query($sql)->fetchAll();
		$ids = array();

		foreach($data as $idx => $d){
			$ids[] = $d['userid'];
		}

		return $ids;
	}

	public function getLikesByStoreId($id, $disliked = false){
		$sql = "
			SELECT userid
			FROM likes 
			WHERE storeid = $id
			AND liked = 1
		";

		if($disliked){
			$sql = "
				SELECT userid
		 		FROM likes 
		 		WHERE storeid = $id
		 		AND dislike = 1
		 	";
		}

		return $this->db->query($sql)->fetchAll();
	}

	public function getProductsByStoreId($id){
		$sql = "
			SELECT t1.*, t2.name as 'filename'
			FROM productt t1
			LEFT JOIN media t2
			ON t1.id = t2.productid
			WHERE t2.active = 1
			AND t1.storeid = $id
			LIMIT 100
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getProductById($id){
		$sql = "
			SELECT t1.*, t2.name as 'storename',t3.name  as 'categoryname', t4.shipping_day
			FROM productt t1 
			LEFT JOIN  store t2
			ON t1.storeid = t2.id
			left join category t3
			on t1.categoryid = t3.id
			left join fees t4
			on t4.storeid = t2.id
			WHERE t1.id = $id
			LIMIT 1
		";
		return $this->db->query($sql)->fetch();
	}

	public function updateCategoryStatus(){
		if(isset($_POST['updateStatus'])){
			$sql = "
				UPDATE category
				SET isactive = ?
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['checked'], $_POST['id']));

			die(json_encode(array("updated")));
		}
	}

	public function deleteCategoryListener(){
		if(isset($_POST['deleteCategory'])){
			$sql = "
				DELETE FROM category
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['id']));

			die(json_encode(array("deleted")));
		}
	}

	public function addCategoryListener(){
		if(isset($_POST['addCategory'])){
			//todo check if exists
			$sql = "
				INSERT INTO category(name)
				VALUES(?)
			";

			$this->db->prepare($sql)->execute(array($_POST['name']));

			$id = $this->db->lastInsertId();

			die(json_encode(array($id)));
		}
	}

	public function addProductListener(){
		if(isset($_POST['addProduct'])){
			$sql = "
				SELECT *
				FROM productt
				WHERE name = '".$_POST['title']."'  AND storeid = '".$_SESSION['storeid']."'
				LIMIT 1
			";

			$exists = $this->db->query($sql)->fetch();
	
			if(!$exists){
				$sql = "
					INSERT INTO productt(name,categoryid,price,brand,quantity,cost,description,storeid)
					VALUES(?,?,?,?,?,?,?,?)
				";

				$this->db->prepare($sql)->execute(array($_POST['title'], $_POST['category'],$_POST['price'],$_POST['brand'],$_POST['quantity'],$_POST['cost'],$_POST['desc'],$_SESSION['storeid']));

				$this->success = "You have sucesfully added this product.";

				$id = $this->db->lastInsertId();
				$this->addMediaByProductId($id, $_POST['src'], $_POST['active']);

			} else {
				$this->errors[] = "You already have this product added before.";
			}

			die(json_encode(array("error" => $this->errors)));
		}

	}

	public function getMediaByProductId($id){
		$sql = "
			SELECT *
			FROM media
			WHERE productid = $id
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function addMediaByProductId($id, $media, $active){
		$merchantPath = 'uploads/merchant/'.$_SESSION['storeid']."/";
		$productPath = 'uploads/merchant/'.$_SESSION['storeid']."/".$id."/";

		if(!file_exists($productPath)){
			mkdir($productPath,0777,true);
		}

		foreach($media as $idx => $m){
			$ext = strtolower(pathinfo($m,PATHINFO_EXTENSION));
			$filename = md5($m).".".$ext;

			if(copy($merchantPath.$m, $productPath.$filename)){
				//add to media
				if($m == $active){
					$sql = "
						INSERT INTO media
						SET name = ?,
						storeid = ?,
						productid = ?,
						active = 1
					";
				} else {
					$sql = "
						INSERT INTO media
						SET name = ?,
						storeid = ?,
						productid = ?
					";

				}
				

				$this->db->prepare($sql)->execute(array($filename,$_SESSION['storeid'], $id));
			}
		}

		return $this;
	}

	public function getProductByName($name){
		$sql = "
			SELECT t1.*, t2.name as 'filename'
			FROM productt t1
			LEFT JOIN media t2
			ON t1.id = t2.productid
			LEFT JOIN store t3
			ON t3.id = t1.storeid
			LEFT JOIN user t4
			ON t4.id = t3.userid
			WHERE t2.active = 1
			AND t1.name LIKE '%$name%'
			AND t4.verified = 1
			LIMIT 100
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getProductByCategoryId($id){
		$sql = "
			SELECT t1.*, t2.name as 'filename'
			FROM productt t1
			LEFT JOIN media t2
			ON t1.id = t2.productid
			LEFT JOIN store t3
			ON t3.id = t1.storeid
			LEFT JOIN user t4
			ON t4.id = t3.userid
			WHERE t2.active = 1
			AND t1.categoryid = $id
			AND t4.verified = 1
			LIMIT 100
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getAllPublicProducts(){
		$sql = "
			SELECT t1.*, t2.name as 'filename'
			FROM productt t1
			LEFT JOIN media t2
			ON t1.id = t2.productid
			LEFT JOIN store t3
			ON t3.id = t1.storeid
			LEFT JOIN user t4
			ON t4.id = t3.userid
			WHERE t2.active = 1
			AND t4.verified = 1
			LIMIT 100
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getAllProducts(){
		$sql = "
			SELECT t1.*, t2.name as 'filename'
			FROM productt t1
			LEFT JOIN media t2
			ON t1.id = t2.productid
			WHERE t1.storeid = ".$_SESSION['storeid']."
			AND t2.active = 1
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function activatePlanListener(){
		if(isset($_POST['activatePlan'])){
			$sql = "
				UPDATE subscription
				SET active = ?
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['toggle'],$_POST['id']));

			die(json_encode(array("Updated")));
		}
	}

	public function deletePlanListener(){
		if(isset($_POST['deletePlan'])){
			$sql = "
				UPDATE subscription
				SET deleted = 1
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['id']));

			die(json_encode(array("Deleted")));
		}
	}

	public function getActiveSubscriptions(){
		$sql = "
			SELECT *
			FROM subscription
			WHERE deleted = 0
			AND active = 1
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getAllSubscription(){
		$sql = "
			SELECT *
			FROM subscription
			WHERE deleted = 0
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function addPlanListener(){
		if(isset($_POST['addPlan'])){
			$sql = "
				INSERT INTO subscription(duration,cost,title,caption)
				VALUES(?,?,?,?)
			";

			$this->db->prepare($sql)->execute(array($_POST['planduration'],$_POST['planfee'],$_POST['title'],$_POST['plancaption'],));

			header("Location:plan.php");
		}
	}

	public function checkAccess(){
		if(!$_SESSION['verified']){
			header("Location:activate.php");
		}
	}

	public function deleteSlideListener(){
		if(isset($_POST['deleteSlide'])){
			$sql = "
				DELETE FROM slides
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['id']));

			die(json_encode(array("Deleted")));
		}
	}

	public function updateSliderStatus(){
		if(isset($_POST['updateSlideStatus'])){
			$sql = "
				UPDATE slides
				SET status = ?
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['status'], $_POST['id']));

			die(json_encode(array("updated")));
		}
	}

	public function getAllSlides($news = false){
		$sql = "
			SELECT *
			FROM slides
			WHERE type = '".(($news) ? "news" : "slider")."'
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getAllActiveSlides(){
		$sql = "
			SELECT *
			FROM slides
			WHERE type = 'slider'
			AND status = 1
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getAllSlidesIdx($news = false, $idx = false){
		$sql = "
			SELECT *
			FROM slides
			WHERE type = '".(($news) ? "news" : "slider")."'
		";

		if($idx){
			$sql = "
				SELECT *
				FROM slides
				WHERE type = '".(($news) ? "news" : "slider")."'
				AND status = 1
		";

		}

		return $this->db->query($sql)->fetchAll();
	}

	public function addSliderListener(){
		if(isset($_POST['addSlider'])){
			$sql = "
				INSERT INTO slides(title,content,photo,type)
				VALUES(?,?,?,?)
			";

			$type = (isset($_POST['addNews'])) ? "news" : "slider";

			$this->db->prepare($sql)->execute(array($_POST['title'],$_POST['subtext'],$_POST['photo'], $type));

			die(json_encode(array("added")));
		}
	}

	public function getAllActiveCategories(){
		$sql = "
			SELECT *
			FROM category
			WHERE isactive = 1
		";

		return $this->db->query($sql)->fetchAll();
	}
	public function getAllCategories(){
		$sql = "
			SELECT *
			FROM category
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getMerchantAsset($type = false){
		$merchantPath = 'uploads/merchant/'.$_SESSION['id']."/";
		$logoPath = 'uploads/logo/'.$_SESSION['id']."/";

		if(!file_exists($logoPath)){
			mkdir($logoPath, 0777, true);
		}

		if(!file_exists($merchantPath)){
			mkdir($merchantPath,0777,true);
		}
		$assets = array();
		$folder_name = $merchantPath;
		$files = scandir($merchantPath);

		if($type == "logo"){
			$folder_name = $logoPath;
			$files = scandir($logoPath);
		}

		if(false !== $files) {
		 foreach($files as $file) {
		  if('.' !=  $file && '..' != $file) {
		  	$assets[] = $folder_name.$file;
		  }
		 }
		}

		return $assets;
	}

	public function getAdminAssets($type = false){
		$assets = array();
		$folder_name = 'uploads/admin/';

		if(!file_exists($folder_name)){
			mkdir($folder_name, 0777,true);
		}

		$files = scandir('uploads/admin/');

		if($type == "logo"){
			$folder_name = 'uploads/logo/';
			$files = scandir('uploads/logo/');
		}

		if(false !== $files) {
		 foreach($files as $file) {
		  if('.' !=  $file && '..' != $file) {
		  	$assets[] = $folder_name.$file;
		  }
		 }
		}

		return $assets;
	}

	public function getLogo(){
		$sql = "
			SELECT logo
			FROM settings
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function addLogoListener(){
		if(isset($_POST['addLogo'])){
			$sql = "
				SELECT *
				FROM settings
				WHERE userid = '".$_SESSION['id']."'
				LIMIT 1
			";
			$exists = $this->db->query($sql)->fetch();

			if($exists){
				//update
				$sql = "
					UPDATE settings
					SET logo = ?
					WHERE userid = ?
				";
			} else {
				//insert
				$sql = "
					INSERT INTO settings(logo,userid)
					VALUES(?,?)
				";
			}

			$this->db->prepare($sql)->execute(array($_POST['photo'], $_SESSION['id']));

			die(json_encode(array("added")));
		}
	}

	public function dropZoneTest(){

		if(isset($_POST['assetupload'])){
			$merchantPath = 'uploads/merchant/'.$_SESSION['storeid']."/";
			$logoPath = 'uploads/logo/'.$_SESSION['storeid']."/";
			
			if(!file_exists($logoPath)){
				mkdir($logoPath, 0777, true);
			}

			if(!file_exists($merchantPath)){
				mkdir($merchantPath,0777,true);
			}

			if(isset($_FILES)){
				$folder_name = $merchantPath;

				if(isset($_POST['logo'])){
					$folder_name = $logoPath;
				}
				if(!empty($_FILES)) {
				 $temp_file = $_FILES['file']['tmp_name'];
				 $ext = strtolower(pathinfo($_FILES["file"]["name"],PATHINFO_EXTENSION));
				 $location = $folder_name . $_FILES['file']['name'];

				 if(move_uploaded_file($temp_file, $location)){
				 	$_SESSION['lastUpload'] = $_FILES['file']['name'];
				 }
				}
			}
		}
	}

	public function verifyUserListener(){
		if(isset($_POST['verifyUser'])){
			$sql = "
				UPDATE user
				SET verified = ?
				WHERE id = ?
			";
			$verified = !$_POST['verify'];
			$this->db->prepare($sql)->execute(array($verified, $_POST['id']));

			die(json_encode(array("updted")));
		}
	}
	
	public function getAllUsers(){
		$sql = "
			SELECT t1.*,t2.email, t2.contact
			FROM user t1
			LEFT JOIN userinfo t2
			ON t1.id = t2.userid
			WHERE t1.usertype = 'basic'
		";	

		return $this->db->query($sql)->fetchAll();
	}

	public function resetPasswordListener(){
		if (isset($_POST['resetpassword'])) {
			$this->checkPassword();
			
			$profile = $this->getUserById($_SESSION['id']);

			if($profile['password'] != md5($_POST['oldpassword'])){
				$this->errors[] = "Incorrect Old Password";
			}

			if(count($this->errors) == 0){
				$sql = "
					UPDATE user
					SET password = ?
					WHERE id = ?
				";

				$this->db->prepare($sql)->execute(array(md5($_POST['password']), $_SESSION['id']));

				$this->success = "You have succesfully updated your password";
			}

			return $this;
		}
	}	

	public function loadLineChartListener(){
		if(isset($_POST['loadLineChart'])){
			$sales = $this->getAllSales();

			$this->loadChart($sales, "date_purchased");
		}
	}

	public function loadMonthlyDataListener(){
		if(isset($_POST['loadMonthlyData'])){
			$records = $this->getAllProductionByYearAndMonth();

			$this->loadPieChart($records);
		}
	}

	public function loadPieChart($records, $key = false){
		$data = array();

		foreach($records as $idx => $r){
			$producedDate = ($key) ? date_create($r[$key]) : date_create($r['date_produced']);
			$m = date_format($producedDate, "M");
			$y = date_format($producedDate, "Y");

			$data[$r['productid']]['name'] = $r['name'];
			@$data[$r['productid']]['total'] += ($key) ? $r['qty'] : $r['quantity'];
		}


		$formatted = array();

		foreach($data as $idx => $d){
			$formatted[] = array($d['name'], $d['total']);
		}
   // series: [{
   //      type: 'pie',
   //      name: 'Quantity',
   //      data: [
   //          ['Cheese Cake', 45.0],
   //          ['Fudgee Bar', 26.8]
   //      ]
   //  }]

		die(json_encode(array_values($formatted)));
	}
	
	public function exportPurchaseReportListener(){
		if(isset($_GET['salesreport'])){
			// output headers so that the file is downloaded rather than displayed
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=Sales_Report.csv');

			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');

			// output the column headings
			fputcsv($output, array('Product', 'Price', 'Quantity', "Shipping Fee", "Tax","Date Purchased", "Date Delivered"));

			$records = $this->db->query($_SESSION['lastQuery'])->fetchAll();

			foreach($records as $idx => $r){
				$data = array($r['product'],$r['price'],$r['quantity'],$r['shipping'],$r['tax'],$r['date_created'],$r['delivery_date'],);
				fputcsv($output, $data);
			}

		}
	}

	public function filterPurchaseListener(){
		if(isset($_POST['filterPurchase'])){
			$records = $this->getPurchaseOrdersByType($_POST['type']);

			die(json_encode($records));
		}
	}

	public function loadChart($records, $key = false){
		$months = array(
			"Jan" => 0,
			"Feb" => 0,
			"Mar" => 0,
			"Apr" => 0,
			"May" => 0,
			"Jun" => 0,
			"Jul" => 0,
			"Aug" => 0,
			"Sep" => 0,
			"Oct" => 0,
			"Nov" => 0,
			"Dec" => 0
		);

		$data = array();

		foreach($records as $idx => $r){
			$producedDate = ($key) ? date_create($r[$key]) : date_create($r['date_produced']);
			$m = date_format($producedDate, "M");
			$y = date_format($producedDate, "Y");

			$data[$r['productid']]['name'] = $r['name'];
			@$data[$r['productid']][$m]['total'] += ($key) ? $r['qty'] : $r['quantity'];
		}

		$formatted = array();

		$counter = 0;

		foreach($data as $idx => $d){
			$formatted[$counter]['name'] = $d['name'];
			$formatted[$counter]['data'] = $months;

			foreach($months as $iidx => $m){
				if(array_key_exists($iidx, $d)){
					$formatted[$counter]['data'][$iidx] = $d[$iidx]['total'];
				}

			}

			$formatted[$counter]['data'] = array_values($formatted[$counter]['data']);

			$counter++;

		}

		die(json_encode($formatted));
	}

	public function getMonthlyProductionReport(){
		if(isset($_POST['loadMonthlyProductChart'])){
			$this->loadChart($this->getAllProduction());
		}
	}

	public function getMonthlySalesReportListener(){
		if(isset($_POST['loadMonthlySalesChart'])){
			$sales = $this->getAllSales();

			$this->loadChart($sales, "date_purchased");
		}
	}

	public function getMonthlyProductionReportByYear(){
		if(isset($_POST['loadMonthlyProductChartByYear'])){
			$this->loadChart($this->getAllProductionByYear($_POST['year']));
		}
	}

	public function updatePurchaseTypeListener(){
		if(isset($_POST['updatePurchaseType'])){
			$sql = "
				UPDATE purchase
				SET type = ?
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['type'],$_POST['id']));

			die(json_encode(array("updated")));
		}
	}

	public function addMaterialInventoryListener(){
		if(isset($_POST['addMaterialInventory'])){
			$exists = $this->checkifMaterialInventoryExists($_SESSION['storeid'], $_POST['name']);

			if($exists){
				$this->errors[] = "This material exists in this store already.";
			} else {
				$this->success = "You have succesfully added this material.";

				$sql = "
					INSERT INTO material_inventory(storeid,name,qty,price,expiry_date)
					VALUES(?,?,?,?,?)
				";

				$this->db->prepare($sql)->execute(array($_SESSION['storeid'],$_POST['name'],$_POST['qty'],$_POST['price'],$_POST['expiry_date']));

				return $this;
			}
		}
	}

	public function addPurchaseListener(){
		if(isset($_POST['addPurchase'])){
			$sql = "
				INSERT INTO purchase(vendorid,materialid,type,date_purchased,qty, storeid)
				VALUES(?,?,?,?,?,?)
			";

			$this->db->prepare($sql)->execute(array($_POST['vendorid'],$_POST['materialid'],$_POST['type'],$_POST['date_purchased'],$_POST['qty'], $_SESSION['storeid']));
			
			$this->updateMaterialInventory($_POST['materialid'], $_POST['qty'], true);

			return $this;
		}
	}

	public function addSaleListener(){
		if(isset($_POST['addSale'])){
			$sql = "
				INSERT INTO sales(storeid,productid,qty,date_purchased)
				VALUES(?,?,?,?)
			";

			$this->db->prepare($sql)->execute(array($_SESSION['storeid'], $_POST['productid'], $_POST['qty'], $_POST['date_purchased']));

			return $this;
		}
	}

	public function deleteProductionListener(){
		if(isset($_POST['deleteProduction'])){
			$sql = "
				DELETE FROM production
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['id']));

			die(json_encode(array("deleted")));
		}
	}

	public function getAllProduction(){
		$sql = "
			SELECT t1.*, t2.name 
			FROM production t1
			LEFT JOIN product t2
			ON t1.productid = t2.id
			WHERE t1.storeid = ".$_SESSION['storeid']."
		";	

		return $this->db->query($sql)->fetchAll();
	}

	public function getAllProductionByYearAndMonth(){
		$sql = "
			SELECT t1.*, t2.name 
			FROM production t1
			LEFT JOIN product t2
			ON t1.productid = t2.id
			WHERE t1.storeid = ".$_SESSION['storeid']."
			AND YEAR(t1.date_produced) = ".$_POST['year']."
			AND MONTH(t1.date_produced) = '".$_POST['month']."'
		";	

		return $this->db->query($sql)->fetchAll();
	}

	public function getAllProductionByYear($year){
		if(isset($_POST['products'])){
			$sql = "
			SELECT t1.*, t2.name 
			FROM production t1
			LEFT JOIN product t2
			ON t1.productid = t2.id
			WHERE t1.storeid = ".$_SESSION['storeid']."
			AND YEAR(t1.date_produced) = ".$year."
			AND t1.productid in(".implode(",", $_POST['products']).")
		";	

		} else {
			$sql = "
				SELECT t1.*, t2.name 
				FROM production t1
				LEFT JOIN product t2
				ON t1.productid = t2.id
				WHERE t1.storeid = ".$_SESSION['storeid']."
				AND YEAR(t1.date_produced) = ".$year."
			";	
		}


		return $this->db->query($sql)->fetchAll();
	}

	public function getAllSales(){
		$sql = "
			SELECT t1.*, t2.name 
			FROM sales t1
			LEFT JOIN product t2
			ON t1.productid = t2.id
			WHERE t1.storeid = ".$_SESSION['storeid']."
			ORDER BY t1.id desc
		";	

		return $this->db->query($sql)->fetchAll();
	}

	public function getPurchaseOrdersByType($type){
		$sql = "
			SELECT t1.*, t2.name as 'vendorname', t3.name as 'materialname'
			FROM purchase t1
			LEFT JOIN vendor t2
			ON t1.vendorid = t2.id
			LEFT JOIN material_inventory t3
			ON t1.materialid = t3.id
			WHERE t1.storeid = ".$_SESSION['storeid']."
			AND t1.type = '".$type."'
		";	

		$_SESSION['lastQuery'] = $sql;

		return $this->db->query($sql)->fetchAll();
	}

	public function getPurchaseOrders(){
		$sql = "
			SELECT t1.*, t2.name as 'vendorname', t3.name as 'materialname'
			FROM purchase t1
			LEFT JOIN vendor t2
			ON t1.vendorid = t2.id
			LEFT JOIN material_inventory t3
			ON t1.materialid = t3.id
			WHERE t1.storeid = ".$_SESSION['storeid']."
		";	
		
		$_SESSION['lastQuery'] = $sql;

		return $this->db->query($sql)->fetchAll();
	}

	public function addProductionListener(){
		if(isset($_POST['addProduction'])){
			$sql = "
				INSERT INTO production(productid,batchnumber,quantity,date_produced,storeid)
				VALUES(?,?,?,?,?)
			";

			$this->db->prepare($sql)->execute(array($_POST['productid'], $_POST['batchnumber'],$_POST['qty'],$_POST['date_produced'],$_SESSION['storeid']));

			return $this;
		}
	}

	public function addVendorListener(){
		if(isset($_POST['addVendor'])){
			$exists = $this->checkifVendorExists($_SESSION['storeid'], $_POST['name']);

			if($exists){
				$this->errors[] = "This vendor was added already to this store.";

			} else {
				$sql = "
					INSERT INTO vendor(name,address,contact,storeid)
					VALUES(?,?,?,?)
				";

				$this->db->prepare($sql)->execute(array($_POST['name'], $_POST['address'], $_POST['contact'], $_SESSION['storeid']));
				$this->success = "You have succesfully added this vendor.";
			}

			return $this;
		}
	}

	public function checkifVendorExists($id, $name){
		$sql = "
			SELECT *
			FROM vendor
			WHERE name = '".$name."'
			AND storeid = ".$id."
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function checkifMaterialInventoryExists($id, $name){
		$sql = "
			SELECT *
			FROM material_inventory
			WHERE name = '".$name."'
			AND storeid = ".$id."
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function searchProductListener(){
		if(isset($_POST['searchProduct'])) {
			$sql = "
				SELECT *
				FROM product
				WHERE name LIKE '%".$_POST['txt']."%'
				AND storeid = '".$_SESSION['storeid']."'
				LIMIT 20
			";

			$data = $this->db->query($sql)->fetchAll();

			die(json_encode($data));
		}
	}

	public function searchMaterialListener(){
		if(isset($_POST['searchMaterial'])) {
			$sql = "
				SELECT t1.*,t2.name as 'filename'
				FROM productt t1
				LEFT JOIN media t2
				ON t1.id = t2.productid
				WHERE t1.name LIKE '%".$_POST['txt']."%'
				AND t1.storeid = '".$_SESSION['storeid']."'
				AND t2.active = 1
				group by t1.id
				LIMIT 20
			";

			$data = $this->db->query($sql)->fetchAll();

			die(json_encode($data));
		}
	}

	public function searchVendorListener(){
		if(isset($_POST['searchVendor'])) {
			$sql = "
				SELECT *
				FROM vendor
				WHERE name LIKE '%".$_POST['txt']."%'
				LIMIT 20
			";

			$data = $this->db->query($sql)->fetchAll();

			die(json_encode($data));
		}
	}

	public function uploadProfileListener(){
		if(isset($_POST['profile'])){
			$target_dir = "uploads/";
			$imageFileType = strtolower(pathinfo($_FILES["profile"]["name"],PATHINFO_EXTENSION));
			$target_file = $target_dir . basename($_SESSION['storeid'].".".$imageFileType);
			$uploadOk = 1;

			opp();

			// // Check if image file is a actual image or fake image
			// if(isset($_POST["submit"])) {
			//   $check = getimagesize($_FILES["profile"]["tmp_name"]);
			//   if($check !== false) {
			//     echo "File is an image - " . $check["mime"] . ".";
			//     $uploadOk = 1;
			//   } else {
			//     echo "File is not an image.";
			//     $uploadOk = 0;
			//   }
			// }

			// // Check if file already exists
			// if (file_exists($target_file)) {
			//   echo "Sorry, file already exists.";
			//   $uploadOk = 0;
			// }

			// // Check file size
			// if ($_FILES["fileToUpload"]["size"] > 500000) {
			//   echo "Sorry, your file is too large.";
			//   $uploadOk = 0;
			// }

			// // Allow certain file formats
			// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			// && $imageFileType != "gif" ) {
			//   echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			//   $uploadOk = 0;
			// }

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			  // echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			  if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
			    // echo "The file ". htmlspecialchars( basename( $_FILES["profile"]["name"])). " has been uploaded.";
			  } else {
			    // echo "Sorry, there was an error uploading your file.";
			  }
			}
		}
	}

	public function getMediaById($id){
		$sql = "
			SELECT t1.*
			FROM media t1
			WHERE t1.productid = $id
			AND t1.active = 1 
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function getCartDetailByTransactionId($id){
		$sql = "
			SELECT *
			FROM cart_details
			WHERE transactionid = $id
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function getCartItemsByTransactionId($id, $storeid){
		$sql = "
			SELECT t1.*, t3.storeid, t3.name as 'productname'
			FROM cart t1
			LEFT JOIN productt t3 
			ON t1.productid = t3.id
			WHERE t1.transactionid = $id
			AND t3.storeid = $storeid
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getCartByTransactionId($id){
		$sql = "
			SELECT t1.*,t2.name as 'filename', t3.storeid, t3.name as 'productname'
			FROM cart t1
			LEFT JOIN media t2
			ON t1.productid = t2.productid
			LEFT JOIN productt t3 
			ON t1.productid = t3.id
			WHERE t1.transactionid = $id
		";

		// opd($sql);
		return $this->db->query($sql)->fetchAll();
	}

	public function getUserTransaction($status){
		$sql = "
			select t1.*
			from cart t1
			left join transaction t2
			on t1.transactionid = t2.id
			where t1.status = '$status'
			and t1.userid = ".$_SESSION['id']."
		";

		$data = $this->db->query($sql)->fetchAll();
		$groupedData = array();

		foreach($data as $idx => $d){
			$groupedData[$d['transactionid']][] = $d;
		}

		return $groupedData;
	}

	public function getTransactionByStatus($status, $count = false){
		if($count) {
			$sql = "
				SELECT count(t1.id) as 'total'
				FROM cart t1
				LEFT JOIN transaction t2
				ON t1.transactionid = t2.id
				LEFT JOIN cart_details t3
				ON t2.id = t3.transactionid
				WHERE t1.status = '$status'
				and t1.userid =".$_SESSION['id']."
			";
			return $this->db->query($sql)->fetch();
		} else {
			$sql = "
				SELECT t1.*
				FROM cart t1
				LEFT JOIN transaction t2
				ON t1.transactionid = t2.id
				LEFT JOIN cart_details t3
				ON t2.id = t3.transactionid
				WHERE t1.status = '$status'
				and t1.userid =".$_SESSION['id']."
			";

			return $this->db->query($sql)->fetchAll();
		}
	}

	public function getUserProfile(){
		$sql = "
			SELECT t1.*,t2.photo as 'profilePicture'
			FROM userinfo t1
			LEFT JOIN user t2
			ON t1.userid = t2.id
			WHERE t1.userid = ".$_SESSION['id']."
			LIMIT 1
		";	
		

		return $this->db->query($sql)->fetch();
	}


	public function getUserById($id){
		$sql = "
			SELECT *
			FROM user
			WHERE id = ".$id."
			LIMIT 1
		";	
		

		return $this->db->query($sql)->fetch();
	}

	public function getStoreOwnerDetailsById($id){
		$sql = "
			SELECT t1.name as 'store', t1.logo,t2.contact, t2.email
			FROM store t1
			left join userinfo t2
			on t2.userid = t1.userid
			WHERE t1.id = ".$id."
			LIMIT 1
		";	
		

		return $this->db->query($sql)->fetch();
	}

	public function getUserInfoByUserid($id){
		$sql = "
			SELECT *
			FROM userinfo
			WHERE userid = ".$id."
			LIMIT 1
		";	
		

		return $this->db->query($sql)->fetch();
	}

	public function updateUserInfoListener(){
		if(isset($_POST['updateUserInfo'])){

			$this->updateUserProfile();
			//check first
			$sql = "
				SELECT *
				FROM userinfo
				WHERE userid = ".(isset($_SESSION['id']) ? $_SESSION['id'] : $_SESSION['lastinsertedid'])."
				LIMIT 1
			";

			$exists = $this->db->query($sql)->fetch();
			if(!$exists){
				//insert
				$sql = "
					INSERT INTO userinfo(fullname,address,contact,email,bday,userid)
					VALUES(?,?,?,?,?,?)
				";
				$this->db->prepare($sql)->execute(array($_POST['fullname'], $_POST['address'], $_POST['contact'], $_POST['email'], $_POST['birthday'], $_SESSION['id']));
			} else {

				$id = (isset($_SESSION['id']) ? $_SESSION['id'] : $_SESSION['lastinsertedid']);

				$sql = "
					UPDATE userinfo
					SET fullname = ?, address = ?, contact = ?, email = ?, bday = ?
					where userid = $id
				";

				$this->db->prepare($sql)->execute(array($_POST['fullname'], $_POST['address'], $_POST['contact'], $_POST['email'], $_POST['birthday']));

			}

			$this->success = "You have successfully updated your personal information.";

			return $this;
		}
	}

	public function updateUserProfile(){
		if(!isset($_FILES['merchantProfilePicture'])){
			return $this;
		}

		$files = $_FILES['merchantProfilePicture']['tmp_name'];

		if($files){

			//start
			$merchantPath = 'uploads/user/'.$_SESSION['storeid']."/profile/";
			
		
			if(!file_exists($merchantPath)){
				mkdir($merchantPath,0777,true);
			}

			$folder_name = $merchantPath;

			 $temp_file = $_FILES['merchantProfilePicture']['tmp_name'];
			 $ext = strtolower(pathinfo($_FILES["merchantProfilePicture"]["name"],PATHINFO_EXTENSION));
			 $newName = md5($_FILES['merchantProfilePicture']['name']) .".".$ext;
			 $location = $folder_name . $newName;

			 if(move_uploaded_file($temp_file, $location)){
			 	$sql = "
					UPDATE user
					SET photo = ?
					WHERE id = ?
				";


				$this->db->prepare($sql)->execute(array($location, $_SESSION['id']));
			}
		} 

		return $this;
	}


	public function deleteMaterialListener(){
		if(isset($_POST['deleteMaterial'])){
			$sql = "
				DELETE FROM material
				WHERE materialid = ".$_POST['id']."
			";

			$this->db->prepare($sql)->execute(array());

			$this->updateMaterialInventory($_POST['id'], $_POST['qty'], true);

			die(json_encode(array("deleted")));
		}
	}

	public function deletePurchaseListener(){
		if(isset($_POST['deletePurchase'])){
			$sql = "
				DELETE FROM purchase
				WHERE id = ".$_POST['id']."
			";

			$this->db->prepare($sql)->execute(array());
			
			$this->updateMaterialInventory($_POST['materialid'], $_POST['qty']);

			die(json_encode(array("deleted")));
		}
	}

	public function getMaterialsListener(){
		if(isset($_POST['getMaterials'])){
			$records = $this->getMaterialById($_POST['id']);

			die(json_encode($records));
		}
	}

	public function getMaterialById($id){
		$sql = "
			SELECT t1.*, t2.name, t2.price
			FROM material t1
			LEFT JOIN material_inventory t2
			ON t1.materialid = t2.id
			WHERE t1.productid = ".$id."
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function addMaterialListener(){
		if(isset($_POST['addMaterial'])){
			$data = array();

			if($this->findMaterialByMateralIdAndProductId($_POST['materialId'], $_POST['id'])){

				$data['added'] = false;
			} else {
				$sql = "
					INSERT INTO material(materialId,qty,productid)
					VALUES(?,?,?)
				";	

				$this->db->prepare($sql)->execute(array($_POST['materialId'],  $_POST['qty'], $_POST['id']));

				$data['added'] = true;
				$data['id'] = $this->db->lastInsertId();

				$this->updateMaterialInventory($_POST['materialId'], $_POST['qty']);
			}

			die(json_encode($data));
		}
	}

	public function updateMaterialInventory($id,$qty, $add = false){
		if($add){
			//delete material of product
			//purchase order
			$sql = "
				UPDATE material_inventory
				SET qty = qty + ?
				WHERE storeid = ?
				AND id = ?
			";
		} else {
			// add material to product
			$sql = "
				UPDATE material_inventory
				SET qty = qty - ?
				WHERE storeid = ?
				AND id = ?
			";
		}

		$this->db->prepare($sql)->execute(array($qty, $_SESSION['storeid'], $id));

		return $this;
	}

	public function findMaterialByMateralIdAndProductId($mid, $id){
		$sql = "
			SELECT *
			FROM material
			WHERE materialid = ".$mid."
			AND productid = ".$id."
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
	}
	
	public function editvendorListener(){
		if(isset($_POST['editvendor'])){
			$sql = "
				UPDATE vendor
				SET name = ?, contact = ?, address = ?
				WHERE id = ?
			";
			$this->db->prepare($sql)->execute(array($_POST['name'], $_POST['contact'], $_POST['address'], $_POST['editvendor']));

			die(json_encode($_POST));
		}
	}

	public function editproductListener(){
		if(isset($_POST['editproduct'])){
			$sql = "
				UPDATE product
				SET name = ?, srp = ?, qty = ?, expiry_date = ?
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['name'], $_POST['price'], $_POST['qty'], $_POST['expiry'], $_POST['editproduct']));

			die(json_encode($_POST));
		}
	}

	public function editMaterialListener(){
		if(isset($_POST['editmaterial'])){
			$sql = "
				UPDATE productt
				SET name = ?, price = ?, cost = ?, quantity = ?, brand = ?, description = ?
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['name'], $_POST['price'], $_POST['cost'], $_POST['quantity'], $_POST['brand'], $_POST['description'], $_POST['editmaterial']));

			die(json_encode($_POST));
		}
	}

	public function deleteProductListener(){
		if(isset($_POST['deleteProduct'])){
			$sql = "
				DELETE from product
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['id']));

			die(json_encode(array("added")));
		}
	}


	public function deleteMaterialInventoryListener(){
		if(isset($_POST['deleteMaterialInventory'])){
			$sql = "
				DELETE from productt
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['id']));

			die(json_encode(array("added")));
		}
	}

	public function deleteMaterialsById($id){
		$sql = "
			DELETE FROM material
			WHERE materialid = ?
		";
		
		$this->db->prepare($sql)->execute(array($id));

		return $this;
	}

	public function deleteSaleListener(){
		if(isset($_POST['deleteSale'])){
			$sql = "
				DELETE from sales
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['id']));

			die(json_encode(array("added")));
		}
	}

	public function deleteVendorListener(){
		if(isset($_POST['deleteVendor'])){
			$sql = "
				DELETE from vendor
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['id']));

			die(json_encode(array("added")));
		}
	}

	public function getAllMaterialInventory(){
		$sql = "
			SELECT *
			FROM material_inventory 
			WHERE storeid = '".$_SESSION['storeid']."'
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getAllMaterials(){
		$sql = "
			SELECT t1.*
			FROM material t1
			LEFT JOIN product t2 
			ON t1.productid = t2.id
			WHERE t2.storeid = '".$_SESSION['storeid']."'
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getAllVendors(){
		$sql = "
			SELECT *
			FROM vendor
			WHERE storeid = '".$_SESSION['storeid']."'
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getProductCount(){
		$sql = "
			SELECT count(id) as total
			FROM product
			WHERE storeid = '".$_SESSION['storeid']."'
		";

		$record =  $this->db->query($sql)->fetch();

		if($record){
			return $record['total'];
		} else {
			return 0;
		}
	}

	public function getVendorCount(){
		$sql = "
			SELECT count(id) as total
			FROM vendor
			WHERE storeid = '".$_SESSION['storeid']."'
		";

		$record =  $this->db->query($sql)->fetch();

		if($record){
			return $record['total'];
		} else {
			return 0;
		}
	}

	public function getMaterialCount(){
		$sql = "
			SELECT count(id) as total
			FROM material_inventory
			WHERE storeid = '".$_SESSION['storeid']."'
		";

		$record =  $this->db->query($sql)->fetch();

		if($record){
			return $record['total'];
		} else {
			return 0;
		}
	}

	public function getPendingOrdersByStatus($status, $count = false){
		if($count){
			$sql = "
				select count(t1.id) as 'total'
				from cart t1
				left join transaction t2
				on t1.transactionid = t2.id
				where t1.status = '$status'
				and t1.storeid = ".$_SESSION['storeid']."
			";

			return $this->db->query($sql)->fetch();
		}

		$sql = "
			select t1.*
			from cart t1
			left join transaction t2
			on t1.transactionid = t2.id
			where t1.status = '$status'
			and t1.storeid = ".$_SESSION['storeid']."
		";

		$data = $this->db->query($sql)->fetchAll();

		$groupedData = array();

		foreach($data as $idx => $d){
			$groupedData[$d['transactionid']][] = $d;
		}

		return $groupedData;
	}

	//for easy deletion of records
	public function reset(){
		$sql = array();
		$sql[] = "delete from store";
		$sql[] = "delete from user where usertype !='admin'";
		$sql[] = "delete from productt";
		$sql[] = "delete from material";
		$sql[] = "delete from userinfo where userid !=36";
		$sql[] = "delete from cart";
		$sql[] = "delete from cart_details";
		$sql[] = "delete from payments";
		$sql[] = "delete from transaction";

		foreach ($sql as $key => $s) {
			$this->db->query($s);
		}

	}

	public function preventReaccessIfPayed(){
		$current = date('Y-m-d');
		$planEnd = $this->getSubscriptionExpiration();

		//redirect if d paexpire
		if(strtotime($current) < strtotime($planEnd)){
			header("Location:dashboard.php");

		} 
	}

	public function getSubscriptionExpiration(){
		$sql = "
			SELECT t1.duration, t3.captured_at
			FROM subscription t1
			LEFT JOIN store t2
			ON t1.id = t2.subscriptionid
			LEFT JOIN payments t3
			ON t3.payment_id = t2.last_payment_id
			WHERE t2.userid = ".$_SESSION['id']."
			LIMIT 1
		";

		$data = $this->db->query($sql)->fetch();

		if(!$data){
			return false;
		} 
		if($data['captured_at'] == ""){
			return false;
		} 

		return $effectiveDate = date('Y-m-d', strtotime("+".$data['duration']." months", strtotime($data['captured_at'])));
	}

	public function getStoreById($id){
		$sql = "
			SELECT *
			FROM store
			WHERE id = $id
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function checkIfPayed(){
		$sql = "
			SELECT *
			FROM payments
			WHERE userid = ".$_SESSION['id']."
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function showSuccessMessage(){
		return $this->success;
	}
	
	public function getUserStore(){
		$sql = "
			SELECT t1.*,t2.duration, t2.cost
			FROM store t1
			LEFT JOIN subscription t2
			ON t1.subscriptionid = t2.id
			WHERE t1.userid = ". $_SESSION['id']."
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function getAllUnverifiedStores(){
		$sql = "
			SELECT t1.*
			FROM store t1
			LEFT JOIN user t2
			ON t1.userid = t2.id 
			WHERE  t2.verified = 0
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function addSubscriptionListener(){
		if(isset($_POST['plan'])){
			$this->addUser();

			if($_SESSION['setup']['usertype'] != "client"){
				$this->addStore();
			}

			$_POST['updateUserInfo'] = true;

			$this->updateUserInfoListener();
		
			//wait for admin to verify this store
			$data = array(
				"added" => true,
				"done" => true
			);

			die(json_encode($data));
		}
	}

	public function addStoreListener(){
		if(isset($_POST['addstore'])){
			$sql = "
				SELECT *
				FROM store
				WHERE name = '".$_POST['name']."'
			";

			$exists = $this->db->query($sql)->fetch();

			if($exists){
				$this->errors[] = "Store name already exists.";

				$data = array(
					"errors" => $this->errors,
					"added" => false
				);

			} else {
				$_SESSION['setup']['store'] = $_POST['name'];

				$data = array("added" => true);
			}
			
			die(json_encode($data));
		}
	}

	public function addStore(){
		$sql = "
			INSERT INTO store(name,userid,subscriptionid)
			VALUES(?,?,?)
		";

		$this->db->prepare($sql)->execute(array($_SESSION['setup']['store'], $_SESSION['lastinsertedid'], $_SESSION['setup']['subscriptionId']));

		$_SESSION['laststoreid'] = $this->db->lastInsertId();

		return $this;
	}

	public function loginListener(){
		if(isset($_POST['login'])){
			$sql = "
				SELECT t1.*, t2.id as 'storeId'
				FROM user t1
				LEFT JOIN store t2
				ON t1.id = t2.userid
				WHERE username = '".$_POST['username']."'
				AND password = '".md5($_POST['password'])."'

				LIMIT 1
			";

			$exists = $this->db->query($sql)->fetch();

			if(! $exists){
				$this->errors[] = "Invalid Account";
			} else {
				//redirect to dashboard
				$_SESSION['id'] = $exists['id'];
				$_SESSION['username'] = $exists['username'];
				$_SESSION['storeid'] = $exists['storeId'];
				$_SESSION['usertype'] = $exists['usertype'];
				$_SESSION['verified'] = $exists['verified'];

				if($exists['usertype'] == "admin"){
					header("Location:admindashboard.php");
				} else if($exists['usertype'] == "client") {
					header("Location:userdashboard.php");
				} else {
					header("Location:dashboard.php");
				}
			}
			

			return $this;
		}
	}

	public function signUpListener(){
		if(isset($_POST['signup'])){
			//authentication
			$this->checkPassword();
			$this->checkUsernameIfExists();

			if(!count($this->errors)){
				$_SESSION['setup']['username'] = $_POST['username'];
				$_SESSION['setup']['password'] = $_POST['password'];
				// $this->addUser();

				$data = array("added" => true);
			} else {
				$data = array(
					"errors" => $this->errors,
					"added" => false
				);
			}
			
			die(json_encode($data));
		}
	}

	public function addUserInfoById($id){
		$sql = "
			INSERT INTO userinfo(userid)
			VALUES(?)
		";

		$this->db->prepare($sql)->execute(array($id));

		return $this;
	}

	public function addUser(){
		if($_SESSION['setup']['usertype'] == "client"){
			$sql = "
				INSERT INTO user(username,password,usertype)
				VALUES(?,?,?)
			";
			$this->db->prepare($sql)->execute(array($_SESSION['setup']['username'], md5($_SESSION['setup']['password']), "client"));
		} else {
			$sql = "
				INSERT INTO user(username,password)
				VALUES(?,?)
			";
			$this->db->prepare($sql)->execute(array($_SESSION['setup']['username'], md5($_SESSION['setup']['password'])));			
		}

		
		$_SESSION['lastinsertedid'] = $this->db->lastInsertId();

		$this->addUserInfoById($this->db->lastInsertId());

		return $this;
	}	

	public function checkUsernameIfExists(){
		$sql = "
			SELECT *
			FROM user
			WHERE username = '".$_POST['username']."'
			LIMIT 1
		";
		$exists = $this->db->query($sql)->fetch();

		if($exists){
			$this->errors[] = "Username already exists";
		} 

		return $this;
	}

	public function checkPassword(){
		if(strlen($_POST['password']) <6){
			$this->errors[] = "Password is too short.";
		}

		if($_POST['password'] != $_POST['password1']){
			$this->errors[] = "Passwords doesn't matched";
		}

		return $this;
	}

	public function getErrors(){
		return $this->errors;
	}

}