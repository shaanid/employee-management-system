@extends('admin.layout')
@section('content')
    <link rel="stylesheet" href="/css/designationstyle.css">

    <form method="POST" action="{{ route('employee-details.update',$user) }}">
        @csrf
        @method('PUT')
        <div class="shadow-page">
            <table class="table">
                <thead>
                    <tr>
                        <div class="form-group">
                            <th><h3>Edit Profile</h3></th>

                    </tr>
                </thead>
            </table>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                placeholder="Enter your name">
            @error('name')
                <p class="alert alert-danger">{{ $message }} </p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}"
                placeholder="Enter your email">
            @error('email')
                <p class="alert alert-danger">{{ $message }} </p>
            @enderror
        </div>

        <div class="form-group">
            <label for="Designation">Designation</label>
            <select class="form-control" id="designation" name="position_id">
                @foreach ($designations as $designation)
                    <option value="{{ $designation->id }}" {{ $user->position_id == $designation->id ? 'selected' : '' }}>
                        {{ $designation->designation }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="dob">Date of birth</label>
            <input type="date" name="dob" class="form-control" value="{{ $user->dob }}" id="dob">
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" id="gender" name="gender">
                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>

        <div class="form-group">
            <label for="name">Phone</label>
            <input type="tel" class="form-control" name="phone" value="{{ $user->phone }}" id="name"
                placeholder="Enter your phone">
            @error('phone')
                <p class="alert alert-danger">{{ $message }} </p>
            @enderror
        </div>
        <br>

        <div class="text-center">
        <button type="submit" class="btn btn-outline-success">Update</button>
        </div>
        </div>
    </form>

@include('admin.footer')
@endsection
