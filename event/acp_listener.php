<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
* @copyright (c) 2016 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\whovisitedthistopic\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class acp_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.acp_board_config_edit_add'	=>	'add_options',
		);
	}

	public function add_options($event)
	{
		if (($event['mode'] == 'features' || $event['mode'] == 'load') && isset($event['display_vars']['vars']['load_jumpbox']))
		{
			// Store display_vars event in a local variable
			$display_vars = $event['display_vars'];

			// Define config vars
			$config_vars = array(
				'whovisitedthistopic_value'	=> array('lang'	=> 'WHOVISITEDTHISTOPIC_SETTING',	'validate' => 'int:1',	'type' => 'custom:1:255', 'function' => array($this, 'whovisitedthistopic_length'), 'explain' => true),
				'whovisitedthistopic_visit_value'	=> array('lang'	=> 'WHOVISITEDTHISTOPIC_VISIT_SETTING',	'validate' => 'int:1',	'type' => 'custom:1:255', 'function' => array($this, 'whovisitedthistopic_visit_length'), 'explain' => true),
			);

			$display_vars['vars'] = phpbb_insert_config_array($display_vars['vars'], $config_vars, array('after' => 'load_jumpbox'));

			// Update the display_vars	event with the new array
			$event['display_vars'] = array('title' => $display_vars['title'], 'vars' => $display_vars['vars']);
		}
	}

	/**
	* Maximum number allowed
	*/
	function whovisitedthistopic_length($value, $key = '')
	{
		return '<input id="' . $key . '" type="number" size="3" maxlength="3" min="2" max="255" name="config[whovisitedthistopic_value]" value="' . $value . '" />';
	}

	function whovisitedthistopic_visit_length($value, $key = '')
	{
		return '<input id="' . $key . '" type="number" size="3" maxlength="3" min="2" max="255" name="config[whovisitedthistopic_visit_value]" value="' . $value . '" />';
	}
}
