@extends('include.master')
@section('style-area')
    <link rel="stylesheet" href="{{ asset('css/earning.css') }}">
@endsection
@section('content')
    <main class="s-layout__content">
        <div class="py-3">
            <h2>Total Earning</h2>
            <div class="container mt-3">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label for="date-range" class="form-label">Date Range</label>
                        <input type="text" id="date-range" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label for="payment-mode" class="form-label">Payment Mode</label>
                        <select id="payment-mode" class="form-select">
                            <option value="all">All</option>
                            <!-- Add other payment modes here -->
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="user-type" class="form-label">User Type</label>
                        <select id="user-type" class="form-select">
                            <option value="all">All</option>
                            <!-- Add other user types here -->
                        </select>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="consultation-mode" class="form-label">Consultation Mode</label>
                        <select id="consultation-mode" class="form-select">
                            <option value="all">All</option>
                            <!-- Add other consultation modes here -->
                        </select>
                    </div>
                    <div class="col-md-12 mt-3 text-end">
                        <button id="get-result" class="btn" style="background: #243e56;">Get Result</button>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fs-2"><i
                                        class="fas fa-indian-rupee-sign text-light border rounded-circle fs-2 p-2" style="background-color: #ef2a82;"></i>
                                    Total Earnings</h5>
                                <p id="total-earnings" class="card-text fs-4">Rs. NaN</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title fs-2"><i
                                        class="fas fa-indian-rupee-sign text-light border rounded-circle fs-2 p-2 bg-warning"></i>
                                    Total Upcoming</h5>
                                <p id="total-upcoming" class="card-text fs-4">Rs. NaN</p>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="appointments-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Appointment Charge</th>
                            <th>Appointment Source</th>
                            <th>Consultation Mode</th>
                            <th>Payment Mode</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Earning</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
@section('script-area')
    <script>
        $(document).ready(function() {
            $('#appointments-table').DataTable();
            $('#date-range').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                },
                opens: 'left'
            });

            $('#get-result').on('click', function() {
                const appointments = [{
                        id: 1,
                        patientName: 'srta',
                        charge: 'Rs. 1.00',
                        source: 'FRANCHISE',
                        mode: 'Online',
                        paymentMode: 'Online',
                        status: 'completed',
                        date: '5/17/2024, 2:50:58 PM',
                        earning: 'Rs.'
                    },
                    {
                        id: 2,
                        patientName: 'sarita',
                        charge: 'Rs. 1.00',
                        source: 'FRANCHISE',
                        mode: 'Online',
                        paymentMode: 'Online',
                        status: 'completed',
                        date: '5/17/2024, 11:24:46 AM',
                        earning: 'Rs.'
                    },
                ];
                const table = $('#appointments-table').DataTable();
                table.clear();
                appointments.forEach(appointment => {
                    table.row.add([
                        appointment.id,
                        appointment.patientName,
                        appointment.charge,
                        appointment.source,
                        appointment.mode,
                        appointment.paymentMode,
                        appointment.status,
                        appointment.date,
                        appointment.earning
                    ]).draw();
                });
                document.getElementById('total-earnings').textContent =
                    'Rs. 7.00';
                document.getElementById('total-upcoming').textContent =
                    'Rs. 2.00';
            });
        });
    </script>
@endsection
