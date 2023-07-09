<?php
$___Authour___ = 100511480;
require "dbinfo.php";
global $dbserver, $dbusername, $dbpassword, $dbdatabase;

//foreach ($_POST as $key => $value)
//{
//	echo $key.":".$value."<br /><br />";
//}
//echo "done";
$name =  isset($_POST["name"])? $_POST["name"]: "Was not set";
//echo $name;
//echo $name;
getCount($name);

//Access Database for names

function getCount($Name)
{

	global $dbserver, $dbusername, $dbpassword, $dbdatabase;
	$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
    if ($connection->connect_error)
    {
        echo "<p>Unable to establish a connection to the database $connection->connect_error</p>";// Unable to make a connection.  Display the error message returned
    }
    else
    {
			$query = "SELECT COUNT(Pokemon_Name) FROM TRADES WHERE Pokemon_Name = ?";
			$statement = $connection->prepare($query);
			$statement->bind_param('s', $Name);
			$statement->execute();
			$statement->store_result();
			$statement->bind_result($numberOfMons);

			if ($statement->fetch())
			{
				echo $numberOfMons; //"0";//'{\"count\":\"'+$numberOfMons+'\"}';
				//return '{\"count\":\"'+$numberOfMons+'\"}';
				return $numberOfMons;
			}
			else
			{
				return null;
			}
			$statement->close();
			$connection->close();
			
			//return '{\"count\":\"'+$numberOfMons+'\"}';
			
	}
}
?>