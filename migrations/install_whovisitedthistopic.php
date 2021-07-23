<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\whovisitedthistopic\migrations;

use phpbb\db\migration\migration;

class install_whovisitedthistopic extends migration
{
	static public function depends_on()
	{
		return ['\phpbb\db\migration\data\v310\gold'];
	}

	public function update_data()
	{
		return [
			// Add configs
			['config.add', ['whovisitedthistopic_value', 10]],
			['config.add', ['whovisitedthistopic_visit_value', 10]],
			['config.add', ['whovisitedthistopic_allow_topics', 1]],
			['config.add', ['whovisitedthistopic_allow_memberpage', 1]],
			['config.add', ['whovisitedthistopic_allow_count', 1]],
			['config.add', ['whovisitedthistopic_version', '1.0.4']],
			// Permissions
			['permission.add', ['u_whovisitedthistopic', true]],
			['permission.add', ['u_whovisitedthistopic_count', true]],
			['permission.add', ['u_whovisitedthistopic_profile', true]],
			// Set Permissions
			['permission.permission_set', ['REGISTERED', 'u_whovisitedthistopic', 'group', true]],
			['permission.permission_set', ['REGISTERED', 'u_whovisitedthistopic_count', 'group', true]],
			['permission.permission_set', ['REGISTERED', 'u_whovisitedthistopic_profile', 'group', true]],

			['module.add', [
				'acp',
				'ACP_CAT_DOT_MODS',
				'ACP_WHOVISITEDTHISTOPIC_TITLE',
			]],
			['module.add', [
				'acp',
				'ACP_WHOVISITEDTHISTOPIC_TITLE',
				[
					'module_basename'	=> '\dmzx\whovisitedthistopic\acp\acp_whovisitedthistopic_module',
					'modes'				=> [
						'settings',
					],
				],
			]],
		];
	}

	public function update_schema()
	{
		return [
			'add_tables'	=> [
				$this->table_prefix . 'whovisitedthistopic'	=> [
					'COLUMNS'	=> [
						'count_id'						=> ['UINT', null, 'auto_increment'],
						'counter_user'					=> ['UINT', null],
						'user_id'						=> ['UINT', null],
						'topic_id'						=> ['UINT', null],
						'date'							=> ['TIMESTAMP', 0],
					],
					'PRIMARY_KEY'	=> 'count_id',
				],
			],
		];
	}

	public function revert_schema()
	{
		return [
			'drop_tables'	=> [
				$this->table_prefix . 'whovisitedthistopic'
			],
		];
	}
}
