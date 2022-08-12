/*
 * FCKeditor - The text editor for internet
 * Copyright (C) 2003-2005 Frederico Caldeira Knabben
 * 
 * Licensed under the terms of the GNU Lesser General Public License:
 * 		http://www.opensource.org/licenses/lgpl-license.php
 * 
 * For further information visit:
 * 		http://www.fckeditor.net/
 * 
 * File Name: fckplugin.js
 * 	Plugin to insert "Language" in the editor.
 * 
 * File Authors:
 * 		Patrick Prémartin (Olf Software) (patrick.premartin@olfsoft.com)
 */

// Register the related command.
FCKCommands.RegisterCommand( 'Language', new FCKDialogCommand( 'Language', FCKLang.LanguageDlgTitle, FCKConfig.PluginsPath + 'language/fck_language.html', 340, 170 ) ) ;

// Create the "Language" toolbar button.
var oLanguageItem = new FCKToolbarButton( 'Language', FCKLang.LanguageBtn ) ;
oLanguageItem.IconPath = FCKConfig.PluginsPath + 'language/button.gif' ;
FCKToolbarItems.RegisterItem( 'Language', oLanguageItem ) ;