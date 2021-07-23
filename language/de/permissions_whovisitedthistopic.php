<?php
/**
*
* @version $Id: permissions_whovisitedthistopic.php 77 2017-03-11 22:09:07Z Scanialady $
* @package phpBB Extension - Who Visited This Topic [Deutsch]
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
	$lang = [];
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

$lang = array_merge($lang, [
	'WHOVISITEDTHISTOPIC_INDEX'					=> 'Wer besuchte dieses Thema',
	'ACL_U_WHOVISITEDTHISTOPIC'					=> 'Kann „Wer besuchte dieses Thema“ in Themen sehen',
	'ACL_U_WHOVISITEDTHISTOPIC_COUNT'			=> 'Kann den „Wer besuchte dieses Thema“-Zähler in Themen sehen',
	'ACL_U_WHOVISITEDTHISTOPIC_PROFILE'			=> 'Kann „Wer besuchte dieses Thema“ in Profilen sehen',
	'ACL_U_WHOVISITEDTHISTOPIC_SHOW_AVATAR'		=> 'Kann Avatare bei „Wer besuchte dieses Thema“ in Themen sehen',
]);
