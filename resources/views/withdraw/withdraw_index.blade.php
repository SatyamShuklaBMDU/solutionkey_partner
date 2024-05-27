@extends('include.master')
@section('style-area')
    <style>
        .custom-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.5);
            transition: opacity 0.3s ease-in-out;
        }

        .custom-modal-content {
            position: relative;
            top: 20%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            max-width: 100%;
        }

        .custom-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .custom-modal-header h5 {
            margin: 0;
        }

        .custom-modal-body {
            margin-top: 10px;
        }

        .custom-modal-footer {
            margin-top: 20px;
            text-align: right;
        }
    </style>
@endsection
@section('content')
    <main class="s-layout__content">
        <div class="py-3">
            <h2>Withdraw</h2>
            <div class="container mt-3">
                <div class="row mb-4">
                    <div class="col-md-3">
                        <label for="from-date" class="form-label">From Date</label>
                        <input type="text" id="from-date" class="form-control" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="col-md-3">
                        <label for="to-date" class="form-label">To Date</label>
                        <input type="text" id="to-date" class="form-control" placeholder="dd-mm-yyyy">
                    </div>
                    <div class="col-md-3">
                        <label for="status" class="form-label">Search By Status</label>
                        <select id="status" class="form-select">
                            <option value="credited">Credited</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="extra-status" class="form-label">Search By Status</label>
                        <select id="extra-status" class="form-select">
                            <option value="">--Select Status--</option>
                        </select>
                    </div>
                    <div class="col-md-12 mt-3 text-end">
                        <button id="clear-filters" class="btn text-light" style="background: #243e56;">Clear Filters</button>
                        <button id="withdraw" class="btn btn-warning">Withdraw</button>
                    </div>
                </div>
                <table id="withdraw-table" class="table table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Date & Time</th>
                            <th>Amount</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <div class="custom-modal" id="withdrawModal">
        <div class="custom-modal-content">
            <div class="custom-modal-header">
                <h5 class="modal-title">Enter Amount</h5>
                <button type="button" class="btn-close" id="closeModal" aria-label="Close"></button>
            </div>
            <div class="custom-modal-body">
                <form id="withdrawForm">
                    <div class="mb-3">
                        <label for="withdrawAmount" class="form-label">Amount (min 1000 Rs)</label>
                        <input type="number" class="form-control" id="withdrawAmount" min="1000" required>
                        <div class="invalid-feedback">
                            Please enter an amount of at least 1000 Rs.
                        </div>
                    </div>
                    <div class="custom-modal-footer">
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script-area')
    <script>
        $(document).ready(function() {
            $('#withdraw-table').DataTable();
            $('#from-date, #to-date').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD-MM-YYYY'
                },
                opens: 'left'
            });
            $('#clear-filters').on('click', function() {
                $('#from-date').val('');
                $('#to-date').val('');
                $('#status').val('credited');
                $('#extra-status').val('');
            });
            const withdraws = [{
                    id: 1,
                    dateTime: '10-04-2024, 10:00 AM',
                    amount: '100.00',
                    status: 'Completed'
                },
                {
                    id: 2,
                    dateTime: '11-04-2024, 11:00 AM',
                    amount: '200.00',
                    status: 'Pending'
                },
            ];
            const table = $('#withdraw-table').DataTable();
            table.clear();
            withdraws.forEach((withdraw, index) => {
                table.row.add([
                    index + 1,
                    withdraw.dateTime,
                    withdraw.amount,
                    withdraw.status
                ]).draw();
            });
            $('#withdraw').on('click', function() {
                $('#withdrawModal').fadeIn(300);
            });
            $('#closeModal').on('click', function() {
                $('#withdrawModal').fadeOut(0);
            });
            $('#withdrawForm').on('submit', function(e) {
                e.preventDefault();
                const amount = parseInt($('#withdrawAmount').val(), 10);
                if (amount >= 1000) {
                    alert('Withdrawal amount: ' + amount + ' Rs');
                    $('#withdrawModal').fadeOut(300);
                } else {
                    $('#withdrawAmount').addClass('is-invalid');
                }
            });

            $('#withdrawAmount').on('input', function() {
                if ($(this).val() >= 1000) {
                    $(this).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection
