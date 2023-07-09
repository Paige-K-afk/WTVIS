<?php
//require dbinfo.php;

////Access Database for names
//$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
//    if ($connection->connect_error)
    //{
        //echo "<p>Unable to establish a connection to the database $connection->connect_error</p>";// Unable to make a connection.  Display the error message returned
    //}
    //else
    //{
	//	$query = "select DISTINCT Pokemon from TRADES ORDER BY Pokemon Asc";
	//	$statement = $connection->prepare($query);
	//	$statement->execute();
    //  $statement->store_result();
    //  $statement->bind_result($mons);
	//}
	//$pkmn = array();
	//while ($statement->fetch())
    //{$pkmn[] = .$mons.;//fill arrray
	//}
	//$statement->close();
    //$connection->close();
	//echo "<ul>";
	////$word = $_GET["word"];
	//for($i = 0; $i < count($pkmn); $i++)
	//{
		//if (stripos($pkmn[$i], $word) !== FALSE)
		//{
			//echo'<li onClick="fill(\''.$pkmn[$i].'\');">'.$pkmn[$i].'</li>';
			
			//echo<li>$pkmn[i]</li>;
		//}
	//}
	//echo"</ul>";
	
	$pokes = array(
				"Normal",
				"Fighting",
				"Flying",
				"Poison",
				"Ground",
				"Rock",
				"Bug",
				"Ghost",
				"Steel",
				"Fire",
				"Water",
				"Grass",
				"Electric",
				"Psychic",
				"Ice",
				"Dragon",
				"Dark",
				"Fairy",
				"NA"
			);
    echo "<ul>";
    $word = $_GET["word"];
	$i = 0;
	while ($i < count($pokes))
	{
		$suggestion = $pokes[$i];
		if (stripos($suggestion, $word) !== FALSE)
		{
   			echo '<li onClick="fill(\''.$suggestion.'\');">'.$suggestion.'</li>';
		}
		$i++;
	}
    echo "</ul>";
?>