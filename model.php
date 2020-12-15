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
						SELECT t1.*,t2.name as 'filename'
						FROM productt t1
						LEFT JOIN media t2
						ON t1.id = t2.productid
						WHERE t1.id = $idx
						AND t2.active = 1
						LIMIT 1
					";
					$detail = $this->db->query($sql)->fetch();

					$cartItems[] = array(
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
			WHERE t1.categoryid = $id
			AND t2.active =1
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
			SELECT * 
			FROM rating
			WHERE productid = $id
			ORDER BY date_added DESC
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
			die(json_encode(array($count)));
		}
	}

	public function getProductById($id){
		$sql = "
			SELECT t1.*, t2.name as 'storename'
			FROM productt t1 
			LEFT JOIN  store t2
			ON t1.storeid = t2.id
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
			WHERE t2.active = 1
			AND t1.name LIKE '%$name%'
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
			WHERE t2.active = 1
			AND t1.categoryid = $id
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
			WHERE t2.active = 1
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
		if(isset($_GET['purchase'])){
			// output headers so that the file is downloaded rather than displayed
			header('Content-Type: text/csv; charset=utf-8');
			header('Content-Disposition: attachment; filename=Purchase_Report.csv');

			// create a file pointer connected to the output stream
			$output = fopen('php://output', 'w');

			// output the column headings
			fputcsv($output, array('Purchase Type', 'Material', 'Vendor', "Date Purchased", "Quantity"));

			$records = $this->db->query($_SESSION['lastQuery'])->fetchAll();
			
			foreach($records as $idx => $r){
				$data = array($r['type'],$r['materialname'],$r['vendorname'],$r['date_purchased'],$r['qty'],);
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
				SELECT *
				FROM productt
				WHERE name LIKE '%".$_POST['txt']."%'
				AND storeid = '".$_SESSION['storeid']."'
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

	public function getUserProfile(){
		$sql = "
			SELECT *
			FROM userinfo
			WHERE userid = ".$_SESSION['id']."
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

	public function updateUserInfoListener(){
		if(isset($_POST['updateUserInfo'])){
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
				$sql = "
					UPDATE userinfo
					SET fullname = ?, address = ?, contact = ?, email = ?, bday = ?
				";

				$this->db->prepare($sql)->execute(array($_POST['fullname'], $_POST['address'], $_POST['contact'], $_POST['email'], $_POST['birthday']));
			}

			$this->success = "You have sucesfully updated your personal information.";

			return $this;
		}
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

	//for easy deletion of records
	public function reset(){
		$sql = array();
		$sql[] = "delete from store";
		$sql[] = "delete from user";
		$sql[] = "delete from product";
		$sql[] = "delete from material";
		$sql[] = "delete from userinfo";

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

		return $effectiveDate = date('Y-m-d', strtotime("+".$data['duration']." months", strtotime($data['captured_at'])));
	}

	public function checkIfPayed(){
		$sql = "
			SELECT *
			FROM payments
			WHERE userid = ".$_SESSION['id']."
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
			$exists = $this->db->query($sql)->fetch();
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
			INSERT INTO store(name,userid)
			VALUES(?,?)
		";

		$this->db->prepare($sql)->execute(array($_SESSION['setup']['store'], $_SESSION['lastinsertedid']));

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