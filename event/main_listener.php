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

class main_listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var string */
	protected $whovisitedthistopic_table;

	/** @var string */
	protected $phpbb_root_path;

	/** @var string */
	protected $phpEx;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var string phpBB admin path */
	protected $phpbb_admin_path;

	/**
	* Constructor
	*
	* @param \phpbb\config\config				$config
	* @param \phpbb\template					$template
	* @param \phpbb\db\driver\driver_interface	$db
	* @param \phpbb\user						$user
	* @param									$phpbb_root_path
	* @param									$phpEx
	* @param									$whovisitedthistopic_table
	* @param \phpbb\auth\auth					$auth
	* @param									$phpbb_admin_path
	*
	*/
	public function __construct(
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\user $user,
		$phpbb_root_path,
		$phpEx,
		$whovisitedthistopic_table,
		\phpbb\auth\auth $auth,
		$phpbb_admin_path)
	{
		$this->config 				= $config;
		$this->template 			= $template;
		$this->db 					= $db;
		$this->user 				= $user;
		$this->phpbb_root_path 		= $phpbb_root_path;
		$this->phpEx				= $phpEx;
		$this->whovisitedthistopic_table 			= $whovisitedthistopic_table;
		$this->auth 				= $auth;
		$this->phpbb_admin_path 	= $phpbb_admin_path;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.delete_user_after'				=> 'delete_user_view',
			'core.permissions'						=> 'permissions',
			'core.viewtopic_get_post_data'			=> 'viewtopic_get_post_data',
			'core.memberlist_view_profile'			=> 'memberlist_view_profile'
		);
	}

	public function delete_user_view($event)
	{
		$userid_array = $event['user_ids'];
		$cont = count($userid_array);

		for ($i=0;$i<$cont;$i++)
		{
			$user_id=$userid_array[$i];
			$sql = 'DELETE FROM ' . $this->whovisitedthistopic_table . '
				WHERE user_id = ' . $user_id . '';
			$this->db->sql_query($sql);
		}
	}

	public function permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions['u_whovisitedthistopic'] = array('lang' => 'ACL_U_WHOVISITEDTHISTOPIC', 'cat' => 'misc');
		$permissions['u_whovisitedthistopic_count'] = array('lang' => 'ACL_U_WHOVISITEDTHISTOPIC_COUNT', 'cat' => 'misc');
		$permissions['u_whovisitedthistopic_profile'] = array('lang' => 'ACL_U_WHOVISITEDTHISTOPIC_PROFILE', 'cat' => 'misc');
		$event['permissions'] = $permissions;
	}

	public function viewtopic_get_post_data($event)
	{
		$this->user->add_lang_ext('dmzx/whovisitedthistopic', 'common');

		$topic_id = $event['topic_id'];
		$user_id = $this->user->data['user_id'];
		$value = $this->config['whovisitedthistopic_value'];

		if (($this->user->data['user_id'] != ANONYMOUS) && (!$this->user->data['is_bot']))
		{
			$sql = 'SELECT *
				FROM ' . $this->whovisitedthistopic_table . '
				WHERE user_id = ' . (int) $user_id . '
					AND topic_id = ' . (int) $topic_id;
			$result = $this->db->sql_query($sql);

			if ($row = $this->db->sql_fetchrow($result))
			{
				$counter_user = $row['counter_user'] + 1;
				$date = time();
				$sql_arr = array(
					'counter_user'	=> (int) $counter_user,
					'date'			=> $date
				);

				$sql_insert = 'UPDATE ' . $this->whovisitedthistopic_table . '
					SET	' . $this->db->sql_build_array('UPDATE', $sql_arr) . '
					WHERE user_id = ' . (int) $user_id . '
						AND topic_id = ' . (int) $topic_id;
				$this->db->sql_query($sql_insert);
			}
			else
			{
				$date = time();
				$sql_arr = array(
					'counter_user'	=> 1,
					'user_id'		=> $user_id,
					'topic_id'		=> $topic_id,
					'date'			=> $date
				);

				$sql_insert = 'INSERT INTO ' . $this->whovisitedthistopic_table . ' ' . $this->db->sql_build_array('INSERT', $sql_arr);
				$this->db->sql_query($sql_insert);
			}
		}

		if ($this->auth->acl_get('u_whovisitedthistopic'))
		{
			$query = 'SELECT w.user_id, w.topic_id, w.counter_user, w.date, u.username, u.user_colour, u.user_id, u.user_avatar, u.user_avatar_type, u.user_avatar_height, u.user_avatar_width, u.user_type, SUM(w.counter_user) AS total
				FROM ' . $this->whovisitedthistopic_table . ' w, ' . USERS_TABLE . ' u
				WHERE w.topic_id = ' . $topic_id . '
					AND w.user_id = u.user_id
				GROUP BY w.user_id
				ORDER BY w.date DESC';
			$row_query = $this->db->sql_query_limit($query, $value);

			while ($row = $this->db->sql_fetchrow($row_query))
			{
				$username = $row['username'];
				$user_colour = ($row['user_colour']) ? ' style="color:#' . $row['user_colour'] . '" class="username-coloured"' : '';
				$user_id = $row['user_id'];
				$date = ($row['date']) ? ' title="' .	$this->user->format_date($row['date']) . ' ': '';
				$avatar = phpbb_get_user_avatar($row);

				if ($this->auth->acl_get('u_whovisitedthistopic_count'))
				{
					$visits = (int) $row['total'];
				}
				else
				{
					$visits = null;
				}

				$url = "{$this->phpbb_root_path}memberlist.{$this->phpEx}?mode=viewprofile&u={$user_id}";

				$this->template->assign_block_vars('whovisitedthistopic',array(
					'USERNAME'			=> $username,
					'USERNAME_COLOUR'	=> $user_colour,
					'VISITS'			=> $visits,
					'URL'				=> $url,
					'AVATAR'			=> empty($avatar) ? '<img src="' . $this->phpbb_admin_path . 'images/no_avatar.gif" width="60px;" height="60px;" alt="" />' : $avatar,
					'DATE'				=> $date
				));
			}

			$this->template->assign_vars(array(
				'WHOVISITEDTHISTOPIC_TITLE'			=> $this->user->lang('WHOVISITEDTHISTOPIC_TITLE', $value),
			));

			if ($this->auth->acl_get('u_whovisitedthistopic'))
			{
				$this->template->assign_var('PERMISSION_VIEW', true);
			}

			if ($this->auth->acl_get('u_whovisitedthistopic_count'))
			{
				$this->template->assign_var('PERMISSION_COUNT', true);
			}
		}
	}

	public function memberlist_view_profile($event)
	{
		$this->user->add_lang_ext('dmzx/whovisitedthistopic', 'common');

		$member = $event['member'];
		$user_id = (int) $member['user_id'];
		$value = $this->config['whovisitedthistopic_visit_value'];

		if ($this->auth->acl_get('u_whovisitedthistopic_profile'))
		{
			$this->template->assign_var('PERMISSION_PROFILE', true);

			$sql_list = 'SELECT tt.topic_id, tt.topic_title, ft.forum_id
				FROM ' . FORUMS_TABLE . ' ft, ' . TOPICS_TABLE . ' tt, ' . $this->whovisitedthistopic_table . ' wt
				WHERE tt.topic_moved_id = 0
					AND tt.topic_visibility = 1
					AND wt.user_id = ' . $user_id . '
					AND wt.topic_id = tt.topic_id
					AND ft.forum_id = tt.forum_id
				ORDER BY wt.date DESC';
			$sql_list_query = $this->db->sql_query_limit($sql_list, $value);

			while ($sql_list = $this->db->sql_fetchrow($sql_list_query))
			{
				$topic_id = $sql_list['topic_id'];
				$topic_title = $sql_list['topic_title'];
				$url = "{$this->phpbb_root_path}viewtopic.{$this->phpEx}?t={$topic_id}";

				$this->template->assign_block_vars('whovisitedthistopic',array(
					'TOPIC_TITLE'		=> $topic_title,
					'URL'				=> $url,
				));
			}
		}

		$this->template->assign_vars(array(
			'WHOVISITEDTHISTOPIC_VISIT_TITLE'	=> $this->user->lang('WHOVISITEDTHISTOPIC_VISIT_TITLE', $value),
		));
	}
}
