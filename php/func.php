<?php
	
	function displayTable($marka, $model, $typ,$moc, $cena, $stan, $obraz, $id)
	{
		//wartości domyślne
		if ($marka==NULL) $marka = "nieznany";
		if ($model==NULL) $model = "nieznany";
		if ($moc == NULL) $moc = "?";
		if ($typ == NULL) $typ = "nieznany";
		if ($cena == NULL) $cena = "?";
		
		?>
		
		<table width=400px>
			<tr> 
				<td style="width:150px;">
					<!--obrazek-->
					<img src="productimg/<?php echo "$obraz"; ?>" style="height:150px; width-max:150px;" />
				</td> 
				<td width=248px>
					<b style="color: #4CAF50; font-size: 1.5em;"><?php echo $marka; ?></b><br/>
					<?php
					echo '<span style="font-size: 0.8em">';
					echo $model;
					echo '</span>';
					?>
					
				</td> 
			</tr>
			<tr> 
				<td width=300px>Moc: <?php echo $moc; ?> W</td>
				<td width 98px>typ: <?php echo $typ; ?></td>
			</tr>
			<tr>
				<td><?php echo $cena;?> zł</td>
				<td>Na magazynie: <?php echo $stan;?>
					
				</td>
				<td><a href="php/addtocart.php?productid=<?php echo $id; ?>&stan=<?php echo $stan; ?>" title="id: <?php echo $id;?>"><img src="img/add-to-cart-light.png" height=40px /></a></td>
			</tr>
		
		</table>
		
		<?php
	}

?>