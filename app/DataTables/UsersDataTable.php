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

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        $query->where('id', '<>', 1);
        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('designation', function ($user) {
                return $user->designation ? $user->designation->designation : '';
            })
            ->addColumn('status', function ($user) {
                return view('employee.employeeStatus', compact('user'));
            })
            ->addColumn('action', function ($user) {
                return view('employee.employeeAction', compact('user'));
            })
            ->addColumn('select_all', function ($user) {
                return view('employee.employeeSelectall', compact('user'));
            })
            ->rawColumns(['action', 'designation', 'status', 'select_all']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(User $model)
    {
        $query = $model->newQuery();

        if ($this->request()->has('gender') && $this->request()->filled('gender')) {
            $gender = $this->request()->get('gender');
            $query->where('gender', $gender);
        }
        if ($this->request()->has('status') && $this->request()->filled('status')) {
            $status = $this->request()->get('status');
            $query->where('status', $status);
        }

        return $this->applyScopes($query);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
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

            Column::make('select_all')
                ->title('<label><input type="checkbox" id="select-all">
                            <span class="text-center"></span></label>')
                ->addClass('text-center')->width(20)->orderable(false)->printable(false)->exportable(false),
            Column::make('name'),
            Column::make('email'),
            Column::make('designation'),
            Column::make('dob'),
            Column::make('gender'),
            Column::make('phone'),
            Column::make('status')
                ->addClass('text-center'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
            // Column::make('created_at'),
            // Column::make('updated_at'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
