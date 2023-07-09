<?php
	//require
	require "dbinfo.php";
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<META name = "author" content = "100511480">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="Scripts/jquery-1.10.2.min.js"></script>
    <script src="Scripts/bootstrap.min.js"></script>
    <script src="Scripts/webservicedemo.js"></script>
	<script src="Scripts/sugestionboxjavascripts.js"></script>
	<script src="Scripts/modernizr-2.6.2.js"></script>
	<link rel="StyleSheet" href="mainstyle.css" type="text/css">
	<h1> Wonder Trades Visulisation </h1>
</head>

<body>

<div id = "infotext">
<p>This visulisation conatins the results of 500 wonder trades in Pokemon Sun and moon</p>

<p> Enter a value into a box and press the button next to the box for the data to display 
</br> Type needs both fileds to be filled.</p>

</div>
</br>
<div id = buttons>
	<input type="button" value="Get All Pokemon" class="btn btn-sm btn-primary" onclick="getAllPokemon();" />

<p>
	What Pokemon do you want to see?
	<input type="text" size ="30" value="" id="userSeletion" onkeyup="lookupName(this.value)"/>
	<input type = "button" name = "submitMon" value ="GO!" class="btn btn-sm btn-primary" onclick = "getPokemonByPokemon_Name(userSeletion.value);"/>
	<div class="suggestionsBoxName" id="suggestionsName" style="display: none;">
		<div class="suggestionListName" id="autoSuggestionsListName">
			&nbsp;
		</div>
	</div>
	
</p>
<p>
	Type:<input type="text" size ="30" value="" id="type1Input" onkeyup="lookupT1(this.value);"/>
	<input type="text" size ="30" value="NA" id="type2Input" onkeyup="lookup(this.value);"/>
	<input type="button" value="GO!" class="btn btn-sm btn-primary" onclick="getPokemonByType(type1Input.value, type2Input.value);" />
		<div class="suggestionsBoxT1" id="suggestionsT1" style="display: none;">
		<div class="suggestionListT1" id="autoSuggestionsListT1">
			&nbsp;
		</div>
	</div>
	<div class="suggestionsBoxT2" id="suggestionsT2" style="display: none;">
		<div class="suggestionListT2" id="autoSuggestionsListT2">
			&nbsp;
		</div>
	</div>
	
</p>

<p>
	Level:<input type="text" size ="30" value="" id="LvInput"/>
	<input type="button" value="GO!" class="btn btn-sm btn-primary" onclick="getPokemonByLevel(LvInput.value, 0);" />
</p>

<p>
	Level Met:<input type="text" size ="30" value="" id="LvMetInput"/>
	<input type="button" value="GO!" class="btn btn-sm btn-primary" onclick="getPokemonByLevel(0, LvMetInput.value);" />
</p>

<p>
	Want to see a specific trade? Trade ID:<input type="text" size ="30" value="" id="idInput"/>
	<input type="button" value="GO!" class="btn btn-sm btn-primary" onclick="getPokemonByID(idInput.value);" />
</p>

</div>

<div class = "nameDensity" id = "nameDensity">
	&nbsp;
</div>

<div class = "tablebox" id = "tablebox">
	&nbsp;
</div>

<div class = "newPokemonform" id = "newPokemonform">
	&nbsp;
</div>

</body>

</html>