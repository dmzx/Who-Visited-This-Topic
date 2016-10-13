<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
* @copyright (c) 2016 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\whovisitedthistopic\controller;

class admin_controller
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\log\log_interface */
	protected $log;

	/** @var \phpbb\user */
	protected $user;

	/** @var ContainerBuilder */
	protected $phpbb_container;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var string Custom form action */
	protected $u_action;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config											$config
	 * @param \phpbb\template\template										$template
	 * @param \\phpbb\log\log_interface										$log
	 * @param \phpbb\user													$user
	 * @param	\Symfony\Component\DependencyInjection\ContainerInterface 	$phpbb_container
	 * @param \phpbb\request\request										$request
	 */
	public function __construct(
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\log\log_interface $log,
		\phpbb\user $user,
		$phpbb_container,
		\phpbb\request\request $request)
	{
		$this->config 			= $config;
		$this->template 		= $template;
		$this->log 				= $log;
		$this->user 			= $user;
		$this->phpbb_container 	= $phpbb_container;
		$this->request 			= $request;
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

		$this->version_check = $this->phpbb_container->get('dmzx.whovisitedthistopic.version.check');

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
			$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'WHOVISITEDTHISTOPIC_SAVED');

			trigger_error($this->user->lang('ACP_WHOVISITEDTHISTOPIC_OPTIONS_SAVED') . adm_back_link($this->u_action));
		}

		$this->template->assign_vars(array(
			'U_ACTION'								=> $this->u_action,
			'WHOVISITEDTHISTOPIC_ALLOW_TOPICS'		=> $this->config['whovisitedthistopic_allow_topics'],
			'WHOVISITEDTHISTOPIC_SETTING'			=> $this->config['whovisitedthistopic_value'],
			'WHOVISITEDTHISTOPIC_ALLOW_MEMBERPAGE'	=> $this->config['whovisitedthistopic_allow_memberpage'],
			'WHOVISITEDTHISTOPIC_VISIT_SETTING'		=> $this->config['whovisitedthistopic_visit_value'],
			'WHOVISITEDTHISTOPIC_ALLOW_COUNT'		=> $this->config['whovisitedthistopic_allow_count'],
			'WHOVISITEDTHISTOPIC_SHOW_AVATAR'		=> $this->config['whovisitedthistopic_show_avatar'],
		));
		$this->version_check->check();
	}

	/**
	* Set the options a user can configure
	*
	* @return null
	* @access protected
	*/
	protected function set_options()
	{
		$this->config->set('whovisitedthistopic_allow_topics', $this->request->variable('whovisitedthistopic_allow_topics', 1));
		$this->config->set('whovisitedthistopic_value', $this->request->variable('whovisitedthistopic_value', 10));
		$this->config->set('whovisitedthistopic_allow_memberpage', $this->request->variable('whovisitedthistopic_allow_memberpage', 1));
		$this->config->set('whovisitedthistopic_visit_value', $this->request->variable('whovisitedthistopic_visit_value', 10));
		$this->config->set('whovisitedthistopic_allow_count', $this->request->variable('whovisitedthistopic_allow_count', 1));
		$this->config->set('whovisitedthistopic_show_avatar', $this->request->variable('whovisitedthistopic_show_avatar', 1));
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
