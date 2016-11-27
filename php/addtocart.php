<?php
session_start();

if(isset($_GET['productid'])) 
{
	if ($_GET['stan']>0)
	{
		$_SESSION['added'] = $_GET['productid'];
		$_SESSION['zamowien'] = $_SESSION['zamowien']+1;
	}
	else $_SESSION['error_stan'] = "Brak produktu na magazynie";
}
if(isset($_GET['delete']) && $_GET['delete']==1) $_SESSION['zamowien'] = 0;

//echo "Dodano ".$_SESSION['added']."</br>";
//echo '<a href="../produkty.php">WROC</a>';
header("Location: ../produkty.php");

?>