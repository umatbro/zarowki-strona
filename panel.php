<?php
	echo '<a href="index.php">Powrót do strony głównej</a><br/>';
	require_once "connect.php";
	$connection = new mysqli($host, $db_user, $db_password, $db_name);
	if($connection -> connect_error) 
	{
		echo $connection_error = "Błąd połączenia: ".$connection -> connect_error;
	}
	
	if(isset($_GET['wyslij']))
	{
		$getid = $_GET['wyslij'];
		$query = "UPDATE `zamowienia` SET `status` = 'wyslano' WHERE `zamowienia`.`idz` = $getid";
		$connection ->query($query);
		unset($_GET['wyslij']);
		header("Location: panel.php");
	}

?>

<title>Panel admina</title>

<?php

	$query = "SELECT `z`.`idz`, `p`.`marka`, `p`.`model`, `z`.`sztuk`, `z`.`adres`, `z`.`dozaplaty`, `z`.`status` FROM zamowienia z JOIN produkty p ON (z.idp = p.id) ORDER BY z.`idz`;";
	
	$resultsAll = $connection->query($query);
	$prevID=0;
	?>
	<table border style="border: solid;">
		<tr> <th>Nr zamówienia</th> <th> Marka </th> <th>Model</th> <th>Sztuk</th> <th>Adres klienta</th> <th>Do zapłaty</th> <th>Status wysyłki</th></tr>
		<?php 
		while($row = $resultsAll->fetch_assoc())
		{?>
			<?php
				$terazID = $row['idz'];
				if($prevID != $row['idz'])
				{
					$zapytanie_o_ilosc = $connection->query("SELECT count(idz) AS `wierszy` FROM zamowienia WHERE idz=$terazID");
					$r = $zapytanie_o_ilosc->fetch_assoc();
					$wierszy = $r['wierszy'];
				}
			?>
	
	
			<tr>
			<?php if($prevID != $row['idz']) echo "<td rowspan=$wierszy > " ?>
			<?php  if($prevID != $row['idz']) echo $row['idz']."</td>"; ?>
			<td> <?php echo $row['marka'];?> </td>
			<td> <?php echo $row['model'];?> </td>
			<td> <?php echo $row['sztuk'];?> </td>
			<?php if($prevID != $row['idz']) echo "<td rowspan=$wierszy > " ?>
			<?php  if($prevID != $row['idz']) echo $row['adres']."</td>"; ?>
			<?php if($prevID != $row['idz']) echo "<td rowspan=$wierszy > " ?>
			<?php  if($prevID != $row['idz']) echo $row['dozaplaty']."</td>"; ?>
			<?php if($prevID != $row['idz']) echo "<td rowspan=$wierszy > " ?> <?php 
				if($prevID != $row['idz'])
				{	if($row['status']=='oczekuje')
					{
						echo $row['status'];
						echo " <a href=panel.php?wyslij=$terazID>(WYŚLIJ)</a>";
					}
					else echo $row['status'];	
				}					
				?> <?php  if($prevID != $row['idz']) echo "</td>"; ?>
			</tr>
			
		
		<?php $prevID=$row['idz'];} ?>
	
	
	</table>

	
	
<?php
	$connection->close();
?>