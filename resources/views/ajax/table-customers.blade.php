<table class="table display responsive nowrap js-basic-example dataTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Dirección Facturación</th>
            <th>Email</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tfoot>
        <tr>
            <th>#</th>
            <th>Cliente</th>
            <th>Dirección Facturación</th>
            <th>Email</th>
            <th>Accion</th>
        </tr>
    </tfoot>
    <tbody>
        @foreach($customers as $customer)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$customer->present()->typeCustomer()}}</td>
            <td>
                {{$customer->address_invoice}}
            </td>
            <td>
                {{$customer->email}}
            </td>
            <td class="text-center">
                <a href="#modalDetail" data-toggle="modal"
				data-href="{{route('customers.show', $customer)}}"
				class="btn btn-oblong btn-info btn-sm"><i data-toggle="tooltip"
				data-placement="top" title="" data-original-title="Ver Detalle"
					class="fa fa-eye"></i></a>
				<a href='#modalDetail' data-toggle='modal' class='btn btn-oblong btn-warning btn-sm' data-href=" {{route('customers.edit', $customer->nid)}}"><i
                    class="fa fa-pencil" data-toggle="tooltip" data-placement="top" data-original-title="Editar"></i></a>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>