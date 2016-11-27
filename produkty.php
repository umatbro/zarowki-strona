<?php session_start();
	if(isset($_SESSION['zamowien'])) $zamowien=$_SESSION['zamowien'];
	else $zamowien=0;
	require_once "php/func.php";
	$productsPerPage = 4; //ilość wyświetlanych produktów na stronie
	$productsPerRow = 2; //ilość produktów w jednym wierszu
	if(!isset($pageNum)) $pageNum = 1;
?>

	<!-- POŁĄCZENIE Z BAZĄ DANCYCH -->
	<?php
		require_once "connect.php";
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		
		if($connection -> connect_error) {
			$connection_error = "Błąd połączenia: ".$connection -> connect_error;
		}
		
		//ZAPYTANIE SQL
		$sql_query = "SELECT * FROM produkty ORDER BY typ;";
		
		//ilość zwróconych rekordów
		$result = $connection->query($sql_query);
		$rowsReturned = $result->num_rows; 
		
		if($rowsReturned>0)
		{
			//obliczenie ilości stron potrzebnych do wyświetlenia wszystkich wyników
			$pagesAmount = $rowsReturned/$productsPerPage;
			if($rowsReturned%$productsPerPage != 0) $pagesAmount++;
			$pagesAmount = intval($pagesAmount);
		}
		else
		{
			$error_noresults = '<div class="error">Brak wyników</div>';
		}



	if(isset($connection) && !isset($connection_error)) {$connection->close();}
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
			<li><span class="currsite" title="Oferta firmy">produkty</span></li>
			<li><a href="kontakt.php" title="Skontaktuj się z nami">kontakt</a></li>
			<li><a href="koszyk.php" title="Twoje zamówienie">koszyk <?php echo "($zamowien)"; ?></a></li>
			<li> <a href="panel.php" title="Panel administratora">panel</a> </li>
		</ol>
	</div>
<div id=container>


	<div id=content>
		<?php
			if(isset($connection_error)) echo $connection_error;		
		?>
		<?php
				//numer aktualnej strony
				
				echo '<div style="text-align: right; margin-right:30px; font-size: 14px; color:darkgray;">Wyników wyszukania: '.$rowsReturned." | Strona: ";
				if(isset($_GET['page']))
				{
					$pageNum=$_GET['page'];
					unset($_GET['page']);
				}
				
				$prevPage = $pageNum - 1;
				$nextPage = $pageNum + 1;
				if ($pageNum>1) echo "<a class=pagecontrol title='poprzednia strona' href=produkty.php?page=$prevPage><<</a>";
				echo $pageNum."/".$pagesAmount;
				if ($pageNum < $pagesAmount) echo "<a class=pagecontrol title='następna strona' href=produkty.php?page=$nextPage> >> </a>";
				echo "</div></br>";
		?>	
	
		<?php //komunikat o braku produktu
		 	if (isset($_SESSION['error_stan'])) 
			{?><div class=error style="margin-right:auto; margin-left:auto;"><?php
				echo $_SESSION['error_stan'];
				unset($_SESSION['error_stan']);
				?></div> <?php
			}
		
		?>
		
		<?php	
				if(isset($error_noresults)) echo $error_noresults;
				if($pageNum>$pagesAmount) echo '<span class=error>Nieprawidłowy numer strony.</br> Powróć do <a class=pagecontrol href=produkty.php>pierwszej strony</a>.</span>';
				
				//WYŚWIETLENIE REKORDÓW
				//przewijanie niepotrzebnych
				for($i=0;$i<($pageNum-1)*$productsPerPage;$i++) $row=$result->fetch_assoc();
				
				//wyswietlanie potrzebnych
				for($i=0;$i<$productsPerPage; $i++)
				{
					if($row = $result->fetch_assoc())
					{
						echo '<div class="tabdiv">';
						displayTable($row['marka'],$row['model'],$row['typ'],$row['mocwat'],$row['cena'],$row['stanmagazyn'],$row['obraz'],$row['id']);
						echo '</div>';
						
						
						//echo "id: ".$row['id']." Model: ".$row['model']."<br/>";
					}
				}
				echo '<div style="clear:both;"></div>';
		?>
		<!-- <div class="tabdiv"></div> -->
	
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