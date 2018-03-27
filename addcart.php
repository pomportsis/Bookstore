<?php

if(!is_array($_SESSION['cart'])) 
{
	$sql = "select * from product";
	$_SESSION['cart']=array();
	if( $stmt = $mysqli->prepare($sql) ) 
	{
		$stmt->execute();
		$result = $stmt->get_result();
		while ($row = $result->fetch_assoc()) 
		{
			array_push($_SESSION['cart'],0);
		}
	}
}
$_SESSION['cart'][$_REQUEST['pid']] += $_REQUEST['qty'];

$sql = "select * from product where ID=?";
$stmt = $mysqli->prepare($sql);
$sum=0;



foreach($_SESSION['cart'] as $p => $q) {
 $stmt->bind_param("i", $p);
 $stmt->execute();
 $result = $stmt->get_result();
 $row = $result->fetch_assoc();
 if($q>0)
 {
	 print "ID: $p ".str_repeat('&nbsp;', 5);
	 print "Title: $row[Title] ".str_repeat('&nbsp;', 5);
	 print "Quantity: $q ".str_repeat('&nbsp;', 5);
	 print "Price: $row[Price] ".str_repeat('&nbsp;', 5);
	 print "Total: ". ($q * $row['Price'])."</br>";
	 $sum += ($q * $row['Price']);
 }
}
print "</br>";
print "Sum --> $sum";

print<<<END
<form action="index.php?p=emptycart" method="post">
    <input type="submit" name="delete" value="Empty Cart" onclick="insert()" />
</form>
<form action="index.php?p=buy" method="post">
    <input type="submit" name="buy" value="Buy" onclick="select()" />
</form>
END;


?>