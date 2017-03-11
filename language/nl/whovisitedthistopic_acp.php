<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
* @copyright (c) 2016 dmzx - http://www.dmzx-web.net
* Nederlandse vertaling @ Solidjeuh <https://www.froddelpower.be>
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
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS'				=> 'Schakel Wie Bezocht Deze Topic aan in topics',
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS_EXPLAIN'		=> 'Dit zal de Wie Bezocht Deze Topic tonen in viewtopics.',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS'				=> 'Schakel Wie Bezocht Deze Topic teller aan in topics',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS_EXPLAIN'		=> 'Dit zal de Wie Bezocht Deze Topic teller tonen in topics.',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR'					=> 'Schakel de Wie Bezocht Deze Topic avatars aan in topics',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR_EXPLAIN'			=> 'Dit zal de Wie Bezocht Deze Topic avatars tonen in topics.',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS'			=> 'Schakel Wie Bezocht Deze Topic aan in profielen',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS_EXPLAIN'	=> 'Dit zal Wie Bezocht Deze Topic tonen op profielen.',
	'WHOVISITEDTHISTOPIC_SETTING'						=> 'Stel de waarde in voor Wie Bezocht Deze Topic in topics',
	'WHOVISITEDTHISTOPIC_SETTING_EXPLAIN'				=> 'Waarde instelbaar van 2 tot 255 leden. <em>Standaard is 10.</em>',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING'					=> 'Stel de waarde in voor Laatst Bezochte Topics in profielen',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING_EXPLAIN'			=> 'Waarde instelbaar van 2 tot 255 leden. <em>Standaard is 10.</em>',
	'WHOVISITEDTHISTOPIC_DISABLED_TOPIC'				=> 'Uitgeschakeld. Zet “Schakel Wie Bezocht Deze Topic aan in topics” op Ja om een waarde in te stellen',
	'WHOVISITEDTHISTOPIC_DISABLED_MEMBERPAGE'			=> 'Uitgeschakeld. Zet “Schakel Wie Bezocht Deze Topic aan in profielen” op Ja om een waarde in te stellen',
	'WHOVISITEDTHISTOPIC_SETTINGS_EXPLAIN'				=> 'Ga naar de <em><strong>Wie Bezocht Deze Topic</strong></em> tab in de Groep Permissie sectie om permissies in te stellen voor iedere groep..',
));
