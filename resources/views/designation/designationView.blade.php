@extends('admin.layout')
@section('content')
<link rel="stylesheet" href="/css/designationstyle.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css">
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap5.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container shadow-page">
    <div class="card">
        <div class="card-header">
            <h5>Manage Designations</h5>
                </div> <br>
        <div class="col">
            <a href="{{ route('designation-details.create') }}" class="btn btn-sm btn-outline-success text1">New</a>
            <a href="{{route('designation.select-all')}}" class="btn btn-sm btn-outline-danger" id="delete-selected">Delete</a>
            <a href="{{ route('designations.csv') }}" class="btn btn-sm btn-outline-secondary">CSV</a>
            {{-- <a href="" class="btn btn-sm btn-outline-secondary">PDF</a> --}}


        </div>
        <div class="card-body">
            {{ $dataTable->table(['class' => 'table table-hover']) }}

        </div>
    </div>
</div>

@include('admin.footer')

<script>
    @push('scripts')
        {{$dataTable -> scripts()}}
    @endpush

    //Alerts
    @if(Session::has('message'))
    toastr.options = {
        "closeButton": true
        , "progressBar": true
    }
    toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('success'))
    toastr.options = {
        "closeButton": true
        , "progressBar": true
    }
    toastr.success("{{ session('success') }}");
    @endif

    //DeleteConfirmation
    function deleteConfirmation(id) {
        event.preventDefault();
        Swal.fire({
                title: 'Delete'
                , html: '<span style="font-weight: normal; font-size: 0.8em;">Do you really want to delete this item?</span>'
                , icon: 'error'
                , showCancelButton: true
                , confirmButtonColor: 'red'
                , cancelButtonColor: 'gray'
                , confirmButtonText: 'Delete'
            })
            .then((result) => {
                if (!result.isConfirmed) return;
                $.ajax({
                    url: "/admin/designation-details/" + id
                    , type: "POST"
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , data: {
                        _method: 'DELETE'
                        , _token: "{{ csrf_token() }}"
                    }
                    , success: function(response) {
                        console.log(response);
                        Swal.fire({
                                title: 'Deleted'
                                , text: 'Item deleted successfully'
                                , icon: 'success'
                            })
                            .then(() => location.reload());
                    }
                    , error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        Swal.fire({
                            title: 'Error'
                            , text: 'An error occurred while deleting the item'
                            , icon: 'error'
                        });
                    }
                });
            });
    }

    //deleteSelected
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        $('#designation-table').on('click', '#select-all', function() {
            $('.select-checkbox').prop('checked', $(this).is(':checked'));
        });

        $('#delete-selected').click(function(e) {
            e.preventDefault();
            var selectedIds = $('.select-checkbox:checked').map(function() {
                    return $(this).data('id');
                })
                .get();
            if (selectedIds.length === 0) {
                toastr.error('Please select at least one designation to delete.');
                return;
            }
            if (confirm('Are you sure you want to delete the selected designations?')) {
                $.ajax({
                    url: '{{ route("designation.select-all") }}'
                    , type: 'POST'
                    , data: {
                        selectedIds: selectedIds
                    }
                    , headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                    , success: function(response) {
                        toastr.success(response.success);
                        selectedIds.forEach(function(id) {
                            $('#designation-table tr[data-id="' + id + '"]').remove();
                        });
                        $('#designation-table').DataTable().ajax.reload(null, false);
                    }
                    , error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
@endsection
