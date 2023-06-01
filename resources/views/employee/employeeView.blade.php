@extends('admin.layout')
@section('content')
    <link rel="stylesheet" href="/css/designationstyle.css">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="container shadow-page">
        <div class="card">
            <div class="card-header">
                <h5>Manage Users</h5>
            </div> <br>
            <div class="col">
                <a href="{{ route('employee-details.create') }}" class="btn btn-sm btn-outline-success text1">New</a>
                <a href="{{ route('user.select-all') }}" class="btn btn-sm btn-outline-danger"
                    id="delete-selected">Delete</a>
                <a href="{{ route('users.csv') }}" class="btn btn-sm btn-outline-secondary">CSV</a>
            </div>
            <br>

            <form>
                <div class="row">
                  <div class="col-3" style="width: 200px">
                    <div class="form-group text1" style="display: flex; align-items: center;">
                        <label><strong>Gender :</strong></label>&nbsp;&nbsp;
                        <select id='gender' name="gender" class="form-control " style="width: 80px">
                            <option value="">All</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>

                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group" style="display: flex; align-items: center;">
                        <label><strong>Status :</strong></label>&nbsp;&nbsp;&nbsp;
                        <select id='status' name="status" class="form-control " style="width: 80px">
                            <option value="">All</option>
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-outline-primary" style="margin-left: 10px;">Apply</button>
                    </div>
                  </div>
                </div>
            </form>

            <div class="card-body">
                {{ $dataTable->table(['class' => 'table table-hover']) }}
            </div>
        </div>
    </div>

    @include('admin.footer')

    <script>
        @push('scripts')
            {{ $dataTable->scripts() }}
        @endpush

        //Users status toggle
        $(document).on('change', '.status-toggle', function(e) {
            const $toggle = $(this);
            const userId = $toggle.data('id');
            const newStatus = $toggle.prop('checked') ? 'active' : 'inactive';
            $.ajax({
                type: 'POST',
                url: '{{ route('users.updateStatus') }}',
                data: {
                    userId,
                    status: newStatus,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    if (data.success) {
                        const updatedStatus = data.success.status;
                        $toggle.prop('checked', updatedStatus === 'active');
                    } else {
                        if (newStatus === 'inactive') {
                            toastr.error('User is inactive.', 'Inactive');
                        } else {
                            toastr.success('User is active.', 'Active');
                        }
                        $toggle.prop('checked', newStatus === 'active');
                    }
                },
            });
        });


        //Alerts
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif


        //DeleteConfirmation
        function deleteConfirmation(id) {
            event.preventDefault();
            Swal.fire({
                    title: 'Delete',
                    html: '<span style="font-weight: normal; font-size: 0.8em;">Do you really want to delete this item?</span>',
                    icon: 'error',
                    showCancelButton: true,
                    confirmButtonColor: 'red',
                    cancelButtonColor: 'gray',
                    confirmButtonText: 'Delete'
                })
                .then((result) => {
                    if (!result.isConfirmed) return;
                    $.ajax({
                        url: "/admin/employee-details/" + id,
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            _method: 'DELETE',
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            console.log(response);
                            Swal.fire({
                                    title: 'Deleted',
                                    text: 'Item deleted successfully',
                                    icon: 'success'
                                })
                                .then(() => location.reload());
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                            Swal.fire({
                                title: 'Error',
                                text: 'An error occurred while deleting the item',
                                icon: 'error'
                            });
                        }
                    });
                });
        }


        //deleteSelected
        $(document).ready(function() {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $('#users-table').on('click', '#select-all', function() {
                $('.select-checkbox').prop('checked', $(this).is(':checked'));
            });

            $('#delete-selected').click(function(e) {
                e.preventDefault();
                var selectedIds = $('.select-checkbox:checked').map(function() {
                        return $(this).data('id');
                    })
                    .get();
                if (selectedIds.length === 0) {
                    alert('Please select at least one user to delete.');
                    return;
                }
                if (confirm('Are you sure you want to delete the selected users?')) {
                    $.ajax({
                        url: '{{ route('user.select-all') }}',
                        type: 'POST',
                        data: {
                            selectedIds: selectedIds
                        },
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            alert(response.success);
                            selectedIds.forEach(function(id) {
                                $('#users-table tr[data-id="' + id + '"]').remove();
                            });
                            $('#users-table').DataTable().ajax.reload(null, false);
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr.responseText);
                        }
                    });
                }
            });
        });

        // document.getElementById('gender').addEventListener('change', function() {
        //     var selectedValue = this.value;
        //     this.form.submit();
        // });

    </script>
@endsection
