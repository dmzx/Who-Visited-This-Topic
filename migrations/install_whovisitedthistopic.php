<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
* @copyright (c) 2016 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\whovisitedthistopic\migrations;

class install_whovisitedthistopic extends \phpbb\db\migration\migration
{
	static public function depends_on()
	{
		return array('\phpbb\db\migration\data\v310\gold');
	}

	public function update_data()
	{
		return array(
			// Add configs
			array('config.add', array('whovisitedthistopic_value', 10)),
			array('config.add', array('whovisitedthistopic_visit_value', 10)),
			// Permissions
			array('permission.add', array('u_whovisitedthistopic', true)),
			array('permission.add', array('u_whovisitedthistopic_count', true)),
			array('permission.add', array('u_whovisitedthistopic_profile', true)),
			// Set Permissions
			array('permission.permission_set', array('REGISTERED', 'u_whovisitedthistopic', 'group', true)),
			array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_whovisitedthistopic', 'rule', true)),
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'u_whovisitedthistopic', 'rule', true)),
			array('permission.permission_set', array('REGISTERED', 'u_whovisitedthistopic_count', 'group', true)),
			array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_whovisitedthistopic_count', 'rule', true)),
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'u_whovisitedthistopic_count', 'rule', true)),
			array('permission.permission_set', array('REGISTERED', 'u_whovisitedthistopic_profile', 'group', true)),
			array('permission.permission_set', array('ROLE_USER_STANDARD', 'u_whovisitedthistopic_profile', 'rule', true)),
			array('permission.permission_set', array('ROLE_ADMIN_FULL', 'u_whovisitedthistopic_profile', 'rule', true)),
		);
	}

	public function update_schema()
	{
		return array(
			'add_tables'	=> array(
				$this->table_prefix . 'whovisitedthistopic'	=> array(
					'COLUMNS'	=> array(
						'count_id'						=> array('UINT', null, 'auto_increment'),
						'counter_user'					=> array('UINT', null),
						'user_id'						=> array('UINT', null),
						'topic_id'						=> array('UINT', null),
						'date'							=> array('TIMESTAMP', 0),
					),
					'PRIMARY_KEY'	=> 'count_id',
				),
			),
		);
	}

	public function revert_schema()
	{
		return array(
			'drop_tables'	=> array(
				$this->table_prefix . 'whovisitedthistopic'
			),
		);
	}
}
