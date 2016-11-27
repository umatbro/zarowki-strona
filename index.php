<?php session_start();
	if(isset($_SESSION['zamowien'])) $zamowien=$_SESSION['zamowien'];
	else $zamowien=0;
?>

<html lang=pl>
<head>
<meta charset=utf-8 />
<meta http-equiv="X-UA-Compatibile" content="IE=edge,chrome=1" />
<title>Lux - sklep internetowy</title>
<meta name="description" content="Sprzedaż żarówek" />
<link rel="stylesheet" href="style.css" />
</head>
<body>
<div id=topnav>
		<ol>
			<li><span class="currsite" title="Strona domowa">home</span></li>
			<li><a href="produkty.php" title="Oferta firmy">produkty</a></li>
			<li><a href="kontakt.php" title="Skontaktuj się z nami">kontakt</a></li>
			<li><a href="koszyk.php" title="Twoje zamówienie">koszyk
			<?php echo "($zamowien)"; ?></a></li>
			<li> <a href="panel.php" title="Panel administratora">panel</a> </li>
		</ol>
	</div>
<div id=container>


	<div id=content>
		<h2 style="text-align: center; color: #4CAF50">Witamy na stronie głównej naszego sklepu</h2>
		<br/>
		<span style="font-size: 20px;">We supply light bulbs, lamps and tubes from most of the major light source manufacturers as shown below. PLEASE NOTE: We do not show all of these on our web site so please contact us if you do not see the specific item that you need.</span>
		
		<h3>Philips</h3>

		Philips manufacture a wide range of top quality lamps including the “Master” range of long life high performance lamps and the “Pro” range of top quality light sources. In addition to the Philips products already featured on our web site we also supply many of their less widely used products and can generally supply any lamp from the Philips range. 
		
		<h3>Osram</h3>

		Many Osram lamps are shown on our web site but we also supply almost any other type of Osram lamp to order. This includes all manner of incandescent, tungsten halogen, compact fluorescent, energy saver light bulbs, fluorescent and discharge lamps plus many other types. We also supply many specialist lamps and light bulbs including those for medical, dental, horticultural and other such applications.
		<h3>GE</h3>

		GE is one of the world’s foremost lamp manufacturers – a descendant of the General Electric Company, founded by Thomas Edison. Many of the products that we supply are made by GE: These include compact fluorescents, halogen reflector lamps, fluorescent tubes, discharge lamps and many other items. We also supply many specialist and hard-to-find items including some obsolescent and discontinued lamps. 
		
		<h3>Sylvania</h3>

		The Sylvania range includes high quality lamps in a variety of technologies including fluorescent, compact fluorescent, HID and tungsten halogen lamps. We feature many Sylvania bulbs, tubes and lamps on our web site and can supply any product from the Sylvania European range.
		
		<h3>Crompton</h3>

		The Crompton Range of fluorescent, incandescent and tungsten halogen lamps also includes the “Manor House” collection of classic English style decorative candle lamps. We can supply most products from the Crompton range of lamps and many are shown on our web site.
		
		<h3>Bell (British Electric Lamps Ltd)</h3>

		The British Electric Lamps range includes a wide variety of incandescent, fluorescent and tungsten halogen lamps. Many are already shown on our web site and most of the range is available from stock. If you cannot see the exact item that you need please 
		
		<h3>Eye/Iwasaki</h3>

		Specialists in high performance tungsten halogen and high intensity discharge lamps, Iwasaki manufacture lamps for the most exacting of applications. Most Iwasaki/Eye lamps are available to order.
		
		<h3>BLV</h3>

		This high quality German manufacturer designs and manufactures a variety of specialist tungsten halogen and discharge lamps. We supply any of the products in the BLV range. 
		
		<h3>Panasonic</h3>

		Panasonic no longer supply lamps in the UK market however certain items can still be found and alternatives from other manufacturers are generally available.
		 
	</div>
	<div id=leftnav>
	partnerzy<br>
		<div class="lnpic"><img src="img/X.png" style="width:140px;"/></div>
		<div class="lnpic"><img src="img/X.png" style="width:140px;"/></div>
		<div class="lnpic"><img src="img/X.png" style="width:140px;"/></div>
	</div>
	
	<div id=footer>
		&copy; umat 2016
	</div>
</div>
</body>
</html>