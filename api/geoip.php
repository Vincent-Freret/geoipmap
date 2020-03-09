<?php

include("_config.php");

$request_method = $_SERVER["REQUEST_METHOD"];
$id = $_GET["method"];
$ds = $_GET["date_s"];
$event = $_GET["event"];
$httpsrvname=$_SERVER['SERVER_NAME'];


if ($_GET['method'] == "add-geoip")
{

	$sqldel = "DELETE FROM geoip WHERE ip='".$_GET['ip']."';";
	$query = $conn->query($sqldel);

//* ip=13.45.212.23&continent_code=NA&country=United States&country_code=US&country_code3=USA&latitude=37.7510&longitude=-97.8220&timezone=America\/Chicago&offset=-21600&asn=23969&organization=TOT Public Company Limited&date=2020/27/02 13:10:32&cat=ssh-failures 
	$sqladd = "INSERT INTO geoip VALUES('".$_GET['ip']."','".$_GET['continent_code']."','".$_GET['country']."','".$_GET['country_code']."','".$_GET['country_code3']."','".$_GET['latitude']."','".$_GET['longitude']."','".$_GET['timezone']."','".$_GET['offset']."','".$_GET['asn']."','".$_GET['organization']."','".$_GET['date']."','".$_GET['cat']."');";
	$query = $conn->query($sqladd);

}

if ($_GET['method'] == "stats-geoip")
{


	$i=0;
	$sql = "SELECT *, count(*) as cmpt FROM geoip GROUP BY timezone ORDER BY cmpt DESC;";
	$query = $conn->query($sql);
	echo "markers = [ \n"; 
	while($r1 = $query->fetch_assoc())
	{
	
		$i++;
		echo "{\n";
		echo "	\"ip\":\"".$r1['ip']."\",\n";
		echo "	\"timzone\":\"".$r1['timezone']."\",\n";
		echo "	\"latitude\":\"".$r1['latitude']."\",\n";
		echo "	\"longitude\":\"".$r1['longitude']."\",\n";
		echo "	\"count\":\"".$r1['cmpt']."\",\n";

		$sql2 = "SELECT * FROM hoststatus WHERE host_mon = '".$r1['ip']."';";
		$query2 = $conn->query($sql2);
		while($r2 = $query2->fetch_assoc())
		{
			echo "	\"date_status\":\"".$r2['date_status']."\",\n";
			echo "	\"host_status\":\"".$r2['host_status']."\",\n";
		}

		echo "},\n";
	}
	echo "]; \n"; 

}

if ($_GET['method'] == "stats-cat-geoip")
{

	$sql = "SELECT * FROM geoip WHERE cat = '".$_GET['cat']."';";
	//echo $sql."\n";

	$i=0;
	$query = $conn->query($sql);
	echo "markers = [ \n"; 
	while($r1 = $query->fetch_assoc())
	{
	
		$i++;
		#$fqdn_host=exec("resolveip -s ".$r1['ip']."");
		echo "{\n";
		echo "	\"ip\":\"".$r1['ip']."\",\n";
		echo "	\"timzone\":\"".$r1['timezone']."\",\n";
		echo "	\"latitude\":\"".$r1['latitude']."\",\n";
		echo "	\"longitude\":\"".$r1['longitude']."\",\n";
		echo "	\"country_code\":\"".$r1['country_code']."\",\n";
		echo "	\"country\":\"".$r1['country']."\",\n";
		echo "	\"date\":\"".$r1['date']."\",\n";
		echo "	\"organization\":\"".$r1['organization']."\",\n";
		#echo "	\"fqdn\":\"".$fqdn_host."\",\n";
		$sql2 = "SELECT * FROM hoststatus WHERE host_mon = '".$r1['ip']."';";
		$query2 = $conn->query($sql2);
		while($r2 = $query2->fetch_assoc())
		{
			echo "	\"date_status\":\"".$r2['date_status']."\",\n";
			echo "	\"host_status\":\"".$r2['host_status']."\",\n";
		}

		$sql2 = "SELECT * FROM inventory WHERE id_host = '".$r1['ip']."';";
		$query2 = $conn->query($sql2);
		while($r2 = $query2->fetch_assoc())
		{
			echo "	\"os_release\":\"".$r2['os_release']."\",\n";
			echo "	\"os\":\"".$r2['os_host']."\",\n";
			echo "	\"fqdn\":\"".$r2['fqdn_host']."\",\n";
			echo "	\"sshd_status\":\"".$r2['method_host']."\",\n";
		}

		echo "},\n";
	}
	echo "]; \n"; 

}


if ($_GET['method'] == "list-cat-geoip")
{

	$sql = "SELECT * FROM geoip GROUP BY cat;";
	//echo $sql."\n";

	$i=0;
	$query = $conn->query($sql);
	while($r1 = $query->fetch_assoc())
	{
	
		$i++;
		echo "".$r1['cat']."\n";
	}

}


if ($_GET['method'] == "list-group-geoip")
{

	$sql = "SELECT * FROM geoip WHERE cat='".$_GET['cat']."';";
	//echo $sql."\n";

	$i=0;
	$query = $conn->query($sql);
	while($r1 = $query->fetch_assoc())
	{
	
		$i++;
		echo "".$r1['ip']."\n";
	}

}


mysqli_close($conn);

?>
