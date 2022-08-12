<?php
	// Plugin FCK Editor pour SPIP
	// (c) Patrick Prémartin
	// (c) Olf Software
	// Suivi des modifications:
	//	19/04/2007, pprem : création du plugin
	//	20/04/2007, pprem : gestion de plusieurs barres par page en modifiant la gestion du windows.onload permettant de les activer
	//	20/04/2007, pprem : gestion de fichiers de configuration par défaut (user-config/config.*.dist) pris en compte si l'utilisateur ne les personnalise pas
	//	29/02/2008, pprem : adaptation du fichier pour le plugin
	//	22/09/2008, pprem : modifications liées à l'affichage sur les forums externes

if (!defined("_ECRIRE_INC_VERSION")) return;

// début modif pour plugin OlfSoftware
	if (file_exists (dirname(__FILE__)."/../user-config/config.php")) {
		require_once(dirname(__FILE__)."/../user-config/config.php");
	} else {
		require_once(dirname(__FILE__)."/../user-config/config.php.dist");
	}
	require_once(dirname(__FILE__)."/../fckeditor/fckeditor.php");
// fin modif pour plugin OlfSoftware

// construit un bouton (ancre) de raccourci avec icone et aide

// http://doc.spip.org/@bouton_barre_racc
function bouton_barre_racc($action, $img, $help, $champhelp) {

	$a = attribut_html($help);
	return "<a\nhref=\"javascript:"
		.$action
		."\" tabindex='1000'\ntitle=\""
		. $a
		."\"" 
		.(!_DIR_RESTREINT ? '' :  "\nonmouseover=\"helpline('"
		  .addslashes($a)
		  ."',$champhelp)\"\nonmouseout=\"helpline('"
		  .attribut_html(_T('barre_aide'))
		  ."', $champhelp)\"")
		."><img\nsrc='"
		._DIR_IMG_ICONES_BARRE
		.$img
		."' style=\"height: 16px; width: 16px; background-position: center center;\" alt=\"$a\"/></a>";
}

// construit un tableau de raccourcis pour un noeud de DOM 

