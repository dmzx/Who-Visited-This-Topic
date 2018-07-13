<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\whovisitedthistopic\migrations;

class whovisitedthistopic_1_0_6 extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array(
			'\dmzx\whovisitedthistopic\migrations\whovisitedthistopic_1_0_5',
		);
	}

	public function update_data()
	{
		return array(
			// Update config
			array('config.update', array('whovisitedthistopic_version', '1.0.6')),
		);
	}
}
