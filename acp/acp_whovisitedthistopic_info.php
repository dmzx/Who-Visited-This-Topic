<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
* @copyright (c) 2016 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\whovisitedthistopic\acp;

class acp_whovisitedthistopic_info
{
	function module()
	{
		return array(
			'filename'	=> '\dmzx\whovisitedthistopic\acp\acp_whovisitedthistopic_module',
			'title'		=> 'ACP_WHOVISITEDTHISTOPIC_TITLE',
			'modes'		=> array(
				'settings'	=> array('title' => 'ACP_WHOVISITEDTHISTOPIC_SETTINGS', 'auth' => 'ext_dmzx/whovisitedthistopic && acl_a_board', 'cat' => array('ACP_WHOVISITEDTHISTOPIC_TITLE')),
			),
		);
	}
}
