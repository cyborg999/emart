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
(store : pending,returned,review)
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
7. Inventory of batch per product
8. consider the expiration date sa deduction
3. verify credit card number
9. contact information(lagay nlang ng terms,privacy,contact page kay admin)
19. business profile(signup and user page)
10. delete button (explain deleted)
20. added database backup

round2
1. cod sa membership
2. notification if the owner paid, add narin if malapit na mag expire, or expired
4. same format file upload(hindi pwede i resize kasi if niresize yung small image, magiging pixelated. so mag lagay nalang ng minimum resolution, resize if sobrang laki ng resolution)
5. Product Options
12. reports (filter daily, weekly,monthly)
13. analytics ng customers and products
16. may negative quantity





bugs
show sa order page if pickuponly, d padin narerecord sa db

cart
pickup shipping
dapat magreflect yung excluded product before mapunta sa checkout
check overall total if kelangan i reset(if mag add delete ng order)
lumiit yung sidenav sa filtered.php page
fix terms.php/privacy/contact design
redesign social media add
add footer to other public pages
backup data
(dapat mawala sa sales and inventory, check if may babad na order)
15.(explain cookie baka mxagtaka sa mga added carts sa product na d naadd)
17. exclude sa order of minimum
18. redesign, continue shopping link https://bootstrap-ecommerce.com/page-components.html#download
if manual input sa product detail
