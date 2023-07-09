var XMLHttpRequestObject = false;
window.onload = getXMLHttpObject;
function getXMLHttpObject()
{
	if (window.XMLHttpRequest)
	{
		XMLHttpRequestObject = new XMLHttpRequest();
	}
	else
	{
		XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
	}
}

function lookup(instring)
{
	var suggestion = document.getElementById("suggestionsT2");
	if(instring.length == 0 || !XMLHttpRequestObject)
	{
		suggestion.setAttribute("style","display:none;");
	}
	else
	{
		XMLHttpRequestObject.open("GET", "boxsuggest.php?word=" + instring);
        XMLHttpRequestObject.onreadystatechange = displaySuggestionsT2;//
        XMLHttpRequestObject.send(null);
	}
}

function fill(value)
{
	var itemIn = document.getElementById("type2Input");
	itemIn.value = value;
	var sug = document.getElementById("autoSuggestionsListT2");
	sug.setAttribute("style","display:none;");
}

function displaySuggestionsT2()
{
    if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
    {
        // Everything has completed successfully so use the text returned by the request
        // to update the contents of the target div.
        var obj = document.getElementById("autoSuggestionsListT2");
        obj.innerHTML = XMLHttpRequestObject.responseText;//
        var suggestions = document.getElementById("suggestionsT2");
        suggestions.setAttribute("style", "display:block;");
	}
}
//Type1 version:
function lookupT1(instring)
{
	var suggestion = document.getElementById("suggestionsT1");
	if(instring.length == 0 || !XMLHttpRequestObject)
	{
		suggestion.setAttribute("style","display:none;");
	}
	else
	{
		XMLHttpRequestObject.open("GET", "boxsuggestT1.php?word=" + instring);
        XMLHttpRequestObject.onreadystatechange = displaySuggestionsT1;//
        XMLHttpRequestObject.send(null);
	}
}

function fillT1(value)
{
	var itemIn = document.getElementById("type1Input");
	itemIn.value = value;
	var sug = document.getElementById("autoSuggestionsListT1");
	sug.setAttribute("style","display:none;");
}

function displaySuggestionsT1()
{
    if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
    {
        // Everything has completed successfully so use the text returned by the request
        // to update the contents of the target div.
        var obj = document.getElementById("autoSuggestionsListT1");
        obj.innerHTML = XMLHttpRequestObject.responseText;//
        var suggestions = document.getElementById("suggestionsT1");
        suggestions.setAttribute("style", "display:block;");
	}
}

//name version:
function lookupName(instring)
{
	var suggestion = document.getElementById("suggestionsName");
	if(instring.length == 0 || !XMLHttpRequestObject)
	{
		suggestion.setAttribute("style","display:none;");
	}
	else
	{
		XMLHttpRequestObject.open("GET", "nameboxsuggest.php?word=" + instring);
        XMLHttpRequestObject.onreadystatechange = displaySuggestionsName;
        XMLHttpRequestObject.send(null);
	}
}

function fillName(value)
{
	var itemIn = document.getElementById("userSeletion");
	itemIn.value = value;
	var sug = document.getElementById("autoSuggestionsListName");
	sug.setAttribute("style","display:none;");
}

function displaySuggestionsName()
{
    if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200)
    {
        // Everything has completed successfully so use the text returned by the request
        // to update the contents of the target div.
        var obj = document.getElementById("autoSuggestionsListName");
        obj.innerHTML = XMLHttpRequestObject.responseText;
        var suggestions = document.getElementById("suggestionsName");
        suggestions.setAttribute("style", "display:block;");
	}
}