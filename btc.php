<?php
/**
 * @author Chris S - AKA Someguy123
 * @version 0.01 (ALPHA!)
 * @license PUBLIC DOMAIN http://unlicense.org
 * @package +Coin - Bitcoin & forks Web Interface
 */
ini_set("display_errors", false);
include ("header.php");
$trans = $nmc->listtransactions('*', 100);
$x = array_reverse($trans);
$bal = $nmc->getbalance("*", 6);
$bal3 = $nmc->getbalance("*", 0);
$bal2 = $bal - $bal3;
echo "<div class='content'>
<div class='span5'>
<h1>Current Balance: <font color='green'>{$bal}</font></h1>
<h2>Unconfirmed Balance: <font color='red'>{$bal2}</font></h2>
</div><div class='span5'><a href='?orphan=1'>View Orphans</a><br /><a href='btc.php'>Go back</a></div>
<table class='table-striped table-bordered table'>
<thead><tr><th>Method</th><th>Account/Address</th><th>Amount</th><th>Confirmations</th><th>Time</th></tr></thead>";

foreach ($x as $x)
{
    if($x['amount'] > 0) { $coloramount = "green"; } else { $coloramount = "red"; }
    if($x['confirmations'] >= 6) { $colorconfirms = "green"; } else { $colorconfirms = "red"; }
	if (!isset($_GET['orphan']))
	{
		$date = date(DATE_RFC822, $x['time']);
        
		echo "<tr>";
        echo "<tr>";
        echo "<td>" . ucfirst($x['category']) . "</td>";
    	if (isset($x['address']))
    		echo "<td>{$x['address']} - {$x['account']}</td>";
    	else
            echo "<td style='text-align: center'>Generated</td>";
        echo "<td><font color='{$coloramount}'>{$x['amount']}</font></td><td><font color='{$colorconfirms}'>{$x['confirmations']}</font></td><td>{$date}</td></tr>";
	} else
	{
		$date = date(DATE_RFC822, $x['time']);
		if ($x['category'] == "orphan")
		{
			echo "<tr><td>{$x['account']}</td><td>{$x['amount']}</td><td>{$x['confirmations']}</td><td>{$x['category']}</td><td>{$date}</td></tr>";
		}
	}
}
echo "</table>";
//print_r($x);   
include("footer.php");
?>