<?php if ( ! defined('BASEPATH')) exit('No direct access allowed');

class Notifications extends Admin_Controller {

	public function __construct() {
		parent::__construct(); //  calls the constructor
		$this->load->library('user');
		$this->load->library('pagination');
		$this->load->model('Notifications_model');
	}

	public function index() {
		if (!$this->user->islogged()) {
  			redirect('login');
		}

    	if (!$this->user->hasPermissions('access', 'notifications')) {
//  			redirect('permission');
		}

		$url = '?';
		$filter = array();
		if ($this->input->get('page')) {
			$filter['page'] = (int) $this->input->get('page');
		} else {
			$filter['page'] = '';
		}

		if ($this->config->item('page_limit')) {
			$filter['limit'] = $this->config->item('page_limit');
		}

		$this->template->setTitle('Notifications');
		$this->template->setHeading('Notifications');
		$this->template->setButton('Mark all as read', array('class' => 'btn btn-primary', 'onclick' => '$(\'#list-form\').submit();'));

		$data['text_empty'] 		= 'There are no notifications available.';

		$data['notifications'] = array();
		$results = $this->Notifications_model->getList($filter);
		foreach ($results as $result) {
			$data['notifications'][] = array(
				'notification_id'	=> $result['notification_id'],
				'icon'				=> $result['icon'],
				'message'			=> $result['message'],
				'time'				=> $result['time'],
				'action'			=> $result['action'],
				'status'			=> $result['status'] === '1' ? 'read' : 'unread',
			);
		}

		$config['base_url'] 		= site_url('notifications').$url;
		$config['total_rows'] 		= $this->Notifications_model->getCount($filter);
		$config['per_page'] 		= $filter['limit'];

		$this->pagination->initialize($config);

		$data['pagination'] = array(
			'info'		=> $this->pagination->create_infos(),
			'links'		=> $this->pagination->create_links()
		);

		$this->template->setPartials(array('header', 'footer'));
		$this->template->render('notifications', $data);
	}

	public function recent() {
		if (!$this->user->islogged()) {
  			redirect('login');
		}

		$filter = array();
		if ($this->input->get('page')) {
			$filter['page'] = (int) $this->input->get('page');
		} else {
			$filter['page'] = '';
		}

		if ($this->config->item('page_limit')) {
			$filter['limit'] = $this->config->item('page_limit');
		}

		$data['text_empty'] 		= 'There are no new notifications available.';

		$data['notifications'] = array();
		$results = $this->Notifications_model->getList($filter);
		foreach ($results as $result) {
			$data['notifications'][] = array(
				'notification_id'	=> $result['notification_id'],
				'icon'				=> $result['icon'],
				'message'			=> $result['message'],
				'time'				=> $result['time'],
				'action'			=> $result['action'],
				'status'			=> $result['status'] === '1' ? 'read' : 'unread',
			);
		}

		$this->template->render('notifications', $data);
	}
}

/* End of file notifications.php */
/* Location: ./admin/controllers/notifications.php */