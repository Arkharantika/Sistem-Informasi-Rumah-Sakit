<!-- Halaman Ini Sudah Sesuai Tata Penulisan -->

@extends('layouts.backend')

@section('data')
{{ $complete->nama_lengkap }}
@endsection

@if(($complete->status ?? '') != 'biasa' && ($complete->verified ?? '') == 'yes')
@section('status')
{{ $complete->status }} &nbsp;&&nbsp; {{ $user->role }}
@endsection
@else
@section('status')
{{ $user->role }}
@endsection
@endif

@section('content')
<!--Container-->
<div class="container">

    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="font 50">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item active" aria-current="page">
                        <div class="btn btn-outline-dark">Halaman Find Sensor </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="ms-auto">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary btn-lg ">
                    <i class='bx bxs-bell '></i> Notifications</button>
                <button type="button" class="btn btn-secondary split-bg-secondary dropdown-toggle dropdown-toggle-split"
                    data-bs-toggle="dropdown">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
            </div>
        </div>
        <!--end breadcrumb-->
    </div>
    <!--end Container-->

    @if(session()->get('message'))
    <div class="alert alert-info alert-dismissable mt-20" role="alert">
        <h4>{{ session()->get('message') }} </h4>
    </div>
    @endif

    <!-- Page Break -->
    <hr />
    <p class="mb-0 text-uppercase display-5 text-center">Find Sensor</p>
    <hr />
    <!-- end of Page Break -->

    <!-- Shortcut -->

    <div class="card">
        <div class="card-body">
            <form method="post" action="{{url('/loaddata')}}" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="row mb-3 row-cols-xl-4">
                    <div class="col-sm-3 ">
                        <h6 class="mb-0"><i class='bx bxs-circle '></i> Date From</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                        <h6 class="mb-0"><i class='bx bxs-circle '></i> Date End</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                        <h6 class="mb-0"><i class='bx bxs-circle '></i> Hardware</h6>
                    </div>
                </div>
                <div class="row mb-3 row-cols-xl-4">
                    <div class="col-sm-3 ">
                        <input type="datetime-local" class="form-control" value="" name="start_date" id="" required>
                    </div>
                    <div class="col-sm-3 text-secondary">
                        <input type="datetime-local" class="form-control" value="" name="end_date" id="" required>
                    </div>
                    <div class="col-sm-3 text-secondary">
                        <select class="form-select form-select-sm mb-3" aria-label=".form-select-sm example"
                            name="hardware" id="option" value="" required>
                            <option value="4001">4001</option>
                            <option value="4002">4002</option>
                            <option value="4003">4003</option>
                            <option value="" selected disabled hidden></option>
                        </select>
                    </div>
                    <div class="col-sm-3 text-secondary">
                        <!-- <a href="#" class="btn btn-outline-success"> Buat Pembayaran</a> -->
                        <input type="submit" class="btn btn-outline-success" value="Load Data" />
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="col-sm-3 ">
                <h6 class="mb-0"><i class='bx bxs-circle '></i> Graphical Chart</h6>
            </div>
            <hr />
            <canvas id="myChart" width="800" height="400"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="col-sm-3 ">
                <h6 class="mb-0"><i class='bx bxs-circle '></i> Geolocation</h6>
            </div>
            <hr />
            <iframe width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.311172016625!2d{{ $longitude }}!3d{{ $latitude }}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2598c27f5f0ef%3A0x47a0f6ae8c8009bf!2sLocation!5e0!3m2!1sen!2sus!4v1671220374408!5m2!1sen!2sus">
            </iframe>
        </div>
    </div>

</div>

@section('CustomScripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Get the data from the PHP variable passed to the view
        var simplifiedData = @json($simplifiedData);

        // Function to generate a chart
        function generateChart(data) {
            var dates = Object.keys(data);
            var datasets = [];

            // Loop through the data and create datasets for each sensor
            for (var sensor in data[dates[0]]) {
                var values = [];
                for (var date of dates) {
                    values.push(data[date][sensor].value);
                }
                datasets.push({
                    label: sensor,
                    data: values,
                    borderColor: getRandomColor(),
                    fill: false
                });
            }

            // Create the chart
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: dates,
                    datasets: datasets
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
                    legend: {
                        display: true, // Display the legend
                    },
                }
            });
        }

        // Function to generate random colors
        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }

        // Call the function to generate the chart
        generateChart(simplifiedData);
    });
</script>


@endsection


@endsection