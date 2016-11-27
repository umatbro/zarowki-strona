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
		
		//ZAPYTANIE SQL
		$sql_query = "SELECT * FROM produkty WHERE id like $id;";
		
		//ilość zwróconych rekordów
		/*$result = $connection->query($sql_query);
		$rowsReturned = $result->num_rows; */
		

	//if(isset($connection) && !isset($connection_error)) {$connection->close();}
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
		<?php /*
			$_quer = $_SESSION['lista'][1];
			$result = $connection->query("SELECT * FROM produkty WHERE id = $_quer;");
			$row = $result-> fetch_assoc();
			displayProductOrder($row['obraz'],$row['marka'],$row['model'],$row['mocwat'],$row['cena'],1,1) */ ?>
		<?php
		if(isset($_SESSION['zamowien']) && $_SESSION['zamowien'] > 0)
		{
			$pelnaCena=0;
			echo '<a href="php/addtocart.php?delete=1" class="pagecontrol">usuń zawartość koszyka</a> <br /><br />';
			for ( $i = 1; $i<$_SESSION['zamowien']+1 ; $i++ )
			{
				$quer = $_SESSION['lista'][$i];
				$result = $connection->query("SELECT * FROM produkty WHERE id like $quer;");
				$row = $result->fetch_assoc();
				if(isset($_SESSION['lista'][$i]))//echo "<a href=php/addtocart.php?removeProduct=$i>".$_SESSION['lista'][$i].'</a>'."<br/> ";
				{
					//sprawdzenie powtórzeń - TUTAJ LETKIE BŁĘDY
					for ($j=1;$j<$i;$j++)
					{
						if(!isset($_SESSION['sztuk'][$_SESSION['lista'][$i]])) $_SESSION['sztuk'][$_SESSION['lista'][$i]] = 2;
						if($_SESSION['lista'][$i] == $_SESSION['lista'][$j]) $_SESSION['sztuk'][$_SESSION['lista'][$i]]++;
					}
					displayProductOrder($row['obraz'],$row['marka'],$row['model'],$row['mocwat'],$row['cena'],$_SESSION['sztuk'][$_SESSION['lista'][$i]],$i);
					$pelnaCena+=$row['cena'];
				}
			}
			echo '<br/><br/><span style="text-align:right">Cena całości: '.$pelnaCena." zł</span>";
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