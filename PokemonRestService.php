<?php
    require "dbinfo.php";
    require "RestService.php";
    require "Pokemon.php";

// Before running this demo, you need to create a database in MySQL called
// wsbooks and populate it using the script wsbooks_mysql.sql.  You also need
// to edit the fields in dbinfo.php to refer to the database you are using.
//
// There is limited error handling in this code in order to keep the code as simple as
// possible.
 
class PokemonRestService extends RestService 
{
	private $pokemons;
    
	public function __construct() 
	{
		// Passing in the string 'books' to the base constructor ensures that
		// all calls are matched to be sure they are in the form http://server/books/x/y/z 
		parent::__construct("pokemons");
	}

	public function performGet($url, $parameters, $requestBody, $accept) 
	{
		switch (count($parameters))
		{
			case 1:
				// Note that we need to specify that we are sending JSON back or
				// the default will be used (which is text/html).
				header('Content-Type: application/json; charset=utf-8');
				// This header is needed to stop IE cacheing the results of the GET	
				header('no-cache,no-store');
				$this->getAllPokemon();
				//var_dump($this->pokemons);
				echo json_encode($this->pokemons);
				break;

			case 2:
				$integerInput = intval($parameters[1]);
				if($integerInput != 0) //Find a way to identify as a number 
				{
					$Trade_ID = $parameters[1];
					$pokemon = $this->getPokemonById($Trade_ID);
					if ($pokemon != null)
					{
						header('Content-Type: application/json; charset=utf-8');
						header('no-cache,no-store');
						//echo "{\"count\":\"3\"}";
						//echo json_encode($pokemon);
						echo json_encode($this->pokemons);
					}
					else
					{
						$this->notFoundResponse();
					}
					
					break;
				}
				else//if(=$parameters[1] ==)//Find a way to identify as  text or stay as else
				{
					$Name = $parameters[1];
					header('Content-Type: application/json; charset=utf-8');
					header('no-cache,no-store');
					$this->getPokemonByPokemon_Name($Name);
					//$count = count($this->pokemons);
					//echo "{\"count\":\"3\"}";
					echo json_encode($this->pokemons);
					break;
				}

			case 3:
				$integerInput1 = intval($parameters[1]);
				$integerInput2 = intval($parameters[2]);
				if($integerInput1 != 0 OR $integerInput2 != 0)
				// need both because blanks will become 0, so they both need to be taken into account.
				// Also, it takes in 0 and the parameter anyway, so if both are 0, we have the else.
				{
					$Level = $parameters[1];
					$Level_Met = $parameters[2];
					header('Content-Type: application/json; charset=utf-8');
					header('no-cache,no-store');
					$this->getPokemonByLevel($Level, $Level_Met);
					//echo "{\"count\":\"3\"}";
					echo json_encode($this->pokemons);
					break;
				}
				else
				{
					$Type1 = $parameters[1];
					$Type2 = $parameters[2];
					header('Content-Type: application/json; charset=utf-8');
					header('no-cache,no-store');
					$this->getPokemonByType($Type1, $Type2);
					//echo "{\"count\":\"3\"}";
					echo json_encode($this->pokemons);
					break;
				}
				
			default:	
				$this->methodNotAllowedResponse();
		}
	}

	public function performPost($url, $parameters, $requestBody, $accept) 
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$newPokemon = $this->extractPokemonFromJSON($requestBody);
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$sql = "insert into TRADES (Pokemon_Name, Trainer_Region, Pokemon_Region, Level, Level_Met, Gender, Type1, Type2, Nature, Pokeball, Held_Item, Perfect_IVs) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			// We pull the fields of the book into local variables since 
			// the parameters to bind_param are passed by reference.
			$statement = $connection->prepare($sql);
			$Pokemon_Name = $newPokemon->getPokemon_Name();
			$Trainer_Region = $newPokemon->getTrainer_Region();
			$Pokemon_Region = $newPokemon->getPokemon_Region();
			$Level = $newPokemon->getLevel();
			$Level_Met = $newPokemon->getLevel_Met();
			$Gender = $newPokemon->getGender();
			$Type1 = $newPokemon->getType1();
			$Type2 = $newPokemon->getType2();
			$Nature = $newPokemon->getNature();
			$Pokeball = $newPokemon->getPokeball();
			$Held_Item = $newPokemon->getHeld_Item();
			$Perfect_IVs = $newPokemon->getPerfect_IVs();
			
