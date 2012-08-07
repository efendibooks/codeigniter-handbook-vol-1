<?php

class Account_Presenter extends Presenter
{
	public function title()
	{
		return $this->bank->get($this->account->bank_id)->name . "-" . $account->title;
	}

	public function name()
	{
		return $this->account->name ?: "N/A";
	}

	public function number()
	{
		return $this->account->number ?: "N/A";
	}

	public function sort_code()
	{
		if ($sc = $this->account->sort_code)
		{
			return substr($sc, 0, 2) . "-" . substr($sc, 2, 2) . "-" . substr($sc, 4, 2);
		}
		else
		{
			return "N/A";
		}
	}

	public function total_balance()
	{
		return ($this->account->total_balance) ? "&pound;" . number_format($this->account->total_balance) : "N/A";
	}

	public function available_balance()
	{
		return ($this->account->available_balance) ? "&pound;" . number_format($this->account->available_balance) : "N/A";
	}

	public function statements_link()
	{
		if ($this->statements->count_by('account_id', $this->account->id))
		{
			return anchor('/statements/' . $this->account->id, 'View Statements');
		}
		else
		{
			return "Statements Not Currently Available";
		}
	}
}