<?php


namespace App\Presenters;

use Illuminate\Support\HtmlString;

class ProviderPresenter extends Presenter
{

    public function isTypeProvider()
    {
        if ($this->model->typeProvider->type_provider == 'Juridico') {
            return $this->providerJuridico();
        } else {
            return $this->providerNatural();
        }
    }

    public function providerJuridico()
    {
        return new HtmlString("<li>Empresa:
        <span class='font-bold font-italic' style='color:purple;'><b>{$this->model->full_name}</b></span>
        </li>
        <li>Contacto: 
        <span class='font-bold font-italic' style='color:teal;'><b>{$this->model->name_complete}</b></span>
        </li>");
    }

    public function providerNatural()
    {
        return new HtmlString("<li>
        <span class='font-bold font-italic col-teal'>{$this->model->name_complete}</span>
        </li>");
    }

    public function isActive()
    {
        if ($this->model->provider_status) {
            return $this->providerisActive();
        } else {
            return $this->providerisNotActive();
        }
    }

    public function textActiveProvider()
    {
        if ($this->model->provider_status) {
            return $this->textActive();
        } else {
            return $this->textNotActive();
        }
    }

    public function textActive()
    {
       return new HtmlString("<span style='color:blue;'><b>Activo</b></span>");
    }

    public function textNotActive()
    {
       return new HtmlString("<span style='color:red;'><b>Inactivo</b></span>");
    }

    public function providerisActive()
    {
        return new HtmlString("<a href='" . route('provider.status', $this->model->nit) . "' class='btn btn-success btn-oblong btn-sm' data-toggle='tooltip'
        data-placement='top' title='' data-original-title='Activo'><i class='fa fa-eye'></i></a>");
    }

    public function providerisNotActive()
    {
        return new HtmlString("<a href='" . route('provider.status', $this->model->nit) . "' class='btn btn-danger btn-oblong btn-sm' data-toggle='tooltip'
        data-placement='top' title='' data-original-title='Inactivo'><i class='fa fa-eye-slash'></i></a>");
    }
}
