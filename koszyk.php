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
			<li><a href="index.php" title="Strona domowa">home</a></li>
			<li><a href="produkty.php" title="Oferta firmy">produkty</a></li>
			<li><a href="kontakt.php" title="Skontaktuj się z nami">kontakt</a></li>
			<li><span class="currsite" title="Twoje zamówienie">koszyk <?php echo "($zamowien)"; ?></span></li>
			<li> <a href="panel.php" title="Panel administratora">panel</a> </li>
		</ol>
	</div>
<div id=container>


	<div id=content>
		KONTENT</br>
		<a href="php/addtocart.php?delete=1">USUN</a>
		 
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