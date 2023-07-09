<?php
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
				"Fairy"
			);
    echo "<ul>";
    $word = $_GET["word"];
	$i = 0;
	while ($i < count($pokes))
	{
		$suggestion = $pokes[$i];
		if (stripos($suggestion, $word) !== FALSE)
		{
   			echo '<li onClick="fillT1(\''.$suggestion.'\');">'.$suggestion.'</li>';
		}
		$i++;
	}
    echo "</ul>";
?>