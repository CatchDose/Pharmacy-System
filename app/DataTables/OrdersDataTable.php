<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class OrdersDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
            ->addColumn('action', function (Order $order) {
                return $this->action($order->id, $order->status);
            })
            ->addColumn('Pharmacy', function (Order $order) {
                return $order->pharmacy->name ?? "N/A";
            })
            ->addColumn('User', function (Order $order) {
                return $order->user->name;
            })
            ->addColumn('creatorType', function (Order $order) {
                return $order->user->getRoleNames()[0] ?? "N/A";
            })
            ->addColumn('Address', function (Order $order) {
                return $order->user->addresses()->where('is_main', 1)->first()->street_name ?? "";
            })->addColumn('doctor_name', function (Order $order) {
                return $order->doctor->name ?? "N/A";
            })
            ->setRowId('id');
    }

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */

    function action($id, $status)
    {

        if (auth()->user()->hasRole('admin')) {

            if ($status == 'Confirmed') {

                return '<div>
                        <form method="post" id="option_a3" action="' . Route("orders.delivered", $id) . '">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="PUT">
                            <button type="submit" class="btn btn-dark w-100">Delivered</button>
                        </form>
                        </div>';

            } else {

                return '<div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a class="btn btn-success" id="option_a1" href="' . Route("orders.edit", $id) . '"> <i class="bi bi-pencil-square"></i> </a>
                                <a class="btn btn-primary" id="option_a2" href="' . Route("orders.show", $id) . '"title="show"> <i class="bi bi-file-earmark-text-fill"></i>  </a>
                                <form method="post" class="delete_item"  id="option_a3" action="' . Route("orders.destroy", $id) . '">
                                <input type="hidden" name="_token" value="' . csrf_token() . '">
                                <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger" onclick="modalShow(event)" id="delete_' . $id . '" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-trash3"></i></button>
                                </form>
                                </div>';
            }
        } else {

            if ($status == 'Confirmed') {

                return '<div>
                        <form method="post" id="option_a3" action="' . Route("orders.delivered", $id) . '">
                        <input type="hidden" name="_token" value="' . csrf_token() . '">
                        <input type="hidden" name="_method" value="PUT">
                            <button type="submit" class="btn btn-dark">Delivered</button>
                        </form>
                        </div>';
            } else {

                return '<div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <a class="btn btn-success" id="option_a1" href="' . Route("orders.edit", $id) . '"> edit </a>
                                <a class="btn btn-primary" id="option_a2" href="' . Route("orders.show", $id) . '"> show </a>
                                </div>';
            }

        }
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        if (auth()->user()->hasRole(["pharmacy", "doctor"])) {
            return $model->where("pharmacy_id", "=", auth()->user()->pharmacy_id);
        }
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('orders-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {

        $isAdmin = Auth::user()->hasRole('admin') ?? false;

        return [

            Column::make('id')->addClass('text-center'),
            Column::make('status')->addClass('text-center'),
            Column::make('is_insured')->addClass('text-center'),
            Column::computed('User', 'Client Name')->addClass('text-center'),
            Column::computed('Pharmacy', 'Assigned Pharmacy')->visible($isAdmin)->addClass('text-center'),
            Column::computed('creatorType', 'Creator Type')->visible($isAdmin)->addClass('text-center'),
            Column::computed('Address', 'Client Address')->addClass('text-center'),
            Column::make('doctor_name')->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
        ];

    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Orders_' . date('YmdHis');
    }
}
