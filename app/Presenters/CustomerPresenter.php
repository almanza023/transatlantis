<?php

namespace App\Presenters;

use Illuminate\Support\HtmlString;

class CustomerPresenter extends Presenter
{

    public function typeCustomer()
    {
        return $this->checkTypeCustomer() ? $this->isNatural() : $this->isJuridico();
    }

    public function checkTypeCustomer()
    {
        if ($this->model->full_name != '') {
            return false;
        }
        return true;
    }

    public function isNatural()
    {
        return new HtmlString("<span class='col-black'>{$this->model->name_complete}</span>");
    }

    public function isJuridico()
    {
        return new HtmlString("<span class='col-black'>{$this->model->name_complete} ({$this->model->full_name})</span>");
    }

}
