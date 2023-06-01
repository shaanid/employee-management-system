@extends('admin.layout')
@section('content')
    <link rel="stylesheet" href="/css/designationstyle.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <div class="container shadow-page">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="hello">
                        <h3>Welcome {{ ucfirst(auth()->user()->name) }}!</h3>
                        <br>


                        <div class="container">
                            <div class="row">
                                <div class="col-md-4 col-xl-3">
                                    <div class="card bg-c-blue order-card">
                                        <div class="card-block">
                                            <h6 class="m-b-20">Total Employees</h6>
                                            <h2 class="text-right"><i class="fa fa-male"></i><span>
                                                    {{ $totalEmployees }}</span></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xl-3">
                                    <div class="card bg-c-yellow order-card">
                                        <div class="card-block">
                                            <h6 class="m-b-20">Total Designations</h6>
                                            <h2 class="text-right"><i class="fa fa-gears"></i><span>
                                                    {{ $totaldesignation }}</span></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xl-3">
                                    <div class="card bg-c-green order-card">
                                        <div class="card-block">
                                            <h6 class="m-b-20">Active Employees</h6>
                                            <h2 class="text-right"><i class="fa fa-group"></i><span>{{ count($activeMembers) }}</span></h2>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-xl-3">
                                    <div class="card bg-c-pink order-card">
                                        <div class="card-block">
                                            <h6 class="m-b-20">Inactive Employees</h6>
                                            <h2 class="text-right"><i class="fa fa-ban"></i><span> {{ count($inactiveMembers)}} </span></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <canvas id="chart"></canvas>


                    </div>

                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light text-center text-lg-start">
        <!-- Copyright -->
        <div class="text-center text-light p-3" style="background-color: #05263a">
            © Copyright:
            <a class="text-light">Employee Management System</a>
        </div>
        <!-- Copyright -->
    </footer>
@endsection
