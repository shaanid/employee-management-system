@extends('admin.layout')
@section('content')
    <link rel="stylesheet" href="/css/designationstyle.css">

    <form method="POST" action="{{ route('employee-details.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="shadow-page">
            <table class="table">
                <thead>
                    <tr>
                        <div class="form-group">
                            <th>
                                <h3>Employee Register</h3>
                            </th>
                    </tr>
                </thead>
            </table>

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}"
                    placeholder="Enter your name">
                @error('name')
                    <p class="alert alert-danger">{{ $message }} </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"
                    placeholder="Enter your email">
                @error('email')
                    <p class="alert alert-danger">{{ $message }} </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password"
                    placeholder="Enter your password">
                @error('password')
                    <p class="alert alert-danger">{{ $message }} </p>
                @enderror
            </div>

            <div class="form-group">
                <label for="Designation">Designation</label>
                <select class="form-control" id="designation" name="position_id">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->designation }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="dob">Date of birth</label>
                <input type="date" name="dob" class="form-control" id="dob">
                @error('dob')
                <p class="alert alert-danger">{{ $message }} </p>
            @enderror
            </div>

            <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Phone</label>
                <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}" id="name"
                    placeholder="Enter your phone">
                @error('phone')
                    <p class="alert alert-danger">{{ $message }} </p>
                @enderror
            </div>
        </table>

        <div class="form-group">
            <label for="name">Profile Photo</label>
            <input class="form-control" type="file" id="formFileMultiple" multiple name="image">

        </div>
            <br>
            <div class="text-center">
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
        </div>





    </form>

@include('admin.footer')
@endsection
