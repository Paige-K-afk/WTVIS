<?php
require "dbinfo.php";
global $dbserver, $dbusername, $dbpassword, $dbdatabase;
//Access Database for names
$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
    if ($connection->connect_error)
    {
        echo "<p>Unable to establish a connection to the database $connection->connect_error</p>";// Unable to make a connection.  Display the error message returned
    }
    else
    {
		$query = "select DISTINCT Pokemon_Name from TRADES ORDER BY Pokemon_Name Asc ";
		$statement = $connection->prepare($query);
		$statement->execute();
		$statement->store_result();
		$statement->bind_result($mons);
	}
	$pkmn = array();
	while ($statement->fetch())
    {
		$pkmn[] = $mons;//fill arrray
	}
	$statement->close();
    $connection->close();
	echo "<ul>";
	$word = $_GET["word"];
	for($i = 0; $i < count($pkmn); $i++)
	{
		if (stripos($pkmn[$i], $word) !== FALSE)
		{
			echo'<li onClick="fillName(\''.$pkmn[$i].'\');">'.$pkmn[$i].'</li>';
		}
	}
	echo"</ul>";
?>