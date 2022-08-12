/*
* Plugin for FCKeditor : add acronym HTML tag
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
 * 	Plugin for <acronym> HTML tag, add a button and an editor
 * 
 * File Authors:
 * 		Patrick Premartin => http://patrick.premartin.nom.fr/
 *		Alain Gravelet => http://gravelet-multimedia.com/
 */

// Register the related command.
FCKCommands.RegisterCommand( 'Acronym', new FCKDialogCommand( 'Acronym', FCKLang.AcronymDlgTitle, FCKConfig.PluginsPath + 'acronym/fck_acronym.html', 340, 200 ) ) ;

// Create the "Acronym" toolbar button.
var oAcronymItem = new FCKToolbarButton( 'Acronym', FCKLang.AcronymBtn ) ;
oAcronymItem.IconPath = FCKConfig.PluginsPath + 'acronym/button.gif' ;
FCKToolbarItems.RegisterItem( 'Acronym', oAcronymItem ) ;