<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
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
// ’ « » “ ” …
//

$lang = array_merge($lang, [
	'WHOVISITEDTHISTOPIC_INDEX'					=> 'Quem Visitou Este Tópico',
	'ACL_U_WHOVISITEDTHISTOPIC'					=> 'Pode ver Quem Visitou Este Tópico nos tópicos',
	'ACL_U_WHOVISITEDTHISTOPIC_COUNT'			=> 'Pode ver o contador de Quem Visitou Este Tópico nos tópicos',
	'ACL_U_WHOVISITEDTHISTOPIC_PROFILE'			=> 'Pode ver Quem Visitou Este Tópico no perfil',
	'ACL_U_WHOVISITEDTHISTOPIC_SHOW_AVATAR'		=> 'Pode ver os avatares de Quem Visitou Este Tópico nos tópicos',
]);
