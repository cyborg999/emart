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
		// $this->getAllUnverifiedStores();
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
		$this->addCategory2Listener();
		$this->addCategory3Listener();
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
		$this->returnItemListener();
		$this->updateProofStatusListener();
		$this->addMunicipalFeeListener();
		$this->deleteDeliveryFeeListener();
		$this->updateSeenListener();
		$this->addBatchListener();
		$this->searchAllProductListener();
		$this->updateStockListener();
		$this->updateTermsListener();
		$this->removeSocialListener();
		$this->addSocialListener();
		$this->updateBusinessListener();
		$this->codSubscriptionListener();
		$this->loadDateRangeListener();
		$this->loadAnnualByMunicipalityListener();
		$this->generateVariantsListener();
		$this->updateVerifyListener();
		$this->viewUserListener();
		$this->addWishlistListener();
		$this->deleteWishlistListener();
		$this->getLevel2CategoryListener();
		$this->getLevel3CategoryListener();
	}

	public function deleteWishlistListener(){
		if(isset($_POST['deleteWishlist'])){
			$sql = "
				delete
				from wishlist
				where userid = ?
				and productid = ?";

			$this->db->prepare($sql)->execute(array($_SESSION['id'], $_POST['id']));
			
			die(json_encode(array("wishlist" => $this->getUserWishlist())));
		}
	}

	public function addWishlistListener(){
		if(isset($_POST['addWishlist'])){
			$exists = $this->isProductInUserWishlist($_POST['id']);

			if($exists){
				$sql = "
					delete
					from wishlist
					where userid = ?
					and productid = ?";

			} else {
				$sql = "
					insert into wishlist(userid, productid)
					values(?,?)
				";
			}

			$this->db->prepare($sql)->execute(array($_SESSION['id'], $_POST['id']));

			die(json_encode(array("wishlist" => $this->getUserWishlist())));
		}
	}

	public function isProductInUserWishlist($productId){
		$sql = "
			select *
			from wishlist
			where userid = ".$_SESSION['id']."
			and productid = $productId
			limit 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function getWishlistProducts(){
		$sql = "
			SELECT t2.name as 'filename',t1.*
			from wishlist t0
			left join productt t1
			on t1.id = t0.productid
			RIGHT JOIN media t2
			ON t1.id = t2.productid
			WHERE  t1.deleted = 0
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getUserWishlist($count = false){
		
		if($count){
			$sql = "
				select count(id) as 'total'
				from wishlist
				where userid = ".$_SESSION['id']."
			"; 
		return $this->db->query($sql)->fetch();
		} else {
			$sql = "
				select *
				from wishlist
				where userid = ".$_SESSION['id']."
			"; 
		}

		return $this->db->query($sql)->fetchAll();
	}

	public function viewUserListener(){
		if(isset($_POST['viewUser'])){
			$sql = "
				select t1.*,t3.name as 'store', t3.b_email as 'storeemail', t3.b_contact as 'storecontact'
				from userinfo t1
				left join user t2
				on t1.userid = t2.id
				left join store t3
				on t1.userid = t3.userid
				where t1.userid = ".$_POST['id']."
				limit 1
			";

			$record = $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);

			die(json_encode($record));
		}
	}

	public function updateVerifyListener(){
		if(isset($_POST['updateVerify'])){
			if(md5($_POST['password']) == $_SESSION['password'])  {
				die(json_encode(array(true)));
			} else {
				die(json_encode(array(false)));
			}
		}
	}

	public function generateVariantsListener(){
		if(isset($_POST['generateVariants'])){
			$data = $_POST['variants'];
			$filteredData = array();
			$groupedData = array("single" => array(), "multiple" => array());

			foreach($data as $idx => $d){
				$filteredData[$d[0]][] = $d[1];
			}

			foreach($filteredData as $idx2 => $f){
				if(count($f) > 1){
					$groupedData["multiple"][$idx2] = $f;
				} else {
					$groupedData["single"][$idx2] = $f;
				}

			}

			$final = array();

			foreach($groupedData['multiple'] as $idx => $g){
				foreach($g as $idx2 => $gg){
					foreach($groupedData['multiple'] as $idx3 => $ggg){
						foreach($ggg as $idx5 => $last){
							if($gg != $last){
								if($idx3 != $idx){
									$final[] = $gg."-".$last;
								} else {
									if(!in_array($last, $final)){
										$final[] = $last;
									}
								}
							}
							
						}
					}
				}
			}

			die(json_encode($final));
		}
	}

	public function updateBusinessListener(){
		if(isset($_POST['updateBusiness'])){
			$sql = "
				update store 
				set description = ?, b_address = ?, dti = ? , 
					b_email = ?, b_contact = ?
				where id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['description'], $_POST['b_address'], $_POST['dti'], $_POST['b_email'], $_POST['b_contact'], $_SESSION['storeid']));

			$this->success = "You have successfully updated this record";

			return $this;
		}
	}

	public function addStoreListener(){
		if(isset($_POST['addstore'])){
			$data = array();
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
				$_SESSION['setup']['b_address'] = $_POST['adddress'];
				$_SESSION['setup']['dti'] = $_POST['dti'];
				$_SESSION['setup']['b_email'] = $_POST['email'];
				$_SESSION['setup']['b_contact'] = $_POST['contact'];
				$_SESSION['setup']['position'] = $_POST['position'];

				$data = array("added" => true);
			}
			die(json_encode($data));
		}
	}

	public function removeSocialListener(){
		if(isset($_POST['removeSocial'])){
    		$sql = "
    			delete from social
    			where id = ?
    		";

    		$this->db->prepare($sql)->execute(array($_POST['id']));

    		die(json_encode("deleted"));

		}
	}

	public function getAllSocialMedia(){
		$sql = "
			select *
			from social
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getAllSocial(){
		$sql = "
			select *
			from social
			where userid = ".$_SESSION['id']."
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function addSocialListener(){
		if(isset($_POST['addSocial'])){
    		$sql = "
    			insert into social(social,link,userid)
    			values(?,?,?)
    		";
    		$this->db->prepare($sql)->execute(array($_POST['name'], $_POST['link'], $_SESSION['id']));

    		die(json_encode(array("id" => $this->db->lastInsertId())));
		}
	}

	public function updateTermsListener(){
		if(isset($_POST['updateTerms'])){
			if($_POST['updateTerms'] == "terms"){
				$sql = "
					update settings
					set terms = ?
					where userid = ? 
				";
				
				$this->db->prepare($sql)->execute(array($_POST['terms'], $_SESSION['id']));
			} elseif(isset($_POST['about'])) {
				$sql = "
					update settings
					set about = ?
					where userid = ? 
				";
				$this->db->prepare($sql)->execute(array($_POST['about'], $_SESSION['id']));
			} elseif(isset($_POST['overview'])) {
				$sql = "
					update settings
					set overview = ?
					where userid = ? 
				";
				$this->db->prepare($sql)->execute(array($_POST['overview'], $_SESSION['id']));
			} elseif(isset($_POST['contact'])) {
				$sql = "
					update settings
					set contact = ?
					where userid = ? 
				";
				$this->db->prepare($sql)->execute(array($_POST['contact'], $_SESSION['id']));
			} else {
				$sql = "
					update settings
					set privacy = ?
					where userid = ? 
				";
				$this->db->prepare($sql)->execute(array($_POST['privacy'], $_SESSION['id']));
			}

			$this->success = "You have succesfully update this record";

			return $this;
		}
	}
	
	public function getStoreStockLimit(){
		$sql = "
			SELECT t1.material_low
			FROM store t1
			WHERE t1.userid = ". $_SESSION['id']."
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function updateStockListener(){
		if(isset($_POST['updateStock'])){
			$sql = "
				update store
				set material_low = ?
				where userid = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['val'], $_SESSION['id']));

			die(json_encode(array("added")));
		}
	}

	public function addBatchListener(){
		if(isset($_POST['addBatch'])){
			$sql = "
				insert into production(productid,batchnumber,remaining_qty,expiry_date,qty,price,cost)
				values(?,?,?,?,?,?,?)
			";

			$this->db->prepare($sql)->execute(array($_POST['products'], $_POST['batch'],$_POST['qty'],$_POST['expiration'],$_POST['qty'],$_POST['retail'],$_POST['cost']));

			$id = $this->db->lastInsertId();

			$this->updateProductInventoryById($_POST['products'], $_POST['qty']);

			die(json_encode(array($id)));
		}
	}

	public function updateProductInventoryById($productId, $qty, $deduct = false){
		$sql = "
			update productt
			set quantity = quantity + ? , remaining_qty = remaining_qty + ?
			where id = ?
		";

		if($deduct){
			$sql = "
				update productt
				set quantity = quantity - ? , remaining_qty = remaining_qty - ?
				where id = ?
			";
		}

		$this->db->prepare($sql)->execute(array($qty, $qty, $productId));

		return $this;
	}

	public function updateSeenListener(){
		if(isset($_POST['updateSeen'])){
			$sql = "
				update notification
				set seen = 1
				where id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['id']));

			die(json_encode(array("updated")));
		}
	}

	public function getUnreadNotifications(){
		$sql = "
			select *
			from notification
			where storeid = ".$_SESSION['storeid']."
			and seen = 0
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getNotificationsByType($type, $showAll = false){
		$sql = "
			select *
			from notification
			where storeid = ".$_SESSION['storeid']."
			and type = '$type'
			and seen = 0
			order by date_added desc
		";

		if($showAll){
			$sql = "
				select *
				from notification
				where storeid = ".$_SESSION['storeid']."
				and type = '$type'
				order by date_added desc
			";

		}

		return $this->db->query($sql)->fetchAll();
	}

	public function addNotification($title, $body, $type, $userid = false){
		if($userid){
			$sql = "
				insert into notification(title,body,storeid, type, userid)
				values(?,?,?, ?,?)
			";

			$this->db->prepare($sql)->execute(array($title, $body, $_SESSION['storeid'], $type, $userid));
		} else {
			$sql = "
				insert into notification(title,body,storeid, type)
				values(?,?,?, ?)
			";

			$this->db->prepare($sql)->execute(array($title, $body, $_SESSION['storeid'], $type));
		}
		


		return $this;
	}

	public function addNotificationFromUser($title, $body, $storeId, $type){
		$sql = "
			insert into notification(title,body,storeid, type)
			values(?,?,?, ?)
		";

		$this->db->prepare($sql)->execute(array($title, $body, $storeId, $type));


		return $this;
	}
	public function getExpiredProducts(){
		$sql = "
			SELECT t1.*,t2.name, if((date(CURRENT_DATE) >= date(t1.expiry_date)), 'expired' , '') as 'isExpired'
			FROM production t1
			left join productt t2
			on t1.productid = t2.id
			WHERE t2.storeid = '".$_SESSION['storeid']."'
			AND t1.expiry_date <= date(CURRENT_DATE())
		";

		$_SESSION['lastQuery'] = $sql;

		return $this->db->query($sql)->fetchAll();
	}

	public function deductExpiredProduct($products){
		$data = array();

		foreach($products as $idx => $p){
			if($p['deducted'] == 0){
				//update deducted
				$sql = "
					update production
					set deducted = ?
					where id = ?
				";

				$this->db->prepare($sql)->execute(array(1, $p['id']));

				//deduct expired qty to inventory
				$this->updateProductInventoryById($p['productid'], $p['remaining_qty'],true);
			}
		}

		return $this;
	}

	public function cashSubscriptionNotification($date){
		$title = "Subscription Payment: Cash";
		$body = "<p>".$_SESSION['storename']." requested a meetup on $date for the payment of subscription.</p>";

		$this->addNotification($title, $body, "cashSubscription");

		return $this;
	}

	public function checkSubscriptionDueDate(&$notifications){
		$expiration = $this->getSubscriptionExpiration();

		$date1 = date_create(date("Y-m-d"));
		$date2 = date_create($expiration);
		$diff = date_diff($date2,$date1);
	
		if( ($diff->days <= 10) && ($diff->days >0)) {
			$title = '<div>';

			$title .= "Subscription Alert: Expiration.";

			$title .=  '
			  	</div>';

			$body = "<p>Your subscription will expire in ".$diff->days." days (".$expiration.")</p>";
			
			$this->addNotification($title, $body, "Order");

		  	$notifications[] = $title;
		}

		if($diff->days < 0){
			$title = '<div>';

			$title .= "Subscription Alert: Expired";

			$title .=  '
			  	</div>';

			$body = "<p>Your subscription expired last ".$diff->days." days ago (".$expiration.")</p>";
			
			$this->addNotification($title, $body, "Order");

		  	$notifications[] = $title;
		}

		return $this;
	}

	public function getExpiredProductNotification(&$notifications){
		$lowStockProducts = array();
      	$products = $this->getExpiredProducts();

      	$title = '
                  <div>';
       //auto deduct expired products
        $this->deductExpiredProduct($products);

		if(count($products)){
			$title .= "Expired Product: <b>".count($products) ." Product(s)</b> are expired.";
		}

		$title .=  '
              	</div>';

		$body = "<b>The following products are expired:</b> <ul>";

        foreach($products as $idx => $p){
        	$body .= "<li>".$p['name']."(".$p['expiry_date'].")</li>";
        }

        $body .= "</ul>";

		if(count($products)){
			$notifications[] = $title;

			$this->addNotification($title, $body, "Order");
        }

		return $this;
	}

	public function getLowStockProductNotification(&$notifications){
		$lowStockProducts = array();
		$products = $this->getStoreProduction(true);
		$title = '
                  <div>';


		if(count($products)){
			$title .= "Low Stock Alert: <b>".count($products) ." Product(s)</b> are currently low in stock.";
		}

		$title .=  '<!-- <div class="small text-gray-500">December 2, 2019</div> -->
              	</div>';

        $body = "<b>The following products are low in stock:</b> <ul>";

        foreach($products as $idx => $p){
        	$body .= "<li>".$p['name']."(".$p['quantity'].")</li>";
        }

        $body .= "</ul>";

		if(count($products)){
			$notifications[] = $title;

			$this->addNotification($title, $body, "Order");
        }

		return $this;
	}

	public function getStoreProduction($lowStock = false){
		$sql = "
			SELECT *
			FROM productt
			WHERE storeid = '".$_SESSION['storeid']."'
		";

		if($lowStock){
			$limit = $this->getStoreStockLimit();
			$productLow = $limit['material_low'];

			$sql = "
				SELECT *
				FROM productt
				WHERE storeid = '".$_SESSION['storeid']."'
				AND quantity <= $productLow
			";
		}

		$_SESSION['lastQuery'] = $sql;

		return $this->db->query($sql)->fetchAll();
	}

	public function getStoreNotifications(){
		//sa login, sa procure or sell
		$notifications = array();

		//new order
		//returned

		$this->checkSubscriptionDueDate($notifications);
		$this->getLowStockProductNotification($notifications);
		$this->getExpiredProductNotification($notifications);
		$this->getPendingNotification($notifications);

		return $this;
	}

	public function getUserNotification($showAll = false){
		$sql = "
			select *
			from notification
			where userid = ".$_SESSION['id']."
			and seen = 0
		";

		if($showAll){
			$sql = "
				select *
				from notification
				where userid = ".$_SESSION['id']."
			";
		}

		return $this->db->query($sql)->fetchAll();
	}

	public function getAdminNotification($showAll = false){
		$sql = "
			select *
			from notification
			where type in ('cardSubscription', 'cashSubscription')
			and seen = 0
		";

		if($showAll){
			$sql = "
				select *
				from notification
			 	where type in ('cardSubscription', 'cashSubscription')
			";
		}

		return $this->db->query($sql)->fetchAll();
	}

	public function checkNotificationByDate(){
		$sql = "
			select *
			from notification
			where storeid = ".$_SESSION['storeid']."
			and date(date_added) = date(current_date)
			and type = 'Order'
			limit 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function getPendingNotification(&$notifications){
		$pending = $this->getStoreOrderByStatus("pending");
		$updatedToday = $this->checkNotificationByDate();

		// if(!$updatedToday){
			if($pending){
				$body = "<p>You have (".count($pending).") new order(s).</p>
				<p>Click <a href='neworder.php'>here</a> to process them.</p>";

				$title = "New Orders";

				$this->addNotification($title, $body, "Order");
			}

			$returned = $this->getStoreOrderByStatus("returned");
			
			if($returned){
				$body = "<p>You have (".count($returned).") returned order(s).</p>
				<p>Click <a href='returnedorder.php'>here</a> to process them.</p>";

				$title = "Returned Orders";

				$this->addNotification($title, $body, "Order");
			}
		// }

		return $this;
	}

	public function getStoreOrderByStatus($status){
		$sql = "
			select t1.*
			from cart t1
			where t1.storeid = ".$_SESSION['storeid']."
			and t1.status = '$status'
		";

		if($status == "returned"){
			$sql = "
				select t1.*
				from cart t1
				where t1.storeid = ".$_SESSION['storeid']."
				and t1.status = '$status'
				and t1.return_status = 'For Review'
			";
		}

		return $this->db->query($sql)->fetchAll();
	}

	public function deleteDeliveryFeeListener(){
		if(isset($_POST['deleteDeliveryFee'])){
			$sql = "
				delete from delivery_fee
				where id = ?
			";	

			$this->db->prepare($sql)->execute(array($_POST['id']));

			added();
		}
	}

	public function getDeliverFee(){
		$sql = "
			select *
			from delivery_fee
			where storeid = ".$_SESSION['storeid']."
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function addMunicipalFeeListener(){
		if(isset($_POST['addMunicipalFee'])){
			$sql = "
				insert into delivery_fee(municipality, fee,storeid)
				values(?,?, ?)
			";

			$this->db->prepare($sql)->execute(array($_POST['muni'], $_POST['fee'], $_SESSION['storeid']));

			die(json_encode(array($this->db->lastInsertId())));
		}
	}

	public function updateProofStatusListener(){
		if(isset($_POST['updateProofStatus'])){
			$sql = "
				update cart
				set return_status = ?
				where id = ?
			";

			$this->db->prepare($sql)->execute(array( $_POST['status'],$_POST['id']));

			die(json_encode(array("updated")));
		}
	}

	public function returnItemListener(){
		if(isset($_POST['returnItem'])){
			$this->addPurchaseProof($_POST['returnItem']);

			return $this;
		}
	}

	public function addPurchaseProof($cartId){
		if(!isset($_FILES['proof'])){
			return $this;
		}

		$files = $_FILES['proof']['tmp_name'];

		if($files){

			//start

			$merchantPath = 'uploads/user/'.$_SESSION['id']."/profile/";
			
		
			if(!file_exists($merchantPath)){
				mkdir($merchantPath,0777,true);
			}

			$folder_name = $merchantPath;

			 $temp_file = $_FILES['proof']['tmp_name'];
			 $ext = strtolower(pathinfo($_FILES["proof"]["name"],PATHINFO_EXTENSION));
			 $newName = md5($_FILES['proof']['name']) .".".$ext;
			 $location = $folder_name . $newName;

			 if(move_uploaded_file($temp_file, $location)){
			 	$sql = "
					UPDATE cart
					SET proof = ?, reason = ?, status = 'returned'
					WHERE id = ?
				";

				$this->db->prepare($sql)->execute(array($location, $_POST['reason'], $cartId));
			}
		} 

		return $this;
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
				$sql = "
					select *
					from fees
					where storeid = ".$_SESSION['storeid']."
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

				//add notification
				$product = $this->getCartById($_POST['id']);
				$title = "Order Update";
				$body = "
					<p>You order <a href='processed.php'>".$product['name']."</a> has been processed.</p>
				";

				$this->addNotification($title, $body, "forUser", $product['userid']);
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
			and t2.deleted = 0
			GROUP BY t1.productid
			limit 10
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getCODSubscription(){
		$sql = "
			select *
			from payments
			where payment_for = 'CODSubscription'
			and userid = ".$_SESSION['id']."
			and payment_status = 'Pending'
			limit 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function codSubscriptionListener(){
		if(isset($_POST['codSubscription'])){
			$exists = $this->getCODSubscription();
			if($exists){
				$sql = "
					update payments
					set codsub_date = ?
					where id = ?
				";

				$this->db->prepare($sql)->execute(array($_POST['date'], $exists['id']));

	          	$this->success = "Updated";
			} else {
				$sql = "INSERT INTO payments(payment_id, amount, currency, payment_status,userid,codsub_date,payment_for) VALUES(?,?,?,?,?,?,?)
                          ";

	          	$this->db->prepare($sql)->execute(array("COD", $_POST['amount'], 'PHP', 'Pending', $_SESSION['id'], $_POST['date'], "CODSubscription"));

	          	$this->success = "Saved";
			}

			$this->cashSubscriptionNotification($_POST['date']);

          	return $this;
		}
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
                	if(!empty($i)){
                		$f_pickup = $i['f_pickup'];
                		$f_shipping = $i['f_storeshipping'];
                		$f_total = $i['f_total'];
                		$f_tax = $i['f_tax'];

						foreach($i['products'] as $idx => $p){
							$sql = "
							  INSERT INTO cart(userid,productid,price,quantity,shipping,tax,transactionid,storeid,status,for_pickup)
							  VALUES(?,?,?,?,?,?,?,?,?,?)   
							";          
							$this->db->prepare($sql)->execute(array($_SESSION['id'],$p['detail']['activeproductid'],$p['detail']['price'],$p['qty'],$f_shipping ,$p['detail']['tax'], $transactionId, $p['detail']['storeid'], 'pending', $f_pickup));

							if($p['detail']['active'] == "production"){
								$this->updateProductQuantityById($p['detail']['activeproductid'], $p['qty'], false, $p['productId']);
							} else {
								//productt
								$this->updateProductQuantityById($p['detail']['activeproductid'], $p['qty']);
							}
	                    }
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

	public function loadAnnualByMunicipalityListener(){
		if(isset($_POST['loadAnnualCustomerByMunicipality'])){
			$storeid = $_SESSION['storeid'];
			$status = "delivered";
			$year = $_POST['year'];
			$month = "todo";
			$record = null;
			$months = array(
				"Boac" => 0,
				"Mogpog" => 0,
				"Santa Cruz" => 0,
				"Torrijos" => 0,
				"Buenavista" => 0,
				"Gasan" => 0
			);

			$sql = "
				select t3.address, t1.*,t2.name as 'product'
				from cart t1
				left join productt t2
				on t2.id = t1.productid
				left join userinfo t3
				on t3.userid = t1.userid
				where t1.storeid = $storeid
				and  t1.status = '$status'
				and YEAR( t1.date_created) = $year
			";


			$record = $this->db->query($sql)->fetchAll();

			foreach($record as $idx => $r){
				foreach($months as $idx2 => $m){
					$found = strpos($r['address'], $idx2);

					if($found > -1){
						$months[$idx2] += 1;

						break;
					}
				}

			}

			$totalOnly = array_values($months);

			$data =  json_encode(array("total" => $totalOnly, "record" => $record));

			die($data);
		}
	}

	public function loadDateRangeListener(){
		if(isset($_POST['loadDateRange'])){
			$storeid = $_SESSION['storeid'];
			$status = "delivered";
			$products = array();
			$where = ($_POST['date2'] == "")  ? "" : " AND t1.delivery_date BETWEEN '".$_POST['date2']."' AND '".$_POST['date3']."'";

			$sql = "
				select t1.*,t2.name as 'product'
				from cart t1
				left join productt t2
				on t2.id = t1.productid
				where t1.storeid = $storeid
				and  t1.status = '$status'
				$where
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
				and t1.deleted = 0
				$and

			";

			$_SESSION['lastQuery'] = $sql;

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

	public function updateProductQuantityById($id, $qty, $add = false, $production = false){
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

		$id = ($production) ? $production : $id;

		$this->updateProductionQuantityById($id, $qty, $add, $production);

		return $this;
	}

	public function getNextProduction($productId){
		$sql = "
			select t1.*
			from production t1
			where t1.remaining_qty > 0
			and t1.productid = ".$productId." 
			and date(t1.expiry_date) > date(CURRENT_DATE) 
			and t1.deducted = 0
			order by t1.expiry_date asc
			limit 1
		";
		$record = $this->db->query($sql)->fetch();

		return ($record) ? $record['id'] : 0;
	}

	public function updateProductionQuantityById($id, $qty, $add = false, $production = false){
		$productId = $this->getNextProduction($id);
		$sql = "
			update production
			set remaining_qty = remaining_qty-?
			where id = ?
		";

		if($add){
			$sql = "
				update production
				set remaining_qty = remaining_qty+?
				where id = ?
			";
		}

		if($production){
			$this->db->prepare($sql)->execute(array($qty, $production));
		
		} else {
			$this->db->prepare($sql)->execute(array($qty, $productId));

		}

		return $this;
	}

	public function addStoreSubscriptionListener(){
		if(isset($_POST['addStoreSubscription'])){
			$_SESSION['setup']['subscriptionId'] = $_POST['subscriptionId'];

			$this->addUser();

			if($_SESSION['setup']['usertype'] != "client"){
				$this->addStore();
			}

			$_POST['updateUserInfo'] = true;

			$this->updateUserInfoListener();
		
			$data = array(
				"added" => true,
				"done" => true
			);
			
			die(json_encode($data));
		}
	}

	public function likeShopListener(){
		if(isset($_POST['likeShop'])){
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
					if(isset($_POST['allow_pickup'])){
						$sql = "
							UPDATE store
							SET description = ?, logo = ?, allow_pickup = ?, pickup_location = ?
							WHERE id = ?
						";

						$this->db->prepare($sql)->execute(array($_POST['description'], $location, 1, $_POST['pickup_location'], $_SESSION['storeid']));
					} else {
						$sql = "
							UPDATE store
							SET description = ?, logo = ?, allow_pickup = ?
							WHERE id = ?
						";

						$this->db->prepare($sql)->execute(array($_POST['description'], $location, 0, $_SESSION['storeid']));
					}
				 	

					$this->success = "You have succesfully updated your store.";
				}

			} else {

				if(isset($_POST['allow_pickup'])){
					$sql = "
						UPDATE store
						SET description = ?, allow_pickup = ?, pickup_location = ?
						WHERE id = ?
					";

					$this->db->prepare($sql)->execute(array($_POST['description'], 1, $_POST['pickup_location'], $_SESSION['storeid']));
				} else {
					$sql = "
						UPDATE store
						SET description = ?, allow_pickup = ?
						WHERE id = ?
					";

					$this->db->prepare($sql)->execute(array($_POST['description'], 0, $_SESSION['storeid']));
				}

				

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
			// $products = $_POST['products'];
			// $modifiedQty = $_POST['modifiedQty'];
			// oppd()
			// foreach($products as $idx => &$p){
			// 	foreach($p['products'] as $idx2 => &$pp ){
			// 		$pId = $pp['productId'];
			// 		$qty = $pp['qty'];
			// 		$pp['qty'] = $modifiedQty[$pp['productId']];
			// 	}
			// }

			// $_POST['products'] = $_POST['products'];

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
						INSERT INTO fees(storeid,shipping,tax, minimum)
						VALUES(?,?,?,?)
					";	

					$this->db->prepare($sql)->execute(array($_SESSION['storeid'],$_POST['shipping'],$_POST['tax'],$_POST['minimum']));

					$this->success = "You have succesfully added this record";
				} else {
					$sql = "
						UPDATE fees
						SET shipping = ?, tax = ?, minimum = ?
						WHERE storeid = ?
					";	

					$this->db->prepare($sql)->execute(array($_POST['shipping'],$_POST['tax'],$_POST['minimum'],$_SESSION['storeid']));

					$this->success = "You have succesfully updated this record";
				}
			
			}

			return $this;
		}
	}

	public function getUserDeliveryAddress(){
		$sql = "
			select address
			from userinfo
			where userid  = ".$_SESSION['id']."
			limit 1
		";

		return $this->db->query($sql)->fetch(PDO::FETCH_ASSOC);
	}

	public function getFeeByStoreIdandUseraAddress($storeid, $address){
		$sql = "
			select *
			from delivery_fee
			where storeid = $storeid
		";
		$municipality =  $this->db->query($sql)->fetchAll();

		if($municipality){
			foreach($municipality as $idx => $m){
				$pos = strpos($address, $m['municipality']);
				
				if($pos > -1){
					return $m['fee'];

					break;
				}

			}
		} else {
			return false;
		}
		
		return false;
	}

	public function getAdminSetting($public=false){
		$where = ($public) ? "" : "where userid = ".$_SESSION['id'];
		$sql = "
			SELECT *
			FROM settings
			$where
			LIMIT 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function checkProductIdVariant($id){
		$sql = "
			select id,default_variant
			from productt
			where id = $id
			limit 1
		";

		return $this->db->query($sql)->fetch();
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
					$productVariant = $this->checkProductIdVariant($idx);
					$detail = array();

					if($productVariant){
						if($productVariant['default_variant'] == ""){
							//productt
							$sql = "
								SELECT t5.name as 'storename', t4.minimum, t5.allow_pickup, t5.pickup_location, t5.logo as 'storelogo',t1.*,t2.name as 'filename', t3.name as 'category', t4.shipping, t4.tax, t1.id as 'productionid', t6.price as 'productionprice', t6.variant as 'productionvariant', 'productt' as active, t1.id as 'activeproductid', t1.remaining_qty as 'maxQty'
								FROM productt t1
								LEFT JOIN media t2
								ON t1.id = t2.productid
								LEFT JOIN category t3
								ON t1.categoryid = t3.id
								LEFT JOIN fees t4 
								ON t4.storeid = t1.storeid
								LEFT JOIN store t5
								ON t5.id = t1.storeid
								left join production t6
								on t6.productid = t1.id
								WHERE t1.id = $idx
								AND t2.active = 1
								AND t1.deleted = 0
								LIMIT 1
							";
							$detail = $this->db->query($sql)->fetch();
						} else {
							//production
							$sql = "
								SELECT t5.name as 'storename', t4.minimum, t5.allow_pickup, t5.pickup_location, t5.logo as 'storelogo',t1.*,t2.name as 'filename', t3.name as 'category', t4.shipping, t4.tax, t6.id as 'productionid', t6.price as 'productionprice', t6.variant as 'productionvariant', 'production' as active, t1.id as 'activeproductid', t6.remaining_qty as 'maxQty'
								FROM productt t1
								LEFT JOIN media t2
								ON t1.id = t2.productid
								LEFT JOIN category t3
								ON t1.categoryid = t3.id
								LEFT JOIN fees t4 
								ON t4.storeid = t1.storeid
								LEFT JOIN store t5
								ON t5.id = t1.storeid
								left join production t6
								on t6.productid = t1.id
								WHERE t6.id = $idx
								AND t2.active = 1
								AND t1.deleted = 0
								LIMIT 1
							";
							$detail = $this->db->query($sql)->fetch();
						}
					} else {
							//production
						$sql = "
							SELECT t5.name as 'storename', t4.minimum, t5.allow_pickup, t5.pickup_location, t5.logo as 'storelogo',t1.*,t2.name as 'filename', t3.name as 'category', t4.shipping, t4.tax, t6.id as 'productionid', t6.price as 'productionprice', t6.variant as 'productionvariant', 'production' as active, t1.id as 'activeproductid', t6.remaining_qty as 'maxQty'
							FROM productt t1
							LEFT JOIN media t2
							ON t1.id = t2.productid
							LEFT JOIN category t3
							ON t1.categoryid = t3.id
							LEFT JOIN fees t4 
							ON t4.storeid = t1.storeid
							LEFT JOIN store t5
							ON t5.id = t1.storeid
							left join production t6
							on t6.productid = t1.id
							WHERE t6.id = $idx
							AND t2.active = 1
							AND t1.deleted = 0
							LIMIT 1
						";

						$detail = $this->db->query($sql)->fetch();
					}
				
					$shippingFee = $detail['shipping'];
					//determine shiping fee
					if(isset($_SESSION['id'])){
						$address = $this->getUserDeliveryAddress();
						$storeFee = $this->getFeeByStoreIdandUseraAddress($detail['storeid'], $address['address']);

						$shippingFee = ($storeFee) ? $storeFee : $shippingFee;
					} 

					if(!$detail){
						die(json_encode($cartItems));
					}

					$cartItems[$detail['storeid']]['storetax'] = number_format($detail['tax'],2);
					$cartItems[$detail['storeid']]['allow_pickup'] = $detail['allow_pickup'];
					$cartItems[$detail['storeid']]['minimum'] = number_format($detail['minimum'],2);
					$cartItems[$detail['storeid']]['pickup_location'] = $detail['pickup_location'];
					$cartItems[$detail['storeid']]['productid'] = $detail['storeid'];
					$cartItems[$detail['storeid']]['storeshipping'] = number_format($shippingFee,2);
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
			and t1.deleted = 0
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
			$product = $this->getProductById($_POST['id']);

			$sql = "
				INSERT INTO rating(productid,userid,rating,comment)
				VALUES(?,?,?,?)
			";

			$this->db->prepare($sql)->execute(array($_POST['id'], $_SESSION['id'], $_POST['rating'], $_POST['comment']));

			$count = $this->getReviewCountByProductId($_POST['id']);
			$profile = $this->getUserProfile();

			$title = "Product Review";

			$body = "
				<p>".$_SESSION['username']." reviewed one of your product.(<a href='productdetail.php?id=".$product['id']."'>".$product['name']."</a>)</p>
			";

			$this->addNotificationFromUser($title, $body, $product['storeid'], "UserReview");

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
			and t1.deleted = 0
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

	public function getCartById($id){
		$sql = "
			select t1.*,t2.name
			from cart t1
			left join productt t2
			on t1.productid = t2.id
			where t1.id = $id
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

	public function getCategoryByParentId($id){
		$sql = "
			select *
			from category
			where type = $id
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getLevel2CategoryListener(){
		if(isset($_POST['getLevel2Category'])){
			$categories = $this->getCategoryByParentId($_POST['id']);

			die(json_encode($categories));
		}
	}

	public function getLevel3CategoryListener(){
		if(isset($_POST['getLevel3Category'])){
			$categories = $this->getCategoryByParentId($_POST['id']);

			die(json_encode($categories));
		}
	}

	public function getCategoryByName($name, $level, $parent = false){
		$and = ($parent) ? " AND type = $parent" :"";


		$sql = "
			select *
			from category
			where name like '%".$name."%'
			and level = $level
			$and
			limit 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function addCategory2Listener(){
		if(isset($_POST['addCategory2'])){
			$exists = $this->getCategoryByName($_POST['name'],2, $_POST['category1']);

			if($exists){
				die(json_encode(array(false)));

			} else {
				$sql = "
					INSERT INTO category(name, level, type, breadcrumbs)
					VALUES(?, 2, ?,?)
				";

				$this->db->prepare($sql)->execute(array($_POST['name'],$_POST['category1'],$_POST['breadCrumbs']));

				$id = $this->db->lastInsertId();

				die(json_encode(array($id)));
			}
			
		}
	}

	public function addCategory3Listener(){
		if(isset($_POST['addCategory3'])){
			$exists = $this->getCategoryByName($_POST['name'],3, $_POST['category1']);

			if($exists){
				die(json_encode(array(false)));

			} else {
				$sql = "
					INSERT INTO category(name, level, type, breadcrumbs)
					VALUES(?, 3, ?,?)
				";

				$this->db->prepare($sql)->execute(array($_POST['name'],$_POST['category1'],$_POST['breadCrumbs']));

				$id = $this->db->lastInsertId();

				die(json_encode(array($id)));
			}
			
		}
	}

	public function addCategoryListener(){
		if(isset($_POST['addCategory'])){
			$exists = $this->getCategoryByName($_POST['name'],1);

			if($exists){
				die(json_encode(array(false)));

			} else {
				$sql = "
					INSERT INTO category(name,breadcrumbs)
					VALUES(?,?)
				";

				$this->db->prepare($sql)->execute(array($_POST['name'], $_POST['name']));

				$id = $this->db->lastInsertId();

				die(json_encode(array($id)));
			}
			
		}
	}

	public function searchAllProductListener(){
		if(isset($_POST['searchAllProduct'])) {
			$sql = "
				SELECT t1.*, t2.name as 'filename', t3.name , t3.brand, t3.storeid, t3.cost, if((date(CURRENT_DATE) >= date(t1.expiry_date)), 'expired' , '') as 'isExpired'
				FROM production t1
				LEFT JOIN media t2
				ON t1.productid = t2.productid
				left join productt t3
				on t1.productid = t3.id
				WHERE t3.storeid = ".$_SESSION['storeid']."
				AND t3.name LIKE '%".$_POST['txt']."%'
				AND t2.active = 1
				AND t1.deleted = 0
				limit 20
			";

			$data = $this->db->query($sql)->fetchAll();

			die(json_encode($data));
		}
	}

	public function getNextBatch(){
		$sql = "
			select t1.id
			from production t1
			left join productt t2 
			on t1.productid = t2.id
			where t2.storeid = ".$_SESSION['storeid']."
			order by t1.id desc
			limit 1
		";

		$record = $this->db->query($sql)->fetch();
		$date = date("ymd");

		return ($record) ? "{$date}" . ++$record['id'] : "{$date}1";
	}

	public function addToProduction($productId){
		$sql = "
				INSERT INTO production(productid,batchnumber,remaining_qty,qty,expiry_date,price, cost)
				VALUES(?,?,?,?,?,?,?)
			";

		$this->db->prepare($sql)->execute(array($productId, $_POST['batch'],$_POST['quantity'],$_POST['quantity'],$_POST['date_expire'],$_POST['price'],$_POST['cost']));

		return $this->db->lastInsertId();

	}

	public function addVariantToProduction($productId){
		foreach($_POST['variantData'] as $idx => $v){
			$sql = "
					INSERT INTO production(productid,batchnumber,remaining_qty,qty,expiry_date,price, cost,variant)
					VALUES(?,?,?,?,?,?,?,?)
				";

			$this->db->prepare($sql)->execute(array($productId, $_POST['batch'],$v[2],$v[2],$_POST['date_expire'],$v[1],$_POST['cost'], $v[0]));
		}

		return $this;
	}

	public function getProductListByProductId($id){
		$sql = "
			select *
			from product_list
			where productid = $id
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getProducionVariantByProductId($id){
		$sql = "
			select t1.id, t1.remaining_qty, t1.price, t1.variant
			from production t1
			left join productt t2
			on t1.productid = t2.id
			where t2.deleted = 0
			and t1.productid = $id
		";
        $product = $this->getProductById($id);
		$record = $this->db->query($sql)->fetchAll();
		$data = array();

		$data["default"] = $product;

		foreach($record as $idx => $r){
			$data[$r['variant']] = $r;
		}

		return json_encode($data);
	}

	public function getProductVariantsByProductId($id){
		$sql = "
			select *
			from variants
			where productid = $id
		";

		$data = $this->db->query($sql)->fetchAll();
		$filteredData = array();
		$groupedData = array("single" => array(), "multiple" => array());

		foreach($data as $idx => $d){
			$filteredData[$d['name']][] = $d['value'];
		}

		foreach($filteredData as $idx2 => $f){
			if(count($f) > 1){
				$groupedData["multiple"][$idx2] = $f;
			} else {
				$groupedData["single"][$idx2] = $f;
			}

		}
		// opd($groupedData);

		return $groupedData;
	}

	public function addListDescription($list, $productId){
		foreach($list as $idx => $l){
			$sql = "
				insert into product_list(storeid,productid,name)
				values(?,?,?)
			";

			$this->db->prepare($sql)->execute(array($_SESSION['storeid'], $productId, $l));
		}

		return $this;
	}

	public function addVariants($variants, $productId){
		foreach($variants as $idx => $l){
			$sql = "
				insert into variants(productid,name,value)
				values(?,?,?)
			";

			$this->db->prepare($sql)->execute(array($productId, $l[0], $l[1]));
		}

		return $this;
	}
	
	public function getVariantsTotal(){
		$total = 0;

		foreach($_POST['variantData'] as $idx => $v){
			$total += $v[2];
		}

		return $total;
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
				if($_POST['cost'] >= $_POST['price']){
					$this->errors[] = "Cost Price should be less than Retail Price";

					die(json_encode(array("error" => $this->errors)));
				}

				$variantQty = (isset($_POST['variantData'])) ? $this->getVariantsTotal() : $_POST['quantity'];
				$defaultVariant = isset($_POST['variantData']) ? $_POST['variantData'][0][0] : '';

				$sql = "
					INSERT INTO productt(name,categoryid,price,brand,quantity,cost,description,storeid, expiration,remaining_qty,default_variant)
					VALUES(?,?,?,?,?,?,?,?, ?,?,?)
				";

				$this->db->prepare($sql)->execute(array($_POST['title'], $_POST['category'],$_POST['price'],$_POST['brand'],$variantQty,$_POST['cost'],$_POST['desc'],$_SESSION['storeid'], $_POST['date_expire'],$variantQty, $defaultVariant));

				$this->success = "You have sucesfully added this product.";

				$id = $this->db->lastInsertId();

				if(isset($_POST['variantData']) > 0){
					$this->addVariantToProduction($id);
				} else {
					$this->addToProduction($id);
				}

				$this->addMediaByProductId($id, $_POST['src'], $_POST['active']);

				if(isset($_POST['listDesc'])){
					$this->addListDescription($_POST['listDesc'], $id);

				}
				if(isset($_POST['variants'])){
					$this->addVariants($_POST['variants'], $id);
				}
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
			AND t1.deleted = 0
			LIMIT 100
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getProductByBrand($brand){
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
			AND t1.brand LIKE '%$brand%'
			AND t4.verified = 1
			AND t1.deleted = 0
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
			AND t1.deleted = 0
			AND t4.verified = 1
			LIMIT 100
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getProductByCategoryName($name){
		$sql = "
			SELECT t1.*, t2.name as 'filename'
			FROM productt t1
			LEFT JOIN media t2
			ON t1.id = t2.productid
			LEFT JOIN store t3
			ON t3.id = t1.storeid
			LEFT JOIN user t4
			ON t4.id = t3.userid
			left join category t5
			on t5.id = t1.categoryid
			WHERE t2.active = 1
			AND t5.breadcrumbs like '%$name%'
			AND t1.deleted = 0
			AND t4.verified = 1
			LIMIT 100
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getStoreProducts(){
		$sql = "
			select t1.*
			from productt t1
			where t1.storeid = ".$_SESSION['storeid']."
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
			AND t1.deleted = 0
			LIMIT 100
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getStoreAllProducts(){
		$sql = "
			SELECT t1.*, t2.name as 'filename', t3.name , t3.brand, if((date(CURRENT_DATE) >= date(t1.expiry_date)), 'expired' , '') as 'isExpired'
			FROM production t1
			LEFT JOIN media t2
			ON t1.productid = t2.productid
			left join productt t3
			on t1.productid = t3.id
			WHERE t3.storeid = ".$_SESSION['storeid']."
			AND t2.active = 1
			AND t1.deleted = 0
			and t3.deleted = 0
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
			and t1.deleted = 0
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

	public function getStoreSlides(){
		$sql = "
			SELECT *
			FROM slides
			WHERE type = 'slider'
			and storeid = ".$_SESSION['storeid']."
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
				INSERT INTO slides(title,content,photo,type, storeid)
				VALUES(?,?,?,?,?)
			";

			$type = (isset($_POST['addNews'])) ? "news" : "slider";

			$this->db->prepare($sql)->execute(array($_POST['title'],$_POST['subtext'],$_POST['photo'], $type, $_SESSION['storeid']));

			die(json_encode(array("added")));
		}
	}

	public function getBreadcrumbsByCategoryId($id){
		$sql = "
			select *
			from category
			where id = $id
			limit 1
		";

		$bread = array();

		$data =  $this->db->query($sql)->fetch();

		if($data){
			$crumb = explode("</span>", $data['breadcrumbs']);

			foreach($crumb as $idx => $c){
				if(trim($c) != ""){
					$category = strstr($c, '>');
					$category = str_replace(">", "", $category);
					$category = str_replace("&gt;", "", $category);

					if($category != ""){
						$bread[] = str_replace("&gt;", "", $category);
					}
				}
			}
		}

		return $bread;
	}

	public function getAllActiveCategories(){
		$sql = "
			SELECT *
			FROM category
			WHERE isactive = 1
			and type = 'parent'
		";

		return $this->db->query($sql)->fetchAll();
	}
	public function getAllCategories(){
		$sql = "
			SELECT *
			FROM category
			where type = 'parent'
		";

		return $this->db->query($sql)->fetchAll();
	}

	public function getAllProductCategories(){
		$sql = "
			SELECT *
			FROM category
			where isactive = 1
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
	
	public function getAllStores(){
		$sql = "
			select t1.*,t2.verified,t2.id as 'userid'
			from store t1
			left join user t2
			on t1.userid = t2.id
		";
			// where t2.verified = 0

		return $this->db->query($sql)->fetchAll();
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

	public function getProductionById($id){
		$sql = "
			select *
			from production
			where id = $id
			limit 1
		";

		return $this->db->query($sql)->fetch();
	}

	public function deleteProductionListener(){
		if(isset($_POST['deleteProduction'])){
			$production = $this->getProductionById($_POST['id']);

			if($production['deducted']){
				$sql = "
					update production
					set deleted = 1
					WHERE id = ?
				";

				$this->db->prepare($sql)->execute(array($_POST['id']));
			} else {
				$sql = "
					update production
					set deleted = 1, deducted = 1
					WHERE id = ?
				";

				$this->db->prepare($sql)->execute(array($_POST['id']));
				$this->updateProductInventoryById($production['productid'],$production['remaining_qty'], true);
			}
			
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
				AND t1.deleted = 0
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
			left join productt t3
			on t1.productid = t3.id
			where t1.status = '$status'
			and t1.userid = ".$_SESSION['id']."
			and t3.deleted = 0
			order by t1.date_created desc
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
				left join productt t4
				on t1.productid = t4.id
				WHERE t1.status = '$status'
				and t1.userid =".$_SESSION['id']."
				and t4.deleted = 0
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
			SELECT t1.*,t2.photo as 'profilePicture', t3.position
			FROM userinfo t1
			LEFT JOIN user t2
			ON t1.userid = t2.id
			left join store t3
			on t3.userid = t2.id
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
					INSERT INTO userinfo(fullname,address,contact,email,userid,bday)
					VALUES(?,?,?,?,?,?)
				";
	
				$this->db->prepare($sql)->execute(array($_SESSION['setup']['fullname'], $_SESSION['setup']['address'], $_SESSION['setup']['contact'], $_SESSION['setup']['email'], $_SESSION['id'], $_SESSION['setup']['birthday']));
			} else {

				$id = (isset($_SESSION['id']) ? $_SESSION['id'] : $_SESSION['lastinsertedid']);

				$sql = "
					UPDATE userinfo
					SET fullname = ?, address = ?, contact = ?, email = ?, bday = ?
					where userid = $id
				";

				if(isset($_SESSION['setup']['fullname'])){
					$this->db->prepare($sql)->execute(array($_SESSION['setup']['fullname'], $_SESSION['setup']['address'], $_SESSION['setup']['contact'], $_SESSION['setup']['email'], $_SESSION['setup']['birthday']));
				} else {
					$this->db->prepare($sql)->execute(array($_POST['fullname'], $_POST['address'], $_POST['contact'], $_POST['email'], $_POST['birthday']));
				}

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
				SET name = ?, price = ?, cost = ?, quantity = ?, brand = ?, description = ?, expiration = ?
				WHERE id = ?
			";

			$this->db->prepare($sql)->execute(array($_POST['name'], $_POST['price'], $_POST['cost'], $_POST['quantity'], $_POST['brand'], $_POST['description'], $_POST['expiration'], $_POST['editmaterial']));

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
				update productt
				set deleted = 1
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
				left join productt t3 
				on t1.productid = t3.id
				where t1.status = '$status'
				and t1.storeid = ".$_SESSION['storeid']."
				and t3.deleted = 0
			";

			return $this->db->query($sql)->fetch();
		}

		$sql = "
			select t1.*
			from cart t1
			left join transaction t2
			on t1.transactionid = t2.id
			left join productt t3 
			on t1.productid = t3.id
			where t1.status = '$status'
			and t1.storeid = ".$_SESSION['storeid']."
			and t3.deleted = 0
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
		$sql[] = "delete from production";
		$sql[] = "delete from material";
		$sql[] = "delete from userinfo where userid !=36";
		$sql[] = "delete from cart";
		$sql[] = "delete from cart_details";
		$sql[] = "delete from payments";
		$sql[] = "delete from transaction";
		$sql[] = "delete from notification";

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
			$_SESSION['setup']['fullname'] = $_POST['fullname'];
			$_SESSION['setup']['address'] = $_POST['address'];
			$_SESSION['setup']['contact'] = $_POST['contact'];
			$_SESSION['setup']['email'] = $_POST['email'];
			$_SESSION['setup']['birthday'] = $_POST['birthday'];
			
			if($_SESSION['setup']['usertype'] == "client"){

				$this->addUser();

				$_POST['updateUserInfo'] = true;

				$this->updateUserInfoListener();

				$data = array(
					"added" => true,
					"done" => true
				);
				
				die(json_encode($data));
			}

			$data = array("added" => true);

			die(json_encode($data));
		}
	}


	public function addStore(){
		$sql = "
			INSERT INTO store(name,userid,b_address,dti,b_email,b_contact,subscriptionid, position)
			VALUES(?,?,?,?,?,?,?,?)
		";

		$this->db->prepare($sql)->execute(array($_SESSION['setup']['store'], $_SESSION['lastinsertedid'],$_SESSION['setup']['b_address'],$_SESSION['setup']['dti'],$_SESSION['setup']['b_email'],$_SESSION['setup']['b_contact'], $_SESSION['setup']['subscriptionId'], $_SESSION['setup']['position']));

		$_SESSION['laststoreid'] = $this->db->lastInsertId();

		return $this;
	}

	public function loginListener(){
		if(isset($_POST['login'])){
			$sql = "
				SELECT t1.*, t2.id as 'storeId',t2.name as 'storeName'
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
				$_SESSION['storename'] = $exists['storeName'];
				$_SESSION['usertype'] = $exists['usertype'];
				$_SESSION['verified'] = $exists['verified'];

				$_SESSION['password'] = $exists['password'];
				$_SESSION['name'] = $exists['fullname'];

				unset($_SESSION['setup']);

				if($exists['usertype'] == "admin"){
					header("Location:admindashboard.php");
				} else if($exists['usertype'] == "client") {
					header("Location:userdashboard.php");
				} else {
					$_SESSION['storeName'] = $exists['storeName'];

					$this->getStoreNotifications();

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