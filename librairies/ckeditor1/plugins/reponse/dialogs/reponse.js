/*
	Gros copier coller du fichier plugin.js du plugin "basicstyles"
*/
 
CKEDITOR.plugins.add( 'reponse',
{
	requires : [ 'styles', 'button' ],
 
	init : function( editor )
	{
		// All buttons use the same code to register. So, to avoid
		// duplications, let's use this tool function.
		var addButtonCommand = function( buttonName, buttonLabel, commandName, styleDefiniton, iconSrc )
		{
			var style = new CKEDITOR.style( styleDefiniton );
 
			editor.attachStyleStateChange( style, function( state )
				{
					editor.getCommand( commandName ).setState( state );
				});
 
			editor.addCommand( commandName, new CKEDITOR.styleCommand( style ) );
 
			editor.ui.addButton( buttonName,
				{
					label : buttonLabel,
					command : commandName,
					icon : iconSrc
				});
		};
 
		var config = editor.config,
			pluginName = 'reponse';
 
		addButtonCommand('Player'	, 'Idalgo - Joueur'	, 'idalgo_player_click'	, config.coreStyles_idalgo_player,	CKEDITOR.plugins.getPath(pluginName) + 'images/icon-idalgo-joueur.png');
		addButtonCommand('Team'		, 'Idalgo - Equipe'	, 'idalgo_team_click'	, config.coreStyles_idalgo_team,	CKEDITOR.plugins.getPath(pluginName) + 'images/icon-idalgo-equipe.png');
		// addButtonCommand('Widget'	, 'Idalgo - Widget'	, 'idalgo_widget_click'	, config.coreStyles_idalgo_widget,	CKEDITOR.plugins.getPath(pluginName) + 'images/icon-idalgo-joueur.png');
		// addButtonCommand('Sound'	, 'Son'				, 'ftv_sound_click'		, config.coreStyles_ftv_sound,		CKEDITOR.plugins.getPath(pluginName) + 'images/icon-idalgo-joueur.png');
		// addButtonCommand('Video'	, 'Vidéo'			, 'cappu_video_click'	, config.coreStyles_cappu_video,		CKEDITOR.plugins.getPath(pluginName) + 'images/icon-idalgo-joueur.png');
	}
});
 
// Basic Inline Styles.
 
/**
 * Définition du style d'un lien vers une fiche joueur
 */
CKEDITOR.config.coreStyles_idalgo_player = {
	element		: 'a',
	attributes	: {
		'href' :	'#',
		'class' :	'idalgo_player'
	}
};
 
/**
 * Définition du style d'un lien vers une fiche équipe
 */
CKEDITOR.config.coreStyles_idalgo_team = {
	element		: 'a',
	attributes	: {
		'href' :	'#',
		'class' :	'idalgo_team'
	}
};