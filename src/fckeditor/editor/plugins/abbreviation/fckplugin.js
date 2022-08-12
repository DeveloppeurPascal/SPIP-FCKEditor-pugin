/*
* Plugin for FCKeditor : add abbreviation XHTML tag
 * Copyright (C) 2005-2007 Patrick Premartin / Olf Software
 * 
 * Licensed under the terms of the GNU Lesser General Public License:
 * 		http://www.opensource.org/licenses/lgpl-license.php
 * 
 * For further information visit:
 * 		http://www.olfsoftware.fr/
 * 		http://www.fckeditor.net/
 * 
 * File Name: fckplugins.js
 * 	Plugin for <Abbreviation> HTML tag, add a button and an editor
 * 
 * File Authors:
 * 		Patrick Premartin => http://patrick.premartin.nom.fr/
 *		Alain Gravelet => http://gravelet-multimedia.com/
 */

// Register the related command.
FCKCommands.RegisterCommand( 'Abbreviation', new FCKDialogCommand( 'Abbreviation', FCKLang.AbbreviationDlgTitle, FCKConfig.PluginsPath + 'abbreviation/fck_abbreviation.html', 340, 200 ) ) ;

// Create the "Abbreviation" toolbar button.
var oAbbreviationItem = new FCKToolbarButton( 'Abbreviation', FCKLang.AbbreviationBtn ) ;
oAbbreviationItem.IconPath = FCKConfig.PluginsPath + 'abbreviation/button.gif' ;
FCKToolbarItems.RegisterItem( 'Abbreviation', oAbbreviationItem ) ;