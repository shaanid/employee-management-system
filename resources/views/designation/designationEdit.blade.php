@extends('admin.layout')
@section('content')
    <link rel="stylesheet" href="/css/designationstyle.css">

    <form method="POST" action="{{ route('designation-details.update',$designation) }}">
        @csrf
        @method('PUT')
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
                            <td><input type="text" class="form-control" value="{{ $designation->designation }}" id="designation"
                                name="designation"> <br>
                            </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-sm btn-outline-success">Update</button></td>
                        </div>
                    </tr>
                </tbody>
            </table>
        </div>
    </form>

  @include('admin.footer')
@endsection
