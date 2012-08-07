<?php

require_once APPPATH . 'presenters/account_presenter.php';

class Accounts extends CI_Controller
{
	public function show($account_id)
	{
		$this->data['account'] = new Account_Presenter($this->account->get($account_id));
		$this->load->view('account/show', $this->data);
	}
}