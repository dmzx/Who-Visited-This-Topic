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
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS'				=> 'Habilita Quem Visitou Este Tópico nos tópicos',
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS_EXPLAIN'		=> 'Isso mostra Quem Visitou Este Tópico nos tópicos.',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS'				=> 'Habilita o contador de Quem Visitou Este Tópico nos tópicos',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS_EXPLAIN'		=> 'Isso mostra o contador de Quem Visitou Este Tópico nos tópicos.',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR'					=> 'Habilita os avatares em Quem Visitou Este Tópico nos tópicos',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR_EXPLAIN'			=> 'Isso mostra os avatares de Quem Visitou Este Tópico nos tópicos.',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS'			=> 'Habilita Quem Visitou Este Tópico no perfil',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS_EXPLAIN'	=> 'Isso mostra Quem Visitou Este Tópico no perfil.',
	'WHOVISITEDTHISTOPIC_SETTING'						=> 'Quantidade de Quem Visitou Este Tópico nos tópicos',
	'WHOVISITEDTHISTOPIC_SETTING_EXPLAIN'				=> 'Valor ajustável entre 2 e 255 usuários. <em>Padrão é 10.</em>',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING'					=> 'Quantidade de Quem Visitou Este Tópico no perfil',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING_EXPLAIN'			=> 'Valor ajustável entre 2 e 255 usuários. <em>Padrão é 10.</em>',
	'WHOVISITEDTHISTOPIC_DISABLED_TOPIC'				=> 'Marque “Habilita Quem Visitou Este Tópico nos tópicos” para Sim para mudar este valor',
	'WHOVISITEDTHISTOPIC_DISABLED_MEMBERPAGE'			=> 'Marque “Habilita Quem Visitou Este Tópico no perfil” para Sim para mudar este valor',
	'WHOVISITEDTHISTOPIC_SETTINGS_EXPLAIN'				=> 'Vá para a aba <em><strong>Quem Visitou Este Tópico </strong></em> nas permissões de grupo para ajustar as permissões.',
));
