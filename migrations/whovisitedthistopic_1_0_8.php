<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
* @copyright (c) 2021 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\whovisitedthistopic\migrations;

use phpbb\db\migration\migration;

class whovisitedthistopic_1_0_8 extends migration
{
	static public function depends_on()
	{
		return [
			'\dmzx\whovisitedthistopic\migrations\whovisitedthistopic_1_0_7',
		];
	}

	public function update_data()
	{
		return [
			// Update config
			['config.update', ['whovisitedthistopic_version', '1.0.8']],
			// Add config
			['config.add', ['whovisitedthistopic_members', $this->serialize_to_json('whovisitedthistopic_members')]],
		];
	}

	public function serialize_to_json($cfg)
	{
		$data = unserialize(trim($this->config[$cfg]));

		return $data ? json_encode($data) : '';
	}
}
