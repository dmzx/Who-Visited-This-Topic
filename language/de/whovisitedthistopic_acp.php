<?php
/**
*
* @version $Id$
* @package phpBB Extension - Who Visited This Topic (deutsch)
* @copyright (c) 2016 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
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
// ‚ ‘ ’ « » „ “ ” …
//

$lang = array_merge($lang, array(
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS'				=> 'Aktiviere „Wer besuchte dieses Thema“ in Themen',
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS_EXPLAIN'		=> 'Dies wird „Wer besuchte dieses Thema“ in der Themenansicht anzeigen.',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS'				=> 'Aktiviere den Themenzähler von „Wer besuchte dieses Thema“',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS_EXPLAIN'		=> 'Dies wird den Themenzähler von „Wer besuchte dieses Thema“ in Themen anzeigen.',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR'					=> 'Aktiviere Avatare bei „Wer besuchte dieses Thema“ in Themen',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR_EXPLAIN'			=> 'Dies wird Avatare bei „Wer besuchte dieses Thema“ in Themen anzeigen.',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS'			=> 'Aktiviere „Wer besuchte dieses Thema“ im Profil',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS_EXPLAIN'	=> 'Dies wird die letzten besuchten Themen in den Profilen anzeigen.',
	'WHOVISITEDTHISTOPIC_SETTING'						=> 'Setze einen Wert für „Wer besuchte dieses Thema“ in Themen',
	'WHOVISITEDTHISTOPIC_SETTING_EXPLAIN'				=> 'Der Wert ist einstellbar von 2 bis 255 Mitgliedern. <em>Standard ist 10.</em>',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING'					=> 'Setze Wert für die letzten besuchten Themen im Profil',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING_EXPLAIN'			=> 'Der Wert ist einstellbar von 2 bis 255. <em>Standard ist 10.</em>',
	'WHOVISITEDTHISTOPIC_DISABLED_TOPIC'				=> 'Deaktiviert, setze „Wer besuchte dieses Thema in Themen“ auf „Ja“, um einen Wert einzugeben',
	'WHOVISITEDTHISTOPIC_DISABLED_MEMBERPAGE'			=> 'Deaktiviert, setze „Wer besuchte dieses Thema im Profil“ auf „Ja“, um einen Wert einzugeben',
	'WHOVISITEDTHISTOPIC_SETTINGS_EXPLAIN'				=> 'Gehe zum <em><strong>Who Visited This Topic</strong></em>-Tab im Bereich der Gruppenrechte, um die Berechtigungen für jede Gruppe einzustellen.',
));
