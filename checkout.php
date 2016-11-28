<?php session_start();
	if(isset($_SESSION['zamowien'])) $zamowien=$_SESSION['zamowien'];
	else $zamowien=0;
	require_once("php/func.php");
?>

<!-- POŁĄCZENIE Z BAZĄ DANCYCH -->
	<?php
		if((isset($_POST['ulica']) && $_POST['ulica']=='') || (isset($_POST['kod']) && $_POST['kod']=='') || (isset($_POST['miasto']) && $_POST['miasto']=='')) $error_adres ='<span style="color:red;">WPROWADŹ ADRES</span>';
		else{
		if(isset($_POST['confirm']) && !isset($error_adres))
		{
			require_once "connect.php";
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			
			if($connection -> connect_error) 
			{
				$connection_error = "Błąd połączenia: ".$connection -> connect_error;
			}
			
			if(isset($_SESSION['pelna-cena'])) $cena = $_SESSION['pelna-cena'];
			else $cena = 0;
			$adres = "'".htmlentities($_POST['ulica']." ".$_POST['kod']." ".$_POST['miasto'])."'";
			$status = "'oczekuje'";
			$query = "SELECT MAX(idz) as `nrostatniego` FROM zamowienia";
			$result = $connection -> query($query);
			$row = $result->fetch_assoc();
			if(isset($row['nrostatniego'])) $nrZamowienia = $row['nrostatniego']+1;
			else $nrZamowienia = 1;
			
			//wpisanie zamowienia do bazy
			for($i=0;$i<$_SESSION['indeks_zamowien']; $i++)
			{
				$prodID = $_SESSION['klucze'][$i];
				$sztuk = $_SESSION['sztuk'][$prodID];
				$query = "INSERT INTO `zamowienia` VALUES (NULL, $nrZamowienia, $prodID, $sztuk, $adres, $cena, $status) ";
				$connection -> query($query);
				$zmiana_magazyn = "UPDATE produkty SET stanmagazyn = stanmagazyn - $sztuk WHERE id = $prodID";
				$connection -> query($zmiana_magazyn);
			}
			$_SESSION['komunikat'] = '<span style="color:#4CAF50;">Wysłano zamówienie</span>';
			
			unset($_SESSION['zamowien']);
			unset($_SESSION['indeks_zamowien']);
			unset($_SESSION['sztuk']);
			unset($_SESSION['klucze']);
			unset($_SESSION['pelna-cena']);
			header("Location: koszyk.php");
			exit();
		}}
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
			<li><a href="koszyk.php" title="Twoje zamówienie">koszyk <?php echo "($zamowien)"; ?></a></li>
			<li> <a href="panel.php" title="Panel administratora">panel</a> </li>
		</ol>
	</div>
<div id=container>

	<div id=content style="margin-top:40px;">
	
		<div style="margin-right: auto; margin-left: auto; text-align:center;">
		<?php
		//echo $connection->error;
		//echo $query;
		if(isset($error_adres)) {echo $error_adres; unset($error_adres);}
 		if(isset($connection_error)) echo $connection_error;
		if(isset($komunikat)) echo $komunikat;
		?><br/>
		Do zapłaty: <?php echo $_SESSION['pelna-cena']; ?> zł <br/> <br/>
		<form method=post action="checkout.php">
			<div style="text-align:left;">ADRES:<br/>
			ulica, numer domu: 
			<input type=text name="ulica" /><br/>
			kod pocztowy, miasto <input type=text name="kod" /> <input type=text name="miasto" /></br>
			<input type=submit value="POTWIERDŹ" name="confirm"/></div>
		</form>
		 </div>
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


<?php  //zamknięcie połączenia z bazą
if(isset($connection) && !isset($connection_error)) {$connection->close();}
?>