<?php
class ControllerExtensionModuleAbandonedCarts extends Controller
{
	private $error = array();

	public function install()
	{
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` ADD `abandoned`
			TINYINT(1) NOT NULL DEFAULT '0' AFTER `date_modified`;
		");

		// $this->model_user_user_group->addPermission($this->user->getGroupId(), 'access', 'report/' . $this->request->get['extension']);
		// $this->model_user_user_group->addPermission($this->user->getGroupId(), 'modify', 'report/' . $this->request->get['extension']);

		// $this->model_user_user_group->addPermission($this->user->getGroupId(), 
		// 'access', 'controller/extension/module/' . $this->request->get['extension']);
		// $this->model_user_user_group->addPermission($this->user->getGroupId(),
		//  'modify', 'controller/extension/module/' . $this->request->get['extension']);
	}

	public function uninstall()
	{
		$this->db->query("ALTER TABLE `" . DB_PREFIX . "order` DROP `abandoned`;
		");
	}


	public function index()
	{
		$this->load->language('extension/module/abandoned_carts');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('module_abandoned_carts', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		// allow the shop admin to specify which status(es) are deemed abandoned
		$this->load->model('localisation/order_status');

		$data['abandoned_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->error['limit'])) {
			$data['error_limit'] = $this->error['limit'];
		} else {
			$data['error_limit'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/module/abandoned_carts', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/module/abandoned_carts', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module', true);

		if (isset($this->request->post['module_abandoned_carts_criteria'])) {
			$data['module_abandoned_carts_criteria'] = $this->request->post['module_abandoned_carts_criteria'];
		} elseif ($this->config->get('module_abandoned_carts_criteria')) {
			$data['module_abandoned_carts_criteria'] = $this->config->get('module_abandoned_carts_criteria');
		} else {
			$data['module_abandoned_carts_criteria'] = array();
		}


		$abandoned_carts_limit = $this->config->get('module_abandoned_carts_limit');

		if (isset($this->request->post['module_abandoned_carts_limit'])) {
			$data['module_abandoned_carts_limit'] = $this->request->post['module_abandoned_carts_limit'];
		} elseif (!empty($abandoned_carts_limit)) {
			$data['module_abandoned_carts_limit'] = $this->config->get('module_abandoned_carts_limit');
		} else {
			$data['module_abandoned_carts_limit'] = 5;
		}

		// print_r($this->config->get('module_abandoned_carts_limit'));
		// exit();

		$abandoned_carts_status = $this->config->get('module_abandoned_carts_status');

		if (isset($this->request->post['module_abandoned_carts_status'])) {
			$data['module_abandoned_carts_status'] = $this->request->post['module_abandoned_carts_status'];
		} elseif (!empty($abandoned_carts_status)) {
			$data['module_abandoned_carts_status'] = $this->config->get('module_abandoned_carts_status');
		} else {
			$data['module_abandoned_carts_status'] = '';
		}

		$data['header']      = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer']      = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/module/abandoned_carts/abandoned_carts', $data));
	}

	protected function validate()
	{
		if (!$this->user->hasPermission('modify', 'extension/module/abandoned_carts')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		// print_r($this->request->post);
		// exit("\nDump validation");

		if ($this->request->post['module_abandoned_carts_limit'] < 1) {
			$this->error['limit'] = $this->language->get('error_limit');
		}
		return !$this->error;
	}
}
