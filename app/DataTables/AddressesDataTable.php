<?php

namespace App\DataTables;

use App\Models\Address;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AddressesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', '
                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                    <a class="btn btn-success" id="option_a1" href="{{Route("addresses.edit",$id)}}"> edit </a>
                    <a class="btn btn-primary" id="option_a2" href="{{Route("addresses.show",$id)}}"> show </a>
                    <form method="post" class="delete_item"  id="option_a3" action="{{Route("addresses.destroy",$id)}}">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger" onclick="modalShow(event)" id="delete_{{$id}}" data-bs-toggle="modal" data-bs-target="#exampleModal">delete</button>
                    </form>
                </div>')
            ->addColumn('area', function (Address $address) {
                return $address->area->name;
            })
            ->addColumn('user', function (Address $address) {
                return $address->user->name;
            })
            ->addColumn('ismain', function (Address $address) {
                return $address->is_main;
            })


            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Address $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('addresses-table')
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
        return [
            Column::make('id'),
            Column::make('street_name'),
            Column::make('building_number'),
            Column::make('floor_number'),
            Column::make('flat_number'),
            Column::computed('ismain',"Is Main"),
            Column::computed('area',"Area"),
            Column::computed('user',"User name"),

//            Column::make('created_at'),
//            Column::make('updated_at')
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Addresses_' . date('YmdHis');
    }
}
