<?php
/**
*
* @package phpBB Extension - Who Visited This Topic
* @copyright (c) 2016 dmzx - http://www.dmzx-web.net
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace dmzx\whovisitedthistopic\includes;

class version_check
{
	/** @var string version_data */
	protected $version_data;

	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\version_helper $version_helper */
	protected $version_helper;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string Current version */
	protected $current_version;

	/**
	* Constructor
	*
	* @param array 						$version_data
	* @param \phpbb\config\config 		$config
	* @param \phpbb\version_helper 		$version_helper
	* @param \phpbb\template\twig\twig 	$template
	* @param \phpbb\user 				$user
	*/
	public function __construct(
		$version_data,
		$config,
		$version_helper,
		$template,
		$user)
	{
		$this->version_data 		= $version_data;
		$this->config 				= $config;
		$this->version_helper 		= $version_helper;
		$this->template 			= $template;
		$this->user 				= $user;
		$this->current_version 		= $this->config[str_replace(' ', '', $this->version_data['version'])];
	}

	public function check($return_version = false)
	{
		$allow_url_fopen = (int) @ini_get('allow_url_fopen');
		if ($allow_url_fopen)
		{
			$this->version_helper->set_file_location($this->version_data['file'][0], $this->version_data['file'][1], $this->version_data['file'][2]);

			$this->version_helper->set_current_version($this->current_version);

			$this->version_helper->force_stability(($this->config['extension_force_unstable'] || !$this->version_helper->is_stable($this->current_version)) ? 'unstable' : null);

			$updates = $this->version_helper->get_suggested_updates(true);

			if ($return_version)
			{
				return $this->current_version;
			}

			$version_up_to_date = empty($updates);

			$template_data = array(
				'WHOVISITEDTHISTOPIC_AUTHOR'			=> $this->version_data['author'],
				'WHOVISITEDTHISTOPIC_CURRENT_VERSION'	=> $this->current_version,
				'WHOVISITEDTHISTOPIC_UP_TO_DATE'		=> sprintf((!$version_up_to_date) ? $this->user->lang['WHOVISITEDTHISTOPIC_NOT_UP_TO_DATE'] : $this->user->lang['WHOVISITEDTHISTOPIC_UP_TO_DATE'], $this->version_data['title']),
				'WHOVISITEDTHISTOPIC_S_UP_TO_DATE'		=> $version_up_to_date,
				'WHOVISITEDTHISTOPIC_U_AUTHOR'			=> 'http://www.phpbb.com/community/memberlist.php?mode=viewprofile&un=' . $this->version_data['author'],
				'WHOVISITEDTHISTOPIC_TITLE'				=> (string) $this->version_data['title'],
				'WHOVISITEDTHISTOPIC_LATEST_VERSION'	=> $this->current_version,
			);

			if (!$version_up_to_date)
			{
				$updates = array_shift($updates);
				$template_data = array_merge($template_data, array(
					'WHOVISITEDTHISTOPIC_ANNOUNCEMENT'		=> (string) $updates['announcement'],
					'WHOVISITEDTHISTOPIC_DOWNLOAD'			=> (string) $updates['download'],
					'WHOVISITEDTHISTOPIC_LATEST_VERSION'	=> $updates['current'],
				));
			}
			$this->template->assign_block_vars('ext_update', $template_data);
		}
	}
}
