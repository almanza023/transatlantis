<?php

namespace App\Exports;

use App\Order;
use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;

class OrdersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
    
    }
}
