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
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS'				=> 'Habilitar Quién Visitó este Tema en los temas',
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS_EXPLAIN'		=> 'Esto mostrará Quién Visitó este Tema viendo los temas.',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS'				=> 'Habilitar el contador de Quién Visitó este Tema en los temas',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS_EXPLAIN'		=> 'Esto mostrará el contador de Quién Visitó este Tema en los temas.',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR'					=> 'Habilitar avatares de Quién Visitó este Tema en los temas',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR_EXPLAIN'			=> 'Esto mostrará los avatares en Quién Visitó este Tema en los temas.',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS'			=> 'Habilitar Quién Visitó este Tema en el perfil',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS_EXPLAIN'	=> 'Esto mostrará Quién Visitó este Tema en el perfil.',
	'WHOVISITEDTHISTOPIC_SETTING'						=> 'Establecer el valor para Quién Visitó este Tema en los temas',
	'WHOVISITEDTHISTOPIC_SETTING_EXPLAIN'				=> 'Valor ajustable de 2 a 255 miembros. <em>Por defecto es 10.</em>',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING'					=> 'Establecer el valor para Últimos Temas Visitados en el perfil',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING_EXPLAIN'			=> 'Valor ajustable de 2 a 255. <em>Por defecto es 10.</em>',
	'WHOVISITEDTHISTOPIC_DISABLED_TOPIC'				=> 'Deshabilitar el ajuste “Habilitar Quién Visitó este Tema en los temas” en Si, para introducir el valor',
	'WHOVISITEDTHISTOPIC_DISABLED_MEMBERPAGE'			=> 'Deshabilitar el ajuste “Habilitar Quién Visitó este Tema en el perfil” en Si, para introducir el valor',
	'WHOVISITEDTHISTOPIC_SETTINGS_EXPLAIN'				=> 'Ir a la pestaña <em><strong>Quién Visitó este Tema</strong></em> en la sección de Permisos de Grupos para ajustar los permisos de cada grupo.',
]);
