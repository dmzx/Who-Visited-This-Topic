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
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS'				=> 'Enable Who Visited This Topic in topics',
	'WHOVISITEDTHISTOPIC_TOPIC_SETTINGS_EXPLAIN'		=> 'This will show the Who Visited This Topic in viewtopics.',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS'				=> 'Enable Who Visited This Topic counter topics',
	'WHOVISITEDTHISTOPIC_COUNT_SETTINGS_EXPLAIN'		=> 'This will show the Who Visited This Topic counter in topics.',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR'					=> 'Enable Who Visited This Topic avatars in topics',
	'WHOVISITEDTHISTOPIC_SHOW_AVATAR_EXPLAIN'			=> 'This will show the Who Visited This Topic avatars in topics.',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS'			=> 'Enable Who Visited This Topic in profile',
	'WHOVISITEDTHISTOPIC_MEMBERPAGE_SETTINGS_EXPLAIN'	=> 'This will show the Who Visited This Topic in profile.',
	'WHOVISITEDTHISTOPIC_SETTING'						=> 'Set value for Who Visited This Topic in topics',
	'WHOVISITEDTHISTOPIC_SETTING_EXPLAIN'				=> 'Value adjustable from 2 till 255 members. <em>Default is 10.</em>',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING'					=> 'Set value for Last Topics Visited in profile',
	'WHOVISITEDTHISTOPIC_VISIT_SETTING_EXPLAIN'			=> 'Value adjustable from 2 till 255. <em>Default is 10.</em>',
	'WHOVISITEDTHISTOPIC_DISABLED_TOPIC'				=> 'Disabled set “Enable Who Visited This Topic in topics” to Yes to enter value',
	'WHOVISITEDTHISTOPIC_DISABLED_MEMBERPAGE'			=> 'Disabled set “Enable Who Visited This Topic in profile” to Yes to enter value',
	'WHOVISITEDTHISTOPIC_SETTINGS_EXPLAIN'				=> 'Go to the <em><strong>Who Visited This Topic</strong></em> tab in Group permissions section to adjust permissions for each group.',
));
