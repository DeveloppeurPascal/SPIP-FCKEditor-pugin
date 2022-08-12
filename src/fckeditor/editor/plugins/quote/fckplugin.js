/*
* Plugin for FCKeditor : add quote HTML tag
 * Copyright (C) 2007 Patrick Premartin / Olf Software
 * 
 * Licensed under the terms of the GNU Lesser General Public License:
 * 		http://www.opensource.org/licenses/lgpl-license.php
 * 
 * For further information visit:
 * 		http://www.olfsoftware.fr/
 * 		http://www.fckeditor.net/
 * 
 * File Name: fckplugins.js
 * 	Plugin for <q> HTML tag, add a button and an editor
 * 
 * File Authors:
 * 		Patrick Premartin => http://patrick.premartin.nom.fr/
 *		Alain Gravelet => http://gravelet-multimedia.com/
 */

// Register the related command.
FCKCommands.RegisterCommand( 'Quote', new FCKDialogCommand( 'Quote', FCKLang.QuoteDlgTitle, FCKConfig.PluginsPath + 'quote/fck_quote.html', 340, 200 ) ) ;

// Create the "Quote" toolbar button.
var oQuoteItem = new FCKToolbarButton( 'Quote', FCKLang.QuoteBtn ) ;
oQuoteItem.IconPath = FCKConfig.PluginsPath + 'quote/button.gif' ;
FCKToolbarItems.RegisterItem( 'Quote', oQuoteItem ) ;