// http://doc.spip.org/@afficher_barre
function afficher_barre($champ, $forum=false, $lang='') {
// début modif pour plugin OlfSoftware
/*
	global $spip_lang, $spip_lang_right, $spip_lang_left, $spip_lang;
	static $num_barre = 0;
	include_spip('inc/layer');
	if (!$GLOBALS['browser_barre']) return '';
	if (!$lang) $lang = $spip_lang;
	$num_barre++;
	$champhelp = "document.getElementById('barre_$num_barre')";

	$ret = ($num_barre > 1)  ? '' :
	  '<script type="text/javascript" src="' . _DIR_JAVASCRIPT . 'spip_barre.js"></script>';
	$ret .= "<table class='spip_barre' cellpadding='0' cellspacing='0' border='0'>";
	$ret .= "\n<tr>";
	$ret .= "\n<td style='text-align: $spip_lang_left;' valign='middle'>";
	$col = 1;

	// Italique, gras, intertitres
	$ret .= bouton_barre_racc ("barre_raccourci('{','}',$champ)", "italique.png", _T('barre_italic'), $champhelp);
	$ret .= bouton_barre_racc ("barre_raccourci('{{','}}',$champ)", "gras.png", _T('barre_gras'), $champhelp);
	if (!$forum) {
		$ret .= bouton_barre_racc ("barre_raccourci('\n\n{{{','}}}\n\n',$champ)", "intertitre.png", _T('barre_intertitre'), $champhelp);
	}
	$ret .= "</td>\n<td>";
	$col ++;

	// Lien hypertexte, notes de bas de page, citations
	$js = addslashes(_T('barre_lien_input'));
	$ret .= bouton_barre_racc ("barre_demande('[','->',']', '$js', $champ)",
		"lien.png", _T('barre_lien'), $champhelp);
	if (!$forum) {
		$ret .= bouton_barre_racc ("barre_raccourci('[[',']]',$champ)", "notes.png", _T('barre_note'), $champhelp);
	} else {
		$col ++;
		$ret .= "</td>\n<td>"
		  . bouton_barre_racc ("barre_raccourci('\n\n&lt;quote&gt;','&lt;/quote&gt;\n\n',$champ)", "quote.png", _T('barre_quote'), $champhelp);
	}

	$ret .= "</td>";
	$col++;

	// Insertion de caracteres difficiles a taper au clavier (guillemets, majuscules accentuees...)
	$ret .= "\n<td style='text-align:$spip_lang_left;' valign='middle'>";
		$col++;
	if ($lang == "fr" OR $lang == "eo" OR $lang == "cpf" OR $lang == "ar" OR $lang == "es") {
		$ret .= bouton_barre_racc ("barre_raccourci('&laquo;','&raquo;',$champ)", "guillemets.png", _T('barre_guillemets'), $champhelp);
		$ret .= bouton_barre_racc ("barre_raccourci('&ldquo;','&rdquo;',$champ)", "guillemets-simples.png", _T('barre_guillemets_simples'), $champhelp);
	}
	else if ($lang == "bg" OR $lang == "de" OR $lang == "pl" OR $lang == "hr" OR $lang == "src") {
		$ret .= bouton_barre_racc ("barre_raccourci('&bdquo;','&ldquo;',$champ)", "guillemets-de.png", _T('barre_guillemets'), $champhelp);
		$ret .= bouton_barre_racc ("barre_raccourci('&sbquo;','&lsquo;',$champ)", "guillemets-uniques-de.png", _T('barre_guillemets_simples'), $champhelp);
	}
	else {
		$ret .= bouton_barre_racc ("barre_raccourci('&ldquo;','&rdquo;',$champ)", "guillemets-simples.png", _T('barre_guillemets'), $champhelp);
		$ret .= bouton_barre_racc ("barre_raccourci('&lsquo;','&rsquo;',$champ)", "guillemets-uniques.png", _T('barre_guillemets_simples'), $champhelp);
	}
	if ($lang == "fr" OR $lang == "eo" OR $lang == "cpf") {
		$ret .= bouton_barre_racc ("barre_inserer('&Agrave;',$champ)", "agrave-maj.png", _T('barre_a_accent_grave'), $champhelp);
		$ret .= bouton_barre_racc ("barre_inserer('&Eacute;',$champ)", "eacute-maj.png", _T('barre_e_accent_aigu'), $champhelp);
		if ($lang == "fr") {
			$ret .= bouton_barre_racc ("barre_inserer('&oelig;',$champ)", "oelig.png", _T('barre_eo'), $champhelp);
			$ret .= bouton_barre_racc ("barre_inserer('&OElig;',$champ)", "oelig-maj.png", _T('barre_eo_maj'), $champhelp);
		}
	}
	$ret .= bouton_barre_racc ("barre_inserer('&euro;',$champ)", "euro.png", _T('barre_euro'), $champhelp);

	$ret .= "</td>";
	$col++;

	if (!_DIR_RESTREINT) {
		$ret .= "\n<td style='text-align:$spip_lang_right;' valign='middle'>";
		$col++;
	//	$ret .= "&nbsp;&nbsp;&nbsp;";
		$ret .= aide("raccourcis");
		$ret .= "&nbsp;";
		$ret .= "</td>";
	}
	$ret .= "</tr>";

	// Sur les forums publics, petite barre d'aide en survol des icones
	if (_DIR_RESTREINT)
		$ret .= "\n<tr>\n<td colspan='$col'><input disabled='disabled' type='text' class='barre' id='barre_$num_barre' size='45' maxlength='100'\nvalue=\"".attribut_html(_T('barre_aide'))."\" /></td></tr>";

	$ret .= "</table>";

	return $ret;
*/
		$id_champ = substr(strrchr($champ,"."),1,strlen($champ));
		if (FALSE !== ($pos = strpos($id_champ,"'")))
		{
			$id_champ = substr($id_champ,$pos+1,strlen($id_champ));
			if (FALSE !== ($pos = strpos($id_champ,"'")))
			{
				$id_champ = substr($id_champ,0,$pos);
			}
		}
		$BasePath = substr(dirname(__FILE__),strlen($_SERVER["DOCUMENT_ROOT"]))."/";
		$GLOBALS["osfck_onload"] = 1+$GLOBALS["osfck_onload"]*1;
		$res = "<script type=\"text/javascript\" src=\"".$BasePath."../fckeditor/fckeditor.js\"></script>
<script type=\"text/javascript\">
	var osfck_onload".$GLOBALS["osfck_onload"]."=window.onload;
	window.onload = function() {
		var oFCKeditor = new FCKeditor('".$id_champ."');
		oFCKeditor.BasePath = '".$BasePath."../fckeditor/';
		oFCKeditor.Config['CustomConfigurationsPath']='".$BasePath."../user-config/config.js".((file_exists(dirname(__FILE__)."/../user-config/config.js"))?"":".dist")."?".time()."';";
		if ($forum) {
			$res .="oFCKeditor.ToolbarSet = '"._OSSPIPFCK_forum_toolbar."'; oFCKeditor.Width = '"._OSSPIPFCK_forum_width."'; oFCKeditor.Height = '"._OSSPIPFCK_forum_height."'; ";
		} else {
			$res .="oFCKeditor.ToolbarSet = '"._OSSPIPFCK_admin_toolbar."'; oFCKeditor.Width = '"._OSSPIPFCK_admin_width."'; oFCKeditor.Height = '"._OSSPIPFCK_admin_height."'; ";
		}
		$res .="oFCKeditor.ReplaceTextarea() ;
		if (osfck_onload".$GLOBALS["osfck_onload"].") {
			osfck_onload".$GLOBALS["osfck_onload"]."();
		}
	}
</script>";
		return $res;
// fin modif pour plugin OlfSoftware
}

// http://doc.spip.org/@afficher_textarea_barre
function afficher_textarea_barre($texte, $forum=false)
{
	global $spip_display, $spip_ecran;

	$rows = ($spip_ecran == "large") ? 28 : 15;

	return (($spip_display == 4) ? '' :
		afficher_barre('document.formulaire.texte', $forum))
	. "<textarea name='texte' id='texte' "
	. $GLOBALS['browser_caret']
	. " rows='$rows' class='formo' cols='40'>"
	. entites_html($texte)
	. "</textarea>\n";
}

?>