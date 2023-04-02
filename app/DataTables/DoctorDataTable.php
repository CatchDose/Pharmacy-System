<?php

namespace App\DataTables;


use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class DoctorDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
//        dd(new EloquentDataTable($query));

        return (new EloquentDataTable($query))

            ->addColumn('action', function (User $doctor){
                return $this->toggleBan($doctor->id) . '
                    <a class="btn btn-success" id="option_a1" href="' .route("doctors.edit",$doctor->id).'"> edit </a>
                    <form method="post" class="delete_item"  id="option_a3" action="' .route("doctors.destroy",$doctor->id).'">
                        <input type="hidden" name="_token" value="' .csrf_token(). '">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="modalShow(event)" id="delete_ ' . $doctor->id . '" data-bs-toggle="modal" data-bs-target="#exampleModal">delete</button>
                    </form>
                </div>';
            })
            ->addColumn('pharmacy', function ($user) {
                return $user->pharmacy->name;
            })
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model): QueryBuilder
    {

        if (auth()->user()->hasRole("pharmacy")) {
            return $model->where("pharmacy_id", "=", auth()->user()->pharmacy_id)->whereHas('roles', function ($role) {
                return $role->where("name", "doctor");
            });
        } else {
            return $model->newQuery()->whereHas('roles', function ($role) {
                return $role->where("name", "doctor");
            });
        }
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('doctors-table')
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
            Column::make('name'),
            Column::make('national_id'),
            Column::make('email'),
            Column::computed('pharmacy')->visible(auth()->user()->hasRole("admin")),
            Column::make('created_at'),
            Column::make('updated_at'),
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
        return 'Doctor_' . date('YmdHis');
    }


    private function toggleBan($id)
    {
        if(User::find($id)->isBanned()){
         return     '<div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <form method="post" class="ban_doctor"  id="option_a3" action="' .route("doctors.unban",$id).'">
                        <input type="hidden" name="_token" value="' .csrf_token(). '">
                        <input type="hidden" name="_method" value="PUT">
                      <button type="submit" class="btn btn-secondary">unban</button>
                    </form>';
        }

        return   '<div class="btn-group btn-group-toggle" data-toggle="buttons">
                      <form method="post" class="ban_doctor"  id="option_a3" action="' .route("doctors.ban",$id).'">
                        <input type="hidden" name="_token" value="' .csrf_token(). '">
                        <input type="hidden" name="_method" value="PUT">
                      <button type="submit" class="btn btn-info">ban</button>
                    </form>';


    }
}
