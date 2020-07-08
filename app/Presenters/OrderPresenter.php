<?php

namespace App\Presenters;

use Illuminate\Support\HtmlString;

class OrderPresenter extends Presenter
{

    public function priority()
    {
        $priority = $this->model->priority;
        if ($priority == 1) {
            return $this->textPriority('ALTA', 'cyan');
        }

        if ($priority >= 2 && $priority <= 5) {
            return $this->textPriority('MEDIA', 'blue');
        }

        if ($priority >= 6 && $priority <= 10) {
            return $this->textPriority('BAJA', 'teal');
        }

        if ($priority == 0) {
            return $this->textPriority('SIN ASIGNAR', 'red');
        }

    }

    public function isTypeCustomer()
    {
        if ($this->model->type_customer == 'Natural') {
            return $this->customerNatural();
        } else {
            return $this->customerJuridico();
        }
    }

    public function status()
    {
        $status = $this->model->name;


        if ($status == 'Cotización') {
            return $this->textStatus($status, 'deep-purple');
        }

        if ($status == 'Pre-Orden') {
            return $this->textStatus($status, 'red');
        }

        if ($status == 'Rechazado') {
            return $this->textStatus($status, 'purple');
        }

        if ($status == 'Aprobado') {
            return $this->textStatus($status, 'green');
        }

        if ($status == 'Compra') {
            return $this->textStatus($status, 'pink');
        }

        if ($status == 'Agendado') {
            return $this->textStatus($status, 'indigo');
        }

        if ($status == 'Entregado (C)') {
            return $this->textStatus($status, 'deep-purple');
        }

        if ($status == 'Facturado') {
            return $this->textStatus($status, 'deep-purple');
        }

        if ($status == 'Aprobación de Cliente') {
            return $this->textStatus($status, 'deep-purple');
        }

    }

    public function typeStatusAprobado()
    {
        $status = $this->model->name;

        if ($status == 'Aprobado') {
            return $this->linkStatusRechazado();

        }

        if ($status == 'Pre-Orden') {
            return $this->linkStatusNoAprobado();

        }

        if ($status == 'Rechazado') {
            return $this->linkStatusAprobado();
        }

        if ($status == 'Compra') {
            return $this->linkStatusCompra();
        }

        if ($status == 'Agendado') {
            return '';
        }

        if ($status == 'Entregado (C)') {
            return $this->linkStatusEntregado();
        }

        if ($status == 'Cotización') {
            return '';
        }

        if ($status == 'Facturado') {
            return '';
        }

    }

    public function customerJuridico()
    {
        if ($this->model->full_name) {
            return new HtmlString("<span class='font-bold font-italic col-purple'>{$this->model->first_name} {$this->model->last_name} ({$this->model->full_name})</span>");
        } else {
            return $this->customerNatural();
        }
    }

    public function hasDiscount()
    {
        if ($this->model->discount) {
            return $this->textDiscount($this->model->discount);
        } else {
            return $this->textNotDiscount();
        }
    }

    public function textDiscount($discount)
    {
        return new HtmlString("<span class='font-bold col-black'>" . $discount . "%</span>");
    }

    public function textNotDiscount()
    {
        return new HtmlString("<span class='font-bold col-black'>No tiene Descuento</span>");
    }

    public function textPriority($priority, $color)
    {
        return new HtmlString("<span class='tx-bold col-" . $color . "'>" . $priority . "</span>");
    }

    public function textStatus($status, $color)
    {
        return new HtmlString("<span class='tx-bold'>" . $status . "</span>");
    }

    public function customerNatural()
    {
        return new HtmlString("<span class='tx-bold font-italic col-teal'>{$this->model->first_name} {$this->model->last_name}</span>");
    }

    public function linkStatusAprobado()
    {
        return new HtmlString("<a data-toggle='tooltip' data-placement='top' data-original-title='Rechazado'  class='dropdown-item' disabled='disabled'><i class='fa fa-eye'></i>Rechazado</a>");
    }

    public function linkStatusNoAprobado()
    {
        return new HtmlString("<a href='#modalDetail' data-toggle='modal' type='button' id='btnapprove-{$this->model->id_order}' data-href='" . route('orders.show', $this->model->id_order) . "' class='dropdown-item btnapprove'><i class='fa fa-eye'  data-toggle='tooltip' data-placement='top' data-original-title='Aprobar/Rechazar Pedido'></i> Aprobar/Rechazar Pedido</a>"
            . " " .
            "<a data-toggle='tooltip' data-placement='top' id='btn_edit-{$this->model->id_order}' data-original-title='Editar' class='dropdown-item btn_edit' href='" . route('orders.edit', $this->model->id_order) . "'> <i class='fa fa-edit'></i> Editar </a>"
        );
    }

    public function linkStatusRechazado()
    {
        return new HtmlString("<a id='btn_compra-{$this->model->id_order}' href='#modalDetail' data-toggle='modal' data-href='" . route('purchase.create', $this->model->id_order) . "' class='dropdown-item'> <i class='fa fa-shopping-cart' data-toggle='tooltip' data-placement='top' data-original-title='Orden Compra'></i> Orden de Compra</a>");
    }

    public function linkStatusCompra()
    {
        return new HtmlString("<a id='btn_agenda-{$this->model->id_order}' href='#modalDetail' data-toggle='modal'  class='dropdown-item' data-href='" . route('despacho.create', $this->model->id_order) . "' class='dropdown-item'> <i class='fa fa-calendar' data-toggle='tooltip' data-placement='top' data-original-title='Agendar Vehiculo'></i> Agendar Vehiculo</a>");

    }

    public function linkStatusEntregado()
    {
        return new HtmlString("<a id='btn_invoice-{$this->model->id_order}' href='#modalInvoiceOrder' data-toggle='modal'  class='dropdown-item' data-id='" .  $this->model->id_order . "' data-href='" . route('order.total', $this->model->id_order) . "' data-total='" .  $this->model->total . "' class='dropdown-item invoice'> <i class='fa fa-paper-plane' data-toggle='tooltip' data-placement='top' data-original-title='Facturar'></i> Facturar</a>");

    }

}
