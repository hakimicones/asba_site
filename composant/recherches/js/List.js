$(document).ready( function () {

 
   
   $('#maTable').DataTable( {
   		"iDisplayLength": 25 ,
        "order": [ 0, 'desc' ] ,
        "columnDefs": [  
									 {
										"targets": 5,
										"orderable": false
									}   
								   ],
        "language": {
             "sProcessing":     "Traitement en cours...",
	"sSearch":         "Rechercher&nbsp;:",
    "sLengthMenu":     "Afficher _MENU_ &eacute;l&eacute;ments",
	"sInfo":           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
	"sInfoEmpty":      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
	"sInfoFiltered":   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
	"sInfoPostFix":    "",
	"sLoadingRecords": "Chargement en cours...",
    "sZeroRecords":    "Aucun &eacute;l&eacute;ment &agrave; afficher",
	"sEmptyTable":     "Aucune donn&eacute;e disponible dans le tableau",
	"oPaginate": {
		"sFirst":      "Premier",
		"sPrevious":   "Pr&eacute;c&eacute;dent",
		"sNext":       "Suivant",
		"sLast":       "Dernier"
	},
	"oAria": {
		"sSortAscending":  ": activer pour trier la colonne par ordre croissant",
		"sSortDescending": ": activer pour trier la colonne par ordre d&eacute;croissant"
	}
        }
    } );
	//
	$('#maTable_filter input').attr("placeholder","Rechercher");
	$('.paginate_button').addClass('uk-button uk-button-default');
	
	$('#maTable_length').append( '<div class="filtre_date"><a class="uk-button uk-button-default" href="#modal-dates" uk-toggle>Filtrer par date</a></div>');
	
	$("#formations").on("change",function(){
		
		
		var txt = $("#formations option:selected").text();
		
		$("#id_formation").val(txt);
		
 
		 
		$("#form1").submit();


});	
	
} );
 

function archive(id) {

 UIkit.modal.confirm('Vous allez archiver la Session N°:'+id+'?').then(function () {
               console.log('Confirmed.');
			     $('#id').val(id)
			   $('#task').val('archive');
			  $('#form1').submit();
           }, function () {
               console.log('Rejected.')
           });


} 
	
 
 
 
function sup(id)
{

 UIkit.modal.confirm('Vous allez supprimer la Formation N°:'+id+'?').then(function () {
               console.log('Confirmed.');
			     $('#id').val(id)
			   $('#task').val('del');
			  $('#form1').submit();
           }, function () {
               console.log('Rejected.')
           });
  
}
