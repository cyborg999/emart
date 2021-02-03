cart
https://www.bootdey.com/snippets/view/Shop-cart




add to notification if someone commented on product


cart
flag dummy client that dont pay cod
discontinued product
print receipt para ididikit sa package
reduce item quantity if purchased

user
userdashboard

merchant
link to dashboard
remove extra design sa homepage
receipt preview

pos
receipt,barcode
fix duplicate

install
composer require league/omnipay omnipay/stripe


https://github.com/mike42/escpos-php
composer require mike42/escpos-php











todo
* cost price < retail price (addproduct.php, products.php)
* merchant = grocery owner (signup.php)
* expiration date (addproduct.php, products.php)
* review ng product right after ma deliver(no need to go  to store)
* confirm muna ng merchant yung return, dapat may proof
* another confirmation before checkout ng poduct
* decimal places
* add slide ay dapat sa merchant
* may minimum purchase (globalfees.php, dito ako nag stop, d pa applied sa checkout page)
* shipping per municipality
* pick up option
* notification every status ng product
(store : pending,returned,review, lowstock, due date,comment)
(user: processed,delivered)

*delivery receipt
* batch # per product
* update quanty pag nag add ulit sa product detail
* 12/150 na inventory (priority yung malapit mag expired, if expired na, d na nababawasan)
* dapat makikita dun sa by batch kung saan nababawas yung item na nabenta
* low stock notification



done2
14. minimum total purchase (red if less than min order)
6. Critical level maintenance/ Low Stock
3. verify credit card number
9. contact information(lagay nlang ng terms,privacy,contact page kay admin)
19. business profile(signup and user page)
10. delete button (explain deleted)
20. added database backup

fixed bugs
* signup client 
* position ng owner
* pickup nawala
* profile error
* Inventory of batch per product
* consider the expiration date sa deduction (nasa login yung checking)
* production > if deleted, update remaining qty (if expired, d na ibawas)
* may negative quantity
* cod sa membership
* cod/credit notification sa admin
* due date notification sa store if malapit na mag expire  (pag 10 days or less nalang)
* sales reports (added date range filter, dapat mashoshow kahit deleted product)

round2
5. Product Options
4. same format file upload(hindi pwede i resize kasi if niresize yung small image, magiging pixelated. so mag lagay nalang ng minimum resolution, resize if sobrang laki ng resolution)
13. analytics ng customers and products





schedule ng admin
age analytics



19. search user if nakaorder ng palit product
20. update cart yung hindi cod na payment(shipping,tax,etc) sa checkout
cart
lumiit yung sidenav sa filtered.php page
fix terms.php/privacy/contact design
redesign social media add
add footer to other public pages
18. redesign, continue shopping link https://bootstrap-ecommerce.com/page-components.html#download
set max width sa related product(p details), masyado malaki if 1 or 2 lang
enable checkifpayed sa activate
if expired yung product with variant, dapat d mababawasan
if ordered cancelled, dapat sa same variant ma add yung remaining qty
wala bootstrap sa report ng client
client
show orders per transaction not per item

store
print receipt per transaction













visa cards test
============
https://stripe.com/docs/testing

composer require league/omnipay omnipay/stripe

check payments here
==========
https://dashboard.stripe.com/test/apikeys
sadiwajordan1991@gmail.com
Cyborg99912@

cards
NUMBER	BRAND	CVC	DATE
4242424242424242	Visa	Any 3 digits	Any future date
4000056655665556	Visa (debit)	Any 3 digits	Any future date
5555555555554444	Mastercard	Any 3 digits	Any future date
2223003122003222	Mastercard (2-series)	Any 3 digits	Any future date
5200828282828210	Mastercard (debit)	Any 3 digits	Any future date
5105105105105100	Mastercard (prepaid)	Any 3 digits	Any future date
378282246310005	American Express	Any 4 digits	Any future date
371449635398431	American Express	Any 4 digits	Any future date
6011111111111117	Discover	Any 3 digits	Any future date
6011000990139424	Discover	Any 3 digits	Any future date
3056930009020004	Diners Club	Any 3 digits	Any future date
36227206271667	Diners Club (14 digit card)	Any 3 digits	Any future date
3566002020360505	JCB	Any 3 digits	Any future date
		UnionPay	Any 3 digits	Any future date


testing errors
NUMBER	DESCRIPTION
4000000000000077	Charge succeeds and funds will be added directly to your available balance (bypassing your pending balance).
4000003720000278	Charge succeeds and funds will be added directly to your available balance (bypassing your pending balance).
4000000000000093	Charge succeeds and domestic pricing is used (other test cards use international pricing). This card is only significant in countries with split pricing.
4000000000000010	The address_line1_check and address_zip_check verifications fail. If your account is blocking payments that fail ZIP code validation, the charge is declined.
4000000000000028	Charge succeeds but the address_line1_check verification fails.
4000000000000036	The address_zip_check verification fails. If your account is blocking payments that fail ZIP code validation, the charge is declined.
4000000000000044	Charge succeeds but the address_zip_check and address_line1_check verifications are both unavailable.
4000000000005126	Charge succeeds but refunding a captured charge fails asynchronously with a failure_reason of expired_or_canceled_card. Note that because refund failures are asynchronous, the refund will appear to be successful at first and will only have the failed status on subsequent fetches. We also notify you of refund failures using the charge.refund.updated webhook event.
4000000000000101	If a CVC number is provided, the cvc_check fails. If your account is blocking payments that fail CVC code validation, the charge is declined.
4000000000000341	Attaching this card to a Customer object succeeds, but attempts to charge the customer fail.
4000000000009235	Results in a charge with a risk_level of elevated.
4000000000004954	Results in a charge with a risk_level of highest.
4100000000000019	Results in a charge with a risk_level of highest. The charge is blocked as it's considered fraudulent.
4000000000000002	Charge is declined with a card_declined code.
4000000000009995	Charge is declined with a card_declined code. The decline_code attribute is insufficient_funds.
4000000000009987	Charge is declined with a card_declined code. The decline_code attribute is lost_card.
4000000000009979	Charge is declined with a card_declined code. The decline_code attribute is stolen_card.
4000000000000069	Charge is declined with an expired_card code.
4000000000000127	Charge is declined with an incorrect_cvc code.
4000000000000119	Charge is declined with a processing_error code.
4242424242424241	Charge is declined with an incorrect_number code as the card number fails the Luhn check.

Color : white,red