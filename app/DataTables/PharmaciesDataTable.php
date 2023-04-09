<?php

namespace App\DataTables;

use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Notifications\Action;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PharmaciesDataTable extends DataTable
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
                <div class="btn-group btn-group-toggle " data-toggle="buttons">
                    <a class="btn btn-success rounded" id="option_a1" href="{{Route("pharmacies.edit",$id)}}" title="edit"> <i class="bi bi-pencil-square"></i> </a>
                    <a class="btn btn-primary rounded mx-1" id="option_a2" href="{{Route("pharmacies.show",$id)}}" title="show"> <i class="bi bi-file-earmark-text-fill"></i> </a>
                    <form method="post" class="delete_item"  id="option_a3" action="{{Route("pharmacies.destroy",$id)}}">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger" onclick="modalShow(event)" id="delete_{{$id}}" data-bs-toggle="modal" data-bs-target="#exampleModal" title="delete"><i class="bi bi-trash3"></i></button>
                    </form>
                </div>')->setRowId('id')
            ->addColumn('owner_name', function (Pharmacy $pharmacy) {
                return $pharmacy->owner->name;
            })->addColumn("avatar_image", function (Pharmacy $pharmacy){
                return '
                    <div class="user-panel  d-flex">
                        <div class="image">
                            <img src="'.asset("/storage/avatars/".$pharmacy->owner->avatar_image).'" class="img-circle elevation-2" alt="User Image">
                        </div>
                    </div>';
            })->addColumn('area_name', function (Pharmacy $pharmacy) {
                return $pharmacy->area->name;
            })->addColumn('phone', function (Pharmacy $pharmacy) {
                return $pharmacy->owner->phone;
            })->addColumn('email', function (Pharmacy $pharmacy) {
                return $pharmacy->owner->email;
            })->rawColumns(['avatar_image', 'action']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Pharmacy $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('pharmacies-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
            Column::computed("avatar_image")->exportable(false)->printable(false),
            Column::make('name'),
            Column::make('area_name'),
            Column::make('owner_name'),
            Column::make('priority'),
            Column::make('phone'),
            Column::make('email'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }
    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Pharmacies_' . date('YmdHis');
    }
}