			$statement->bind_param('sssiissssssi', $Pokemon_Name, $Trainer_Region, $Pokemon_Region, $Level, $Level_Met, $Gender, $Type1, $Type2, $Nature, $Pokeball, $Held_Item, $Perfect_IVs);
			$result = $statement->execute();
			if ($result == FALSE)
			{
				$errorMessage = $statement->error;
			}
			$statement->close();
			$connection->close();
			if ($result == TRUE)
			{
				// We need to return the status as 204 (no content) rather than 200 (OK) since
				// we are not returning any data
				$this->noContentResponse();
			}
			else
			{
				$this->errorResponse($errorMessage);
			}
		}
	}

	public function performPut($url, $parameters, $requestBody, $accept) 
	{
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;

		$newPokemon = $this->extractPokemonFromJSON($requestBody);
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$sql = "update TRADES set Pokemon = ?, Trainer_Region = ?, Pokemon_Region = ?, Level = ?, Level_Met = ?, Gender = ?, Type1 = ?, Type2 = ?, Nature = ?, Pokeball = ?, Held_Item = ?, Perfect_IVs = ? where Trade_ID = ?";
			// We pull the fields of the book into local variables since 
			// the parameters to bind_param are passed by reference.
			$statement = $connection->prepare($sql);
			$Trade_ID = $newPokemon->getTrade_ID();
			$Pokemon_Name = $newPokemon->getPokemon_Name();
			$Trainer_Region = $newPokemon->getTrainer_Region();
			$Pokemon_Region = $newPokemon->getPokemon_Region();
			$Level = $newPokemon->getLevel();
			$Level_Met = $newPokemon->getLevel_Met();
			$Gender = $newPokemon->getGender();
			$Type1 = $newPokemon->getType1();
			$Type2 = $newPokemon->getType2();
			$Nature = $newPokemon->getNature();
			$Pokeball = $newPokemon->getPokeball();
			$Held_Item = $newPokemon->getHeld_Item();
			$Perfect_IVs = $newPokemon->getPerfect_IVs();
			$statement->bind_param('sssiissssssii', $Pokemon_Name, $Trainer_Region, $Pokemon_Region, $Level, $Level_Met, $Gender, $Type1, $Type2, $Nature, $Pokeball, $Held_Item, $Perfect_IVs, $Trade_ID);
			$result = $statement->execute();
			if ($result == FALSE)
			{
				$errorMessage = $statement->error;
			}
			$statement->close();
			$connection->close();
			if ($result == TRUE)
			{
				// We need to return the status as 204 (no content) rather than 200 (OK) since
				// we are not returning any data
				$this->noContentResponse();
			}
			else
			{
				$this->errorResponse($errorMessage);
			}
		}
	}

    public function performDelete($url, $parameters, $requestBody, $accept) 
    {
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;
		
		if (count($parameters) == 2)
		{
			$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
			if (!$connection->connect_error)
			{
				$id = $parameters[1];
				$sql = "delete from TRADES where Trade_ID = ?";
				$statement = $connection->prepare($sql);
				$statement->bind_param('i', $id);
				$result = $statement->execute();
				if ($result == FALSE)
				{
					$errorMessage = $statement->error;
				}
				$statement->close();
				$connection->close();
				if ($result == TRUE)
				{
					// We need to return the status as 204 (no content) rather than 200 (OK) since
					// we are not returning any data
					$this->noContentResponse();
				}
				else
				{
					$this->errorResponse($errorMessage);
				}
			}
		}
    }

    private function getAllPokemon()
    {
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;
		//$i = 1;
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$query = "select Trade_ID, Pokemon_Name, Trainer_Region, Pokemon_Region, Level, Level_Met, Gender, Type1, Type2, Nature, Pokeball, Held_Item, Perfect_IVs from TRADES";
			if ($result = $connection->query($query))
			{
				while ($row = $result->fetch_assoc())
				{
					$this->pokemons[] = new Pokemon($row["Trade_ID"], $row["Pokemon_Name"], $row["Trainer_Region"], $row["Pokemon_Region"], $row["Level"], $row["Level_Met"], $row["Gender"], $row["Type1"], $row["Type2"], $row["Nature"], $row["Pokeball"], $row["Held_Item"], $row["Perfect_IVs"]);
				//	$i++;
				//if ($i > 49)
				//{
				//	break; // added to only ever return 1 result}
				//}
				}
				$result->close();
			}
			$connection->close();
		}
	}	 

    private function getPokemonById($id)//fix up for pokemon
    {
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;
		
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$query = "select Trade_ID, Pokemon_Name, Trainer_Region, Pokemon_Region, Level, Level_Met, Gender, Type1, Type2, Nature, Pokeball, Held_Item, Perfect_IVs from TRADES where Trade_ID = ?";
			$statement = $connection->prepare($query);
			$statement->bind_param('i', $id);
			$statement->execute();
			$statement->store_result();
			$statement->bind_result($Trade_ID, $Pokemon_Name, $Trainer_Region, $Pokemon_Region, $Level, $Level_Met, $Gender, $Type1, $Type2, $Nature, $Pokeball, $Held_Item, $Perfect_IVs);
			if ($statement->fetch())
			{
				$this->pokemons [] = new Pokemon($Trade_ID, $Pokemon_Name, $Trainer_Region, $Pokemon_Region, $Level, $Level_Met, $Gender, $Type1, $Type2, $Nature, $Pokeball, $Held_Item, $Perfect_IVs);
				return new Pokemon($Trade_ID, $Pokemon_Name, $Trainer_Region, $Pokemon_Region, $Level, $Level_Met, $Gender, $Type1, $Type2, $Nature, $Pokeball, $Held_Item, $Perfect_IVs);
			}
			else
			{
				return null;
			}
			$statement->close();
			$connection->close();
		}
	}	

	private function getPokemonByPokemon_Name($name)//fix up for pokemon
    {
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;
		
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$query = "select Trade_ID, Pokemon_Name, Trainer_Region, Pokemon_Region, Level, Level_Met, Gender, Type1, Type2, Nature, Pokeball, Held_Item, Perfect_IVs from TRADES where Pokemon_Name = ?";
			$statement = $connection->prepare($query);
			$statement->bind_param('s', $name);
			$statement->execute();
			$statement->store_result();
			$statement->bind_result($Trade_ID, $Pokemon_Name, $Trainer_Region, $Pokemon_Region, $Level, $Level_Met, $Gender, $Type1, $Type2, $Nature, $Pokeball, $Held_Item, $Perfect_IVs);
			while ($statement->fetch())
			{
				$this->pokemons [] =  new Pokemon($Trade_ID, $Pokemon_Name, $Trainer_Region, $Pokemon_Region, $Level, $Level_Met, $Gender, $Type1, $Type2, $Nature, $Pokeball, $Held_Item, $Perfect_IVs);
			}
			$statement->close();
			$connection->close();
		}
	}	

    private function getPokemonByType($Type1, $Type2)
    {
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;
	
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			$query = "select Trade_ID, Pokemon_Name, Trainer_Region, Pokemon_Region, Level, Level_Met, Gender, Type1, Type2, Nature, Pokeball, Held_Item, Perfect_IVs from TRADES where Type1 = ? AND Type2 = ?";
			$statement = $connection->prepare($query);
			$statement->bind_param('ss', $Type1, $Type2);
			$statement->execute();
			$statement->store_result();
			$statement->bind_result($Trade_ID, $Pokemon_Name, $Trainer_Region, $Pokemon_Region, $Level, $Level_Met, $Gender, $Type1, $Type2, $Nature, $Pokeball, $Held_Item, $Perfect_IVs);
			while ($statement->fetch())
			{
				$this->pokemons[] = new Pokemon($Trade_ID, $Pokemon_Name, $Trainer_Region, $Pokemon_Region, $Level, $Level_Met, $Gender, $Type1, $Type2, $Nature, $Pokeball, $Held_Item, $Perfect_IVs);
			}
			$statement->close();
			$connection->close();
		}
	}	 

    private function getPokemonByLevel($Level, $Level_Met)//fix up for level
    {
		global $dbserver, $dbusername, $dbpassword, $dbdatabase;
	
		$connection = new mysqli($dbserver, $dbusername, $dbpassword, $dbdatabase);
		if (!$connection->connect_error)
		{
			if($Level> $Level_Met)//assume Level_Met is 0 if it's not the focus
			{
				$query = "select Trade_ID, Pokemon_Name, Trainer_Region, Pokemon_Region, Level, Level_Met, Gender, Type1, Type2, Nature, Pokeball, Held_Item, Perfect_IVs from TRADES where Level = ?";
				$statement = $connection->prepare($query);
				$statement->bind_param('i', $Level);
			}
			else
			{
				$query = "select Trade_ID, Pokemon_Name, Trainer_Region, Pokemon_Region, Level, Level_Met, Gender, Type1, Type2, Nature, Pokeball, Held_Item, Perfect_IVs from TRADES where Level_Met = ?";
				$statement = $connection->prepare($query);
				$statement->bind_param('i', $Level_Met);
			}

			$statement->execute();
			$statement->store_result();
			$statement->bind_result($Trade_ID, $Pokemon_Name, $Trainer_Region, $Pokemon_Region, $Level, $Level_Met, $Gender, $Type1, $Type2, $Nature, $Pokeball, $Held_Item, $Perfect_IVs);
			while ($statement->fetch())
			{
				$this->pokemons[] = new Pokemon($Trade_ID, $Pokemon_Name, $Trainer_Region, $Pokemon_Region, $Level, $Level_Met, $Gender, $Type1, $Type2, $Nature, $Pokeball, $Held_Item, $Perfect_IVs);
			}
			$statement->close();
			$connection->close();
		}
	}	

    private function extractPokemonFromJSON($requestBody)
    {
		// This function is needed because of the perculiar way json_decode works. 
		// By default, it will decode an object into a object of type stdClass.  There is no
		// way in PHP of casting a stdClass object to another object type.  So we use the
		// approach of decoding the JSON into an associative array (that's what the second
		// parameter set to true means in the call to json_decode). Then we create a new
		// Book object using the elements of the associative array.  Note that we are not
		// doing any error checking here to ensure that all of the items needed to create a new
		// book object are provided in the JSON - we really should be.
		$pokemonArray = json_decode($requestBody, true);
		$pokemon = new Pokemon($pokemonArray["Trade_ID"], 
								$pokemonArray["Pokemon_Name"], 
								$pokemonArray["Trainer_Region"], 
								$pokemonArray["Pokemon_Region"], 
								$pokemonArray["Level"], 
								$pokemonArray["Level_Met"], 
								$pokemonArray["Gender"], 
								$pokemonArray["Type1"], 
								$pokemonArray["Type2"], 
								$pokemonArray["Nature"],
								$pokemonArray["Pokeball"], 
								$pokemonArray["Held_Item"], 
								$pokemonArray["Perfect_IVs"]);
		unset($pokemonArray);
		return $pokemon;
	}
}
?>
