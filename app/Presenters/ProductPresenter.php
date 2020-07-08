<?php


namespace App\Presenters;

use Illuminate\Support\HtmlString;


class ProductPresenter extends Presenter
{

    public function isActive()
    {
        if ($this->model->product_status) {
            return $this->productIsActive();
        } else {
            return $this->productIsNotActive();
        }
    }

    public function typePrice()
    {
        if ($this->model->type_price == 2) {
            return $this->priceFijo();
        }

        if ($this->model->type_price == 1) {
            return $this->priceTablePrice();
        }
    }

    public function priceFijo()
    {
        return new HtmlString("Fijo: <span class='col-blue'>{$this->formatPrice($this->model->price)}</span>");
    }

    public function priceTablePrice()
    {
        return new HtmlString("Especial: <span class='font-bold col-red'>{$this->formatPrice($this->model->priceActive->first()->price)}</span>");
    }

    public function formatPrice($price)
    {
        return "$" . number_format($price, 0);
    }

    public function productIsActive()
    {
        return new HtmlString("<a href='" . route('product.status', $this->model->id_product) . "' class='btn btn-oblong btn-success btn-sm' data-toggle='tooltip'
        data-placement='top' title='' data-original-title='Activo'><i class='fa fa-eye-slash'></i></a>");
    }

    public function productIsNotActive()
    {
        return new HtmlString("<a href='" . route('product.status', $this->model->id_product) . "' class='btn btn-oblong btn-danger btn-sm' data-toggle='tooltip'
        data-placement='top' title='' data-original-title='Inactivo'><i class='fa fa-ban'></i></a>");
    }

    public function textActiveProduct()
    {
        if ($this->model->product_status) {
            return $this->textActive();
        } else {
            return $this->textNotActive();
        }
    }

    public function textActive()
    {
       return new HtmlString("<span class='col-blue'>Activo</span>");
    }

    public function textNotActive()
    {
       return new HtmlString("<span class='font-bold col-red'>Inactivo</span>");
    }
}
