<?php
/**
 *
 * Who Visited This Topic. An extension for the phpBB Forum Software package.
 * French translation by Galixte (http://www.galixte.com)
 *
 * @copyright (c) 2018 dmzx <https://www.dmzx-web.net>
 * @license GNU General Public License, version 2 (GPL-2.0-only)
 *
 */

/**
 * DO NOT CHANGE
 */
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS'				=> 'Activer la fonctionnalité « Membres ayant visité ce sujet » dans les sujets',
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS_EXPLAIN'		=> 'Permet d’afficher les membres ayant consulté un sujet, en bas de page, sur la vue des sujets.',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS'				=> 'Activer l’affichage des compteurs de vues du « Membres ayant visité ce sujet » dans les sujets',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS_EXPLAIN'		=> 'Permet d’afficher les compteurs de vues des membres ayant consulté un sujet, en bas de page, sur la vue des sujets.',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR'					=> 'Activer l’affichage des avatars des membres du « Membres ayant visité ce sujet » dans les sujets',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR_EXPLAIN'			=> 'Permet d’afficher les avatars des membres ayant consulté un sujet, en bas de page, dans la vue des sujets.',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS'			=> 'Activer l’affichage des sujets consultés par les membres dans les profils',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS_EXPLAIN'	=> 'Permet d’afficher la liste des derniers sujets consultés par les membres dans les profils.',
	'WHOVISITEDTHISTOPIC_SETTING'						=> 'Nombre maximum de membres à afficher dans le « Membres ayant visité ce sujet » dans les sujets',
	'WHOVISITEDTHISTOPIC_SETTING_EXPLAIN'				=> 'Permet de saisir le nombre maximum de membres à afficher dans le « Membres ayant visité ce sujet ». La valeur doit être comprise entre 2 et 255. <em>Par défaut définie sur 10.</em>',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING'					=> 'Nombre maximum de sujets affichés dans les profils',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING_EXPLAIN'			=> 'Permet de saisir le nombre maximum de sujets comsultés par les membres à afficher. La valeur doit être comprise entre 2 et 255. <em>Par défaut définie sur 10.</em>',
	'WHOVISITEDTHISTOPIC_DISABLED_TOPIC'				=> 'Activer le paramètre « Activer la fonctionnalité “ Membres ayant visité ce sujet ” dans les sujets » sur « Oui » pour saisir une limite',
	'WHOVISITEDTHISTOPIC_DISABLED_MEMBERPAGE'			=> 'Activer le paramètre « Activer l’affichage des sujets consultés par les membres dans les profils » sur « Oui » pour saisir une limite',
	'WHOVISITEDTHISTOPIC_SETTINGS_EXPLAIN'				=> 'Se rendre dans l’onglet <em><strong>« Membres ayant visité ce sujet »</strong></em> de la rubrique des permissions de groupes pour définir les permissions de chacun des groupes.',
));
