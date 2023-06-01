<?php

namespace App\DataTables;

use App\Models\Designation;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DesignationDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('action', function ($designation) {
                return view('designation.designationAction', compact('designation'));
            })
            ->addColumn('select_all', function ($designation) {
                return view('designation.designationSelectall', compact('designation'));
            })
            ->rawColumns(['action', 'select_all',]);
    }


    /**
     * Get the query source of dataTable.
     */
    public function query(Designation $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('designation-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            // ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
                Button::make('custom')->text('Delete')->action('function() {
                    deleteSelectedRows();
                }')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('select_all')->title('<label><input type="checkbox" id="select-all"><span class="text-center"></span></label>')
                ->addClass('text-center')->width(20)->orderable(false)->printable(false)->exportable(false),
            Column::make('designation'),
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
        return 'Designation_' . date('YmdHis');
    }
}
