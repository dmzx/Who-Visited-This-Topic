<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
* @copyright (c) 2016 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\whovisitedthistopic\migrations;

class whovisitedthistopic_1_0_5 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\dmzx\whovisitedthistopic\migrations\install_whovisitedthistopic',
		);
	}

	public function update_data()
	{
		return array(
			// Update config
			array('config.update', array('whovisitedthistopic_version', '1.0.5')),
			// Add config
			array('config.add', array('whovisitedthistopic_show_avatar', 1)),
			// Permission
			array('permission.add', array('u_whovisitedthistopic_show_avatar', true)),
			// Set Permission
			array('permission.permission_set', array('REGISTERED', 'u_whovisitedthistopic_show_avatar', 'group', true)),
		);
	}
}
