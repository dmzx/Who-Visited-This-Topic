<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
* @copyright (c) 2016 dmzx - https://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\whovisitedthistopic\controller;

use phpbb\config\config;
use phpbb\template\template;
use phpbb\log\log_interface;
use phpbb\user;
use phpbb\request\request;

class admin_controller
{
	/** @var config */
	protected $config;

	/** @var template */
	protected $template;

	/** @var log_interface */
	protected $log;

	/** @var user */
	protected $user;

	/** @var request */
	protected $request;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $phpEx;

	/** @var string Custom form action */
	protected $u_action;

	/**
	 * Constructor
	 *
	 * @param config				$config
	 * @param template				$template
	 * @param log_interface			$log
	 * @param user					$user
	 * @param request				$request
	 * @param string				$root_path
	 * @param string				$phpEx
	 */
	public function __construct(
		config $config,
		template $template,
		log_interface $log,
		user $user,
		request $request,
		$root_path,
		$phpEx
	)
	{
		$this->config 			= $config;
		$this->template 		= $template;
		$this->log 				= $log;
		$this->user 			= $user;
		$this->request			= $request;
		$this->root_path 		= $root_path;
		$this->phpEx			= $phpEx;
	}

	/**
	* Display the options a user can configure for this extension
	*
	* @return null
	* @access public
	*/
	public function display_options()
	{
		add_form_key('whovisitedthistopic');

		// Add lang file
		$this->user->add_lang_ext('dmzx/whovisitedthistopic', 'whovisitedthistopic_acp');

		if (!function_exists('user_get_id_name'))
		{
			include($this->root_path . 'includes/functions_user.' . $this->phpEx);
		}

		// Is the form being submitted to us?
		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key('whovisitedthistopic'))
			{
				trigger_error('FORM_INVALID');
			}

			// Set the options the user configured
			$this->set_options();

			// Add option settings change action to the admin log
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_WHOVISITEDTHISTOPIC_UPDATE');

			trigger_error($this->user->lang('ACP_WHOVISITEDTHISTOPIC_OPTIONS_SAVED') . adm_back_link($this->u_action));
		}

		// Get the user_ids of excluded members and convert it to string for use in template
		$username_arr = [];
		$username_profile = [];
		$whovisitedthistopic_users_ids = json_decode($this->config['whovisitedthistopic_members']);
		$whovisitedthistopic_users_ids_profile = json_decode($this->config['whovisitedthistopic_members_profile']);
		user_get_id_name($whovisitedthistopic_users_ids, $username_arr);
		user_get_id_name($whovisitedthistopic_users_ids_profile, $username_profile);
		sort($username_arr);
		sort($username_profile);
		$whovisitedthistopic_members = implode("\n", $username_arr);
		$whovisitedthistopic_members_profile = implode("\n", $username_profile);

		$this->template->assign_vars([
			'U_ACTION'								=> $this->u_action,
			'WHOVISITEDTHISTOPIC_VERSION'			=> $this->config['whovisitedthistopic_version'],
			'WHOVISITEDTHISTOPIC_ALLOW_TOPICS'		=> $this->config['whovisitedthistopic_allow_topics'],
			'WHOVISITEDTHISTOPIC_SETTING'			=> $this->config['whovisitedthistopic_value'],
			'WHOVISITEDTHISTOPIC_ALLOW_MEMBERPAGE'	=> $this->config['whovisitedthistopic_allow_memberpage'],
			'WHOVISITEDTHISTOPIC_VISIT_SETTING'		=> $this->config['whovisitedthistopic_visit_value'],
			'WHOVISITEDTHISTOPIC_ALLOW_COUNT'		=> $this->config['whovisitedthistopic_allow_count'],
			'WHOVISITEDTHISTOPIC_SHOW_AVATAR'		=> $this->config['whovisitedthistopic_show_avatar'],
			'WHOVISITEDTHISTOPIC_MEMBERS'			=> $whovisitedthistopic_members,
			'WHOVISITEDTHISTOPIC_MEMBERS_PROFILE'	=> $whovisitedthistopic_members_profile,
		]);
	}

	/**
	* Set the options a user can configure
	*
	* @return null
	* @access protected
	*/
	protected function set_options()
	{
		// Set the user_ids of excluded members view topic
		$whovisitedthistopic_users_ids = [];
		$whovisitedthistopic_members = $this->request->variable('whovisitedthistopic_members', '');
		$username_arr = explode("\n", $whovisitedthistopic_members);
		user_get_id_name($whovisitedthistopic_users_ids, $username_arr);
		sort($whovisitedthistopic_users_ids);

		// Set the user_ids of excluded members profile view
		$whovisitedthistopic_users_ids_profile = [];
		$whovisitedthistopic_members_profile = $this->request->variable('whovisitedthistopic_members_profile', '');
		$username_arr = explode("\n", $whovisitedthistopic_members_profile);
		user_get_id_name($whovisitedthistopic_users_ids_profile, $username_arr);
		sort($whovisitedthistopic_users_ids_profile);

		$this->config->set('whovisitedthistopic_allow_topics', $this->request->variable('whovisitedthistopic_allow_topics', 1));
		$this->config->set('whovisitedthistopic_value', $this->request->variable('whovisitedthistopic_value', 10));
		$this->config->set('whovisitedthistopic_allow_memberpage', $this->request->variable('whovisitedthistopic_allow_memberpage', 1));
		$this->config->set('whovisitedthistopic_visit_value', $this->request->variable('whovisitedthistopic_visit_value', 10));
		$this->config->set('whovisitedthistopic_allow_count', $this->request->variable('whovisitedthistopic_allow_count', 1));
		$this->config->set('whovisitedthistopic_show_avatar', $this->request->variable('whovisitedthistopic_show_avatar', 1));
		$this->config->set('whovisitedthistopic_members', json_encode($whovisitedthistopic_users_ids));
		$this->config->set('whovisitedthistopic_members_profile', json_encode($whovisitedthistopic_users_ids_profile));
	}

	/**
	* Set page url
	*
	* @param string $u_action Custom form action
	* @return null
	* @access public
	*/
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
