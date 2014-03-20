 //<!
google.load('search', '1',{"language" : '<?=$_POST['Langage']?>'});

function OnLoad() {
// Create a search control
	var searchControl = new google.search.SearchControl();

	 // Add in a full set of searchers
	var localSearch = new google.search.LocalSearch();
	searchControl.addSearcher(localSearch);
	searchControl.addSearcher(new google.search.WebSearch());
	// Set the Local Search center point
	localSearch.setCenterPoint("New York, NY");                                                                                             
	// tell the searcher to draw itself and tell it where to attach
	searchControl.draw(document.getElementById("searchcontrol"));
	// execute an inital search
	searchControl.execute('<?=$_POST['search']?>');
}
google.setOnLoadCallback(OnLoad);

$('document').ready(function(){
	$('span.resultat').click(function(){
		var texte = $(this).text();
		$('#ChampRecherche').val(texte);
	});
});