# Plugin FCK Editor for SPIP 1.9.2

Add FCK Editor as an extension to SPIP admin

This project is given "as it". The included CKEditor version is outdated.

Consider this repository as learning resource. Don't use without upgrading and testing its content !

Version 1.3 - 2008-09-22

(c) Patrick Prémartin / Olf Software 2007

## Dependencies

* SPIP 1.9.2, https://www.spip.net/
* FCKeditor 2.4.2, https://ckeditor.com/

## How to install and use ?

**A faire pour installer ce plugin dans une version 1.9.2 (et ultérieure ?) de SPIP**

* dans le dossier des images de SPIP (ou dans un dossier /userfiles), créer les sous-dossiers Image, Flash, Media, File
* leur mettre les droits en 757 (si safe_mode activé)
* personnaliser les fichiers config.php et config.js dans /user-config du plugin
* aller dans la configuration de SPIP / gestion des plugins et activer ce plugin

## Change log

**Modifications apportées à la version 2.4.2 de FCK Editor**

* correction du bogue concernant la casse des sous-dossiers de "userfiles" dans le gestionnaire de fichiers
* configuration du connecteur du gestionnaire de fichier pour pointer dans le bon dossier (défini dans user-config/config.js)
* configuration du programme d'upload pour pointer dans le bon dossier (défini dans user-config/config.js)
* ajout des plugins Acronym, Quote et Language
* Modification du fichier de langue française, "normal" ayant été remplacé par "paragraphe" pour le styles du texte.
