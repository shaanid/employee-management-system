@extends('admin.layout')
@section('content')
    <link rel="stylesheet" href="/css/designationstyle.css">

    <form method="POST" action="{{ route('designation-details.store') }}">
        @csrf

        <div class="container table shadow-page">
            <table class="table">
                <thead>
                    <tr>
                        <div class="form-group">
                            <th><label for="name">Designation</label></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" class="form-control" id="designation" name="designation">
                            @error('designation')
                                <p class="alert alert-danger">{{ $message }} </p>
                            @enderror
        </div>
        <br>
        <div class="text-center">
            <button type="submit" class="btn btn-sm btn-outline-primary">Submit</button></td>
        </div>
        </tr>
        </tbody>
        </table>
        </div>
    </form>

    @include('admin.footer')
@endsection
