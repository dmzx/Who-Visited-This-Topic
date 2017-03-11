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

class listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/* @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\db\driver\driver_interface */
	protected $db;

	/** @var \phpbb\user */
	protected $user;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\content_visibility */
	protected $content_visibility;

	/** @var \phpbb\cache\service */
	protected $cache;

	/** @var \phpbb\pagination */
	protected $pagination;

	/** @var string */
	protected $whovisitedthistopic_table;

	/** @var string */
	protected $root_path;

	/** @var string */
	protected $phpEx;

	/** @var \phpbb\auth\auth */
	protected $auth;

	/** @var string phpBB admin path */
	protected $phpbb_admin_path;

	/** @var \phpbb\files\factory */
	protected $files_factory;

	/**
	* Constructor
	*
	* @param \phpbb\config\config				$config
	* @param \phpbb\template\template			$template
	* @param \phpbb\db\driver\driver_interface	$db
	* @param \phpbb\user						$user
	* @param \phpbb\request\request				$request
	* @param \phpbb\content_visibility			$content_visibility
	* @param \phpbb\cache\service				$cache
	* @param \phpbb\pagination					$pagination
	* @param string								$root_path
	* @param string								$phpEx
	* @param string								$whovisitedthistopic_table
	* @param \phpbb\auth\auth					$auth
	* @param string								$phpbb_admin_path
	* @param \phpbb\files\factory				$files_factory
	*
	*/
	public function __construct(
		\phpbb\config\config $config,
		\phpbb\template\template $template,
		\phpbb\db\driver\driver_interface $db,
		\phpbb\user $user,
		\phpbb\request\request $request,
		\phpbb\content_visibility $content_visibility,
		\phpbb\cache\service $cache,
		\phpbb\pagination $pagination,
		$root_path,
		$phpEx,
		$whovisitedthistopic_table,
		\phpbb\auth\auth $auth,
		$phpbb_admin_path,
		\phpbb\files\factory $files_factory = null
	)
	{
		$this->config 						= $config;
		$this->template 					= $template;
		$this->db 							= $db;
		$this->user 						= $user;
		$this->request 						= $request;
		$this->content_visibility 			= $content_visibility;
		$this->cache 						= $cache;
		$this->pagination 					= $pagination;
		$this->root_path 					= $root_path;
		$this->phpEx						= $phpEx;
		$this->whovisitedthistopic_table 	= $whovisitedthistopic_table;
		$this->auth 						= $auth;
		$this->phpbb_admin_path 			= $phpbb_admin_path;
		$this->files_factory 				= $files_factory;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.permissions'					=> 'permissions',
			'core.viewtopic_get_post_data'		=> 'viewtopic_get_post_data',
			'core.memberlist_view_profile'		=> 'memberlist_view_profile'
		);
	}

	public function permissions($event)
	{
		$permissions = $event['permissions'];
		$permissions += array(
			'u_whovisitedthistopic'		=> array(
				'lang'		=> 'ACL_U_WHOVISITEDTHISTOPIC',
				'cat'		=> 'whovisitedthistopic'
			),
			'u_whovisitedthistopic_count'	=> array(
				'lang'		=> 'ACL_U_WHOVISITEDTHISTOPIC_COUNT',
				'cat'		=> 'whovisitedthistopic'
			),
			'u_whovisitedthistopic_profile'	=> array(
				'lang'		=> 'ACL_U_WHOVISITEDTHISTOPIC_PROFILE',
				'cat'		=> 'whovisitedthistopic'
			),
			'u_whovisitedthistopic_show_avatar'	=> array(
				'lang'		=> 'ACL_U_WHOVISITEDTHISTOPIC_SHOW_AVATAR',
				'cat'		=> 'whovisitedthistopic'
			),
		);
		$event['permissions'] = $permissions;
		$categories['whovisitedthistopic'] = 'WHOVISITEDTHISTOPIC_INDEX';
		$event['categories'] = array_merge($event['categories'], $categories);
	}

	public function viewtopic_get_post_data($event)
	{
		// Add lang file
		$this->user->add_lang_ext('dmzx/whovisitedthistopic', 'common');

		$topic_id = $event['topic_id'];
		$user_id = $this->user->data['user_id'];
		$value = $this->config['whovisitedthistopic_value'];

		if (($this->user->data['user_id'] != ANONYMOUS) && (!$this->user->data['is_bot']) && $this->config['whovisitedthistopic_allow_topics'])
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
			$this->db->sql_freeresult($result);
		}

		if ($this->auth->acl_get('u_whovisitedthistopic') && $this->config['whovisitedthistopic_allow_topics'])
		{
			$query = 'SELECT w.user_id, w.topic_id, w.counter_user, w.date, u.username, u.user_colour, u.user_id, u.user_avatar, u.user_avatar_type, u.user_avatar_height, u.user_avatar_width, u.user_type, SUM(w.counter_user) AS total
				FROM ' . $this->whovisitedthistopic_table . ' w, ' . USERS_TABLE . ' u
				WHERE w.topic_id = ' . (int) $topic_id . '
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

				$url = append_sid("{$this->root_path}memberlist.{$this->phpEx}?mode=viewprofile&amp;u={$user_id}");

				$this->template->assign_block_vars('whovisitedthistopic',array(
					'USERNAME'			=> $username,
					'USERNAME_COLOUR'	=> $user_colour,
					'VISITS'			=> $visits,
					'URL'				=> $url,
					'AVATAR'			=> empty($avatar) ? '<img src="' . $this->phpbb_admin_path . 'images/no_avatar.gif" width="60px;" height="60px;" alt="" />' : $avatar,
					'DATE'				=> $date
				));
			}
			$this->db->sql_freeresult($row_query);

			$this->template->assign_vars(array(
				'WHOVISITEDTHISTOPIC_TITLE'			=> $this->user->lang('WHOVISITEDTHISTOPIC_TITLE', $value),
				'PERMISSION_COUNT'					=> $this->auth->acl_get('u_whovisitedthistopic_count') && $this->config['whovisitedthistopic_allow_count'],
				'PERMISSION_VIEW'					=> $this->auth->acl_get('u_whovisitedthistopic'),
				'PERMISSION_SHOW_AVATAR'			=> $this->auth->acl_get('u_whovisitedthistopic_show_avatar') && $this->config['whovisitedthistopic_show_avatar'],
			));
		}
	}

	public function memberlist_view_profile($event)
	{
		// Add lang file
		$this->user->add_lang_ext('dmzx/whovisitedthistopic', 'common');

		$member = $event['member'];
		$user_id = (int) $member['user_id'];
		$value = $this->config['whovisitedthistopic_visit_value'];

		if ($this->auth->acl_get('u_whovisitedthistopic_profile') && $this->config['whovisitedthistopic_allow_memberpage'])
		{
			$sql_list = array(
				'SELECT'	=> 'ft.*, tt.*, wt.*',
				'FROM'		=> array(
					FORUMS_TABLE	=> 'ft',
					TOPICS_TABLE	=> 'tt',
					$this->whovisitedthistopic_table	=> 'wt',
				),
				'WHERE' => 'tt.topic_moved_id = 0 AND tt.topic_visibility = 1 AND wt.user_id = ' . $user_id . '	AND wt.topic_id = tt.topic_id AND ft.forum_id = tt.forum_id',
				'ORDER_BY'	=> 'wt.date DESC',
			);

			if ($this->user->data['is_registered'] && $this->config['load_db_lastread'])
			{
				$sql_list['LEFT_JOIN'][] = array('FROM' => array(TOPICS_TRACK_TABLE => 'ttt'), 'ON' => 'ttt.topic_id = tt.topic_id AND ttt.user_id = ' .	(int) $this->user->data['user_id']);
				$sql_list['LEFT_JOIN'][] = array('FROM' => array(FORUMS_TRACK_TABLE => 'ftt'), 'ON' => 'ftt.forum_id = ft.forum_id AND ftt.user_id = ' .	(int) $this->user->data['user_id']);
				$sql_list['SELECT'] .= ', ttt.mark_time, ftt.mark_time as f_mark_time';
			}
			else if ($this->config['load_anon_lastread'] || $this->user->data['is_registered'])
			{
				$tracking_topics = $this->request->variable($this->config['cookie_name'] . '_track', '', true, \phpbb\request\request_interface::COOKIE);
				$tracking_topics = $tracking_topics ? tracking_unserialize($tracking_topics) : array();
			}
			$sql_list_query = $this->db->sql_build_query('SELECT', $sql_list);
			$result = $this->db->sql_query_limit($sql_list_query, $value);

			$icons = $this->cache->obtain_icons();
			$rowset = array();

			while ($sql_list = $this->db->sql_fetchrow($result))
			{
				$topic_id = $sql_list['topic_id'];
				$forum_id = $sql_list['forum_id'];
				$rowset[$topic_id] = $sql_list;

				if ($this->user->data['is_registered'] && $this->config['load_db_lastread'] && !$this->config['similar_topics_cache'])
				{
					$topic_tracking_info = get_topic_tracking($forum_id, $topic_id, $rowset, array($forum_id => $sql_list['f_mark_time']));
				}
				else if ($this->config['load_anon_lastread'] || $this->user->data['is_registered'])
				{
					$topic_tracking_info = get_complete_topic_tracking($forum_id, $topic_id);
					if (!$this->user->data['is_registered'])
					{
						$this->user->data['user_lastmark'] = isset($tracking_topics['l']) ? ((int) base_convert($tracking_topics['l'], 36, 10) + (int) $this->config['board_startdate']) : 0;
					}
				}

				$replies = $this->content_visibility->get_count('topic_posts', $sql_list, $forum_id) - 1;

				$folder_img = $folder_alt = $topic_type = '';
				$unread_topic = isset($topic_tracking_info[$topic_id]) && $sql_list['topic_last_post_time'] > $topic_tracking_info[$topic_id];
				topic_status($sql_list, $replies, $unread_topic, $folder_img, $folder_alt, $topic_type);

				$topic_unapproved = $sql_list['topic_visibility'] == ITEM_UNAPPROVED;
				$posts_unapproved = $sql_list['topic_visibility'] == ITEM_APPROVED && $sql_list['topic_posts_unapproved'];
				$u_mcp_queue = ($topic_unapproved || $posts_unapproved) ? append_sid("{$this->root_path}mcp.{$this->phpEx}", 'i=queue&amp;mode=' . ($topic_unapproved ? 'approve_details' : 'unapproved_posts') . "&amp;t=$topic_id", true, $this->user->session_id) : '';

				$base_url = append_sid("{$this->root_path}viewtopic.{$this->phpEx}", 'f=' . $forum_id . '&amp;t=' . $topic_id);

				$this->template->assign_block_vars('whovisitedthistopic',array(
					'TOPIC_REPLIES'			=> $replies,
					'TOPIC_VIEWS'			=> $sql_list['topic_views'],
					'TOPIC_TITLE'			=> censor_text($sql_list['topic_title']),
					'FORUM_TITLE'			=> $sql_list['forum_name'],

					'TOPIC_AUTHOR_FULL'		=> get_username_string('full', $sql_list['topic_poster'], $sql_list['topic_first_poster_name'], $sql_list['topic_first_poster_colour']),
					'FIRST_POST_TIME'		=> $this->user->format_date($sql_list['topic_time']),
					'LAST_POST_TIME'		=> $this->user->format_date($sql_list['topic_last_post_time']),
					'LAST_POST_AUTHOR_FULL'	=> get_username_string('full', $sql_list['topic_last_poster_id'], $sql_list['topic_last_poster_name'], $sql_list['topic_last_poster_colour']),

					'S_HAS_POLL'			=> (bool) $sql_list['poll_start'],

					'S_TOPIC_REPORTED'		=> !empty($sql_list['topic_reported']) && $this->auth->acl_get('m_report', $forum_id),
					'S_TOPIC_UNAPPROVED'	=> $topic_unapproved,
					'S_POSTS_UNAPPROVED'	=> $posts_unapproved,
					'S_UNREAD_TOPIC'		=> $unread_topic,

					'TOPIC_ICON_IMG'		=> (!empty($icons[$sql_list['icon_id']])) ? $icons[$sql_list['icon_id']]['img'] : '',
					'TOPIC_ICON_IMG_WIDTH'	=> (!empty($icons[$sql_list['icon_id']])) ? $icons[$sql_list['icon_id']]['width'] : '',
					'TOPIC_ICON_IMG_HEIGHT'	=> (!empty($icons[$sql_list['icon_id']])) ? $icons[$sql_list['icon_id']]['height'] : '',
					'ATTACH_ICON_IMG'		=> ($this->auth->acl_get('u_download') && $this->auth->acl_get('f_download', $forum_id) && $sql_list['topic_attachment']) ? $this->user->img('icon_topic_attach', $this->user->lang('TOTAL_ATTACHMENTS')) : '',
					'UNAPPROVED_IMG'		=> ($topic_unapproved || $posts_unapproved) ? $this->user->img('icon_topic_unapproved', $topic_unapproved ? 'TOPIC_UNAPPROVED' : 'POSTS_UNAPPROVED') : '',

					'TOPIC_IMG_STYLE'		=> $folder_img,
					'TOPIC_FOLDER_IMG'		=> $this->user->img($folder_img, $folder_alt),
					'TOPIC_FOLDER_IMG_ALT'	=> $this->user->lang($folder_alt),

					'U_NEWEST_POST'			=> append_sid("{$this->root_path}viewtopic.{$this->phpEx}", 'f=' . $forum_id . '&amp;t=' . $topic_id . '&amp;view=unread') . '#unread',
					'U_LAST_POST'			=> append_sid("{$this->root_path}viewtopic.{$this->phpEx}", 'f=' . $forum_id . '&amp;t=' . $topic_id . '&amp;p=' . $sql_list['topic_last_post_id']) . '#p' . $sql_list['topic_last_post_id'],
					'U_VIEW_TOPIC'			=> append_sid("{$this->root_path}viewtopic.{$this->phpEx}", 'f=' . $forum_id . '&amp;t=' . $topic_id),
					'U_VIEW_FORUM'			=> append_sid("{$this->root_path}viewforum.{$this->phpEx}", 'f=' . $forum_id),
					'U_MCP_REPORT'			=> append_sid("{$this->root_path}mcp.{$this->phpEx}", 'i=reports&amp;mode=reports&amp;f=' . $forum_id . '&amp;t=' . $topic_id, true, $this->user->session_id),
					'U_MCP_QUEUE'			=> $u_mcp_queue,
				));

				$this->pagination->generate_template_pagination($base_url, 'whovisitedthistopic.pagination', 'start', $replies + 1, $this->config['posts_per_page'], 1, true, true);
			}
			$this->db->sql_freeresult($result);

			$this->template->assign_var('PERMISSION_PROFILE', true);
		}

		$this->template->assign_vars(array(
			'WHOVISITEDTHISTOPIC_VISIT_TITLE'	=> $this->user->lang('WHOVISITEDTHISTOPIC_VISIT_TITLE', $value),
			'NEWEST_POST_IMG'					=> $this->user->img('icon_topic_newest', 'VIEW_NEWEST_POST'),
			'LAST_POST_IMG'						=> $this->user->img('icon_topic_latest', 'VIEW_LATEST_POST'),
			'REPORTED_IMG'						=> $this->user->img('icon_topic_reported', 'TOPIC_REPORTED'),
			'POLL_IMG'							=> $this->user->img('icon_topic_poll', 'TOPIC_POLL'),
			'PHPBB_IS_32'						=> ($this->files_factory !== null) ? true : false,
		));
	}
}
