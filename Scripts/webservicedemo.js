// jQuery functions to manipulate the main page and handle communication with
// the books web service via Ajax.
//
// Note that there is very little error handling in this file.  In particular, there
// is no validation in the handling of form data.  This is to avoid obscuring the 
// core concepts that the demo is supposed to show.

function getAllPokemon()
{
    $.ajax({
        url: '/WTVIS/pokemons',
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createPokemonsTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

function getPokemonByID(Trade_ID)
{
    $.ajax({
        url: '/WTVIS/pokemons/' + Trade_ID,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createPokemonsTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

function getPokemonByPokemon_Name(name)
{
    $.ajax({
        url: '/WTVIS/pokemons/' + name,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createPokemonsTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

function getPokemonByType(Type1, Type2)
{
	$.ajax({
        url: '/WTVIS/pokemons/' + Type1 + '/' + Type2,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createPokemonsTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

function getPokemonByLevel(Level, Level_Met)
{
	$.ajax({
        url: '/WTVIS/pokemons/' + Level + '/' + Level_Met,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createPokemonsTable(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

function addPokemon()
{
    var pkmn = {
		Trade_ID: 0,
        Pokemon_Name: $('#PokemonName').val(),
        Trainer_Region: $('#TrainerRegion').val(),
        Pokemon_Region: $('#PokemonRegion').val(),
        Level: $('#Lvl').val(),
        Level_Met: $('#LevelMet').val(),
		Gender: $('#Gen').val(),
		Type1: $('#Type_1').val(),
		Type2: $('#Type_2').val(),
		Nature: $('#Nat').val(),
		Pokeball: $('#ball').val(),
		Held_Item: $('#HeldItem').val(),
		Perfect_IVs: $('#PerfectIVs').val()
    };

    $.ajax({
        url: '/WTVIS/pokemons',
        type: 'POST',
        data: JSON.stringify(pkmn),
        contentType: "application/json;charset=utf-8",
        success: function (data) {
            getAllPokemon();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
    $("#newPokemonform").html("");
}

function cancelChangePokemon()
{
    $("#newPokemonform").html("");
}

function editPokemon(Trade_ID)
{
    $.ajax({
        url: '/WTVIS/pokemons/' + Trade_ID,
        type: 'GET',
        cache: false,
        dataType: 'json',
        success: function (data) {
            createEditPokemonForm(data);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

function editPokemonValues(Trade_ID)
{
    var pkmn = {
        Trade_ID: TradeID,
		Pokemon_Name: $('#PokemonName').val(),
        Trainer_Region: $('#TrainerRegion').val(),
        Pokemon_Region: $('#PokemonRegion').val(),
        Level: $('#Lvl').val(),
        Level_Met: $('#LevelMet').val(),
		Gender: $('#Gen').val(),
		Type1: $('#Type_1').val(),
		Type2: $('#Type_2').val(),
		Nature: $('#Nat').val(),
		Pokeball: $('#ball').val(),
		Held_Item: $('#HeldItem').val(),
		Perfect_IVs: $('#PerfectIVs').val()
    };

    $.ajax({
        url: '/WTVIS/pokemons',
        type: 'PUT',
        data: JSON.stringify(pkmn),
        contentType: "application/json;charset=utf-8",
        success: function (data) {
            getAllPokemon();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
    $("#newPokemonform").html("");

}

function deletePokemon(TradeID)
{
    $.ajax({
        url: '/WTVIS/pokemons/' + TradeID,
        type: 'DELETE',
        dataType: 'json',
        success: function (data) {
            getAllPokemon();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
        }
    });
}

function createPokemonsTable(pkmns)
{
	//CreateDistribution(pkmns);
	
    var strResult = '<div class="col-md-12">' + 
                    '<table class="table table-bordered table-hover">' +
                    '<thead>' +
                    '<tr>' +
                    '<th>Pokemon</th>' +
                    '<th>Trainer Region</th>' +
                    '<th>Pokemon Region</th>' +
					'<th>Level</th>' +
					'<th>Level Met</th>' +
					'<th>Gender</th>' +
					'<th>Type1</th>' +
					'<th>Type2</th>' +
					'<th>Nature</th>' +
					'<th>Pokeball</th>' +
					'<th>Held Item</th>' +
					'<th>Perfect IVs</th>' +
                    '<th>&nbsp;</th>' +
                    '<th>&nbsp;</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
    $.each(pkmns, function (index, pkmn) 
    {                        
        strResult += "<tr><td>" + pkmn.Pokemon_Name + "</td><td> " + pkmn.Trainer_Region + "</td><td>" + pkmn.Pokemon_Region + "</td><td>" + pkmn.Level + "</td><td>" + pkmn.Level_Met + "</td><td>" + pkmn.Gender + "</td><td>" + pkmn.Type1 + "</td><td>" + pkmn.Type2 + "</td><td>" + pkmn.Nature + "</td><td>" + pkmn.Pokeball + "</td><td>" + pkmn.Held_Item + "</td><td>" + pkmn.Perfect_IVs + "</td><td>";
        strResult += '<input type="button" value="Edit Pokemon" class="btn btn-sm btn-primary" onclick="editPokemon(' + pkmn.Trade_ID + ');" />';
        strResult += '</td><td>';
        strResult += '<input type="button" value="Delete Pokemon" class="btn btn-sm btn-primary" onclick="deletePokemon(' + pkmn.Trade_ID + ');" />';
        strResult += "</td></tr>";
    });
    strResult += "</tbody></table>";
	
	CreateDistribution(pkmns);
	
    $("#tablebox").html(strResult);
	
}

function createNewPokemonForm()
{
    var strResult = '<div class="col-md-12">';
    strResult += '<form class="form-horizontal" role="form">';
    strResult += '<div class="form-group"><label for="pkmnname" class="col-md-3 control-label">Pokemon Name</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnname"></div></div>';
	strResult += '<div class="form-group"><label for="trainerregion" class="col-md-3 control-label">Trainer Region</label><div class="col-md-9"><input type="text" class="form-control" id="trainerregion"></div></div>';
	strResult += '<div class="form-group"><label for="pkmnregion" class="col-md-3 control-label">Pokemon Region</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnregion"></div></div>';
	strResult += '<div class="form-group"><label for="pkmnLevel" class="col-md-3 control-label">Level</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnLevel"></div></div>';
	strResult += '<div class="form-group"><label for="pkmnLevelMet" class="col-md-3 control-label">LevelMet</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnLevelMet"></div></div>';
	strResult += '<div class="form-group"><label for="pkmnGender" class="col-md-3 control-label">Gender</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnGender"></div></div>';
	strResult += '<div class="form-group"><label for="pkmnType1" class="col-md-3 control-label">Type1</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnType1"></div></div>';
	strResult += '<div class="form-group"><label for="pkmnType2" class="col-md-3 control-label">Type2</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnType2"></div></div>';
	strResult += '<div class="form-group"><label for="pkmnNature" class="col-md-3 control-label">Nature</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnNature"></div></div>';
	strResult += '<div class="form-group"><label for="pkmnPokeball" class="col-md-3 control-label">Pokeball</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnPokeball"></div></div>';
	strResult += '<div class="form-group"><label for="pkmnHeldItem" class="col-md-3 control-label">Held_Item</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnHeldItem"></div></div>';
	strResult += '<div class="form-group"><label for="pkmnPerfectIVs" class="col-md-3 control-label">Perfect_IVs</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnPerfectIVs"></div></div>';
    strResult += '<div class="form-group"><div class="col-md-offset-3 col-md-9"><input type="button" value="Add Pokemon" class="btn btn-sm btn-primary" onclick="addPokemon();" />&nbsp;&nbsp;<input type="button" value="Cancel" class="btn btn-sm btn-primary" onclick="cancelChangePokemon();" /></div></div>';
    strResult += '</form></div>';
    $("#newPokemonform").html(strResult);
}

function createEditPokemonForm(pkmn)
{
	var strResult = '<div class="col-md-12">';
    strResult += '<form class="form-horizontal" role="form">';
    strResult += '<div class="form-group"><label for="pkmnname" class="col-md-3 control-label">Pokemon Name</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnname" value="' + pkmn.Pokemon_Name + '" ></div></div>';
	strResult += '<div class="form-group"><label for="trainerregion" class="col-md-3 control-label">Trainer Region</label><div class="col-md-9"><input type="text" class="form-control" id="trainerregion" value="' + pkmn.Trainer_Region + '" ></div></div>';
	strResult += '<div class="form-group"><label for="pkmnregion" class="col-md-3 control-label">Pokemon Region</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnregion" value="' + pkmn.Pokemon_Region + '" ></div></div>';
	strResult += '<div class="form-group"><label for="pkmnLevel" class="col-md-3 control-label">Level</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnLevel" value="' + pkmn.Level + '" ></div></div>';
	strResult += '<div class="form-group"><label for="pkmnLevelMet" class="col-md-3 control-label">LevelMet</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnLevelMet" value="' + pkmn.Level_Met + '" ></div></div>';
	strResult += '<div class="form-group"><label for="pkmnGender" class="col-md-3 control-label">Gender</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnGender" value="' + pkmn.Gender + '" ></div></div>';
	strResult += '<div class="form-group"><label for="pkmnType1" class="col-md-3 control-label">Type1</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnType1" value="' + pkmn.Type1 + '" ></div></div>';
	strResult += '<div class="form-group"><label for="pkmnType2" class="col-md-3 control-label">Type2</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnType2" value="' + pkmn.Type2 + '" ></div></div>';
	strResult += '<div class="form-group"><label for="pkmnNature" class="col-md-3 control-label">Nature</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnNature" value="' + pkmn.Nature + '" ></div></div>';
	strResult += '<div class="form-group"><label for="pkmnPokeball" class="col-md-3 control-label">Pokeball</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnPokeball" value="' + pkmn.Pokeball + '" ></div></div>';
	strResult += '<div class="form-group"><label for="pkmnHeldItem" class="col-md-3 control-label">Held_Item</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnHeldItem" value="' + pkmn.Held_Item + '" ></div></div>';
	strResult += '<div class="form-group"><label for="pkmnPerfectIVs" class="col-md-3 control-label">Perfect_IVs</label><div class="col-md-9"><input type="text" class="form-control" id="pkmnPerfectIVs" value="' + pkmn.Perfect_IVs + '" ></div></div>';
    strResult += '<div class="form-group"><div class="col-md-offset-3 col-md-9"><input type="button" value="Edit Pokemon" class="btn btn-sm btn-primary" onclick="editPokemonValues(' + pkmn.Trade_ID + ');" />&nbsp;&nbsp;<input type="button" value="Cancel" class="btn btn-sm btn-primary" onclick="cancelChangePokemon();" /></div></div>';
    strResult += '</form></div>';
    $("#newPokemonform").html(strResult);
}

function CreateDistribution(pkmns)
{
	$("#nameDensity").html('<p> hi </p>');//test to see if it calls 1

	var Textsize = 10;
	var SizeResult = 0;
	var strResult = '<p>';
	
	
	//alert (strval(pkmns.first()));
	$.each(pkmns, function (index, pkmn) 
		{
			//query how many times a pokemon shows up
			
			//TODO: CALL COUNT QUERY
			//TODO: Put result of the count from the query into SizeResult
			$.ajax({
				url: '/WTVIS/GetCount.php',
				type: 'POST',
				cache: false,
				//dataType: 'json',
				data: {'name': pkmn.Pokemon_Name},
				success: function (data) {
            
					
					//SizeResult = data;
					//Textsize = 10 + SizeResult;
					tempsize = Textsize + parseInt(data);
					strResult = $("#nameDensity").html();
					//print the name, setting font size to normal + number of times name shows up.
					strResult += "<span style =\"font-size:"+tempsize+"px\">"+pkmn.Pokemon_Name+"</span>";
					
					if(parseInt(pkmn.Trade_ID)%10 == 9)
					{
						strResult += "</p><p>";
					}
					
					$("#nameDensity").html(strResult);
			
				},
				error: function (jqXHR, textStatus, errorThrown) {
				alert(jqXHR + '\n' + textStatus + '\n' + errorThrown);
				}
			});
			
		});
		
		//puts the new visulisaed data in its box.
		strResult += '</p>';
		$("#nameDensity").html(strResult);
		
}