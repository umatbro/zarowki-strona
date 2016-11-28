<?php session_start();
	if(isset($_SESSION['zamowien'])) $zamowien=$_SESSION['zamowien'];
	else $zamowien=0;
	require_once("php/func.php");
?>

<!-- POŁĄCZENIE Z BAZĄ DANCYCH -->
	<?php
		require_once "connect.php";
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		
		if($connection -> connect_error) {
			$connection_error = "Błąd połączenia: ".$connection -> connect_error;
		}
		
		

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


	<div id=content style="margin-top:40px;">
		<?php if(isset($_SESSION['komunikat'])) {echo $_SESSION['komunikat']."<br/>"; unset($_SESSION['komunikat']);} ?>
		<?php
		if(isset($_SESSION['zamowien']) && $_SESSION['zamowien'] > 0)
		{
			$_SESSION['pelna-cena']=0;
			echo '<a href="php/addtocart.php?delete=1" class="pagecontrol">usuń zawartość koszyka</a> <br /><br />';
			for ( $i = 0; $i<$_SESSION['indeks_zamowien'] ; $i++ )
			{
				$prodID = $_SESSION['klucze'][$i];
				$sztuk = $_SESSION['sztuk'][$prodID];
				displayProductOrder($prodID, $sztuk, $connection);
				//if(isset($_SESSION['lista'][$i])) echo "<a href=php/addtocart.php?removeProduct=$i>".$_SESSION['lista'][$i].'</a>'."<br/> ";
			}
			echo "CENA: ".$_SESSION['pelna-cena'];
			?>
			<br/>
			<br/>
			<form method=post action="checkout.php">
				<input type=submit value="ZAMÓW" />
			</form>
			
			
			<?php
			//echo '<br/><br/><span style="text-align:right">Cena całości: '.$pelnaCena." zł</span>";
			//echo "<br/>".$_SESSION['indeks_zamowien'].": indeks zamowine. sztuk ".$_SESSION['sztuk'][3]."</br>";
			//echo print_r($_SESSION['klucze']);
		}
		
		else echo "Koszyk pusty</br>";
		?>
		 
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