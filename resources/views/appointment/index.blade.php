@extends('include.master')
@section('style-area')
    <style>
        table {
            width: 100%;
            overflow-x: scroll;
            /* Add horizontal scrollbar when table overflows */
        }

        table.dataTable tbody tr {
            background-color: #f9f9f9;
        }

        table.dataTable thead {
            background-color: #243e56;
            color: white;
        }

        table.dataTable td,
        table.dataTable th {
            padding: 10px !important;
        }

        .paid,
        .confirmed,
        .completed {
            color: green;
            font-weight: bold;
        }

        .refunded,
        .rejected {
            color: red;
            font-weight: bold;
        }

        .completed {
            color: blue;
        }

        .action-buttons {
            margin-top: 10px;
            /* Add some top margin for spacing */
        }

        .button-group {
            display: inline-block;
        }


        .btn-group button {
            padding: 5px 10px;
            border: none;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
        }

        .btn-group button:last-child {
            margin-right: 0;
        }

        .action-buttons .join-call {
            background-color: #007BFF;
            color: white;
        }

        .action-buttons .history {
            background-color: #FF5722;
            color: white;
        }

        .action-buttons .chat {
            background-color: #4CAF50;
            color: white;
        }

        .action-buttons .reschedule {
            background-color: #FFC107;
            color: white;
        }

        .action-buttons .prescription {
            background-color: #17A2B8;
            color: white;
        }

        .action-buttons .complete {
            background-color: #28A745;
            color: white;
        }

        @media screen and (max-width: 768px) {
            .action-buttons button {
                display: block;
                margin-bottom: 5px;
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes fadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }

        .custom-modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            animation-duration: 0.3s;
        }

        .custom-modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 25%;
        }

        .custom-modal.show {
            display: block;
            animation-name: fadeIn;
        }

        .custom-modal.hide {
            animation-name: fadeOut;
        }
    </style>
@endsection
@section('content')
    <main class="s-layout__content">
        <div class="py-3">
            <div class="container2">
                <h1>Appointment Table</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table responsive" style="width: 100%;overflow-x: scroll;">
                                <table id="appointment-table" class="display">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date & Time</th>
                                            <th>Appointment Id</th>
                                            <th>Patient Name</th>
                                            <th>Consultation Mode</th>
                                            <th>Payment Mode</th>
                                            <th>Payment Status</th>
                                            <th>Age</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="customModal" class="custom-modal">
        <div class="custom-modal-content">
            <div class="custom-modal-header d-flex">
                <h4 class="custom-modal-title">New message</h4>
                <button type="button" class="btn-close" style="margin-left: 8rem;" id="customModalClose"></button>
            </div>
            <div class="custom-modal-body">
                <form>
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Recipient:</label>
                        <input type="text" class="form-control" id="recipient-name">
                    </div>
                    <div class="mb-3">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message-text"></textarea>
                    </div>
                </form>
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="btn btn-secondary" id="customModalCloseBtn">Close</button>
                <button type="button" class="btn btn-primary">Send message</button>
            </div>
        </div>
    </div>
@endsection
@section('script-area')
    <script>
        $(document).ready(function() {
            $('#appointment-table').DataTable({
                "ajax": {
                    "url": "{{ url('/api/appointments') }}",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        "data": "datetime"
                    },
                    {
                        "data": "appointment_id"
                    },
                    {
                        "data": "patient_name"
                    },
                    {
                        "data": "consultation_mode"
                    },
                    {
                        "data": "payment_mode"
                    },
                    {
                        "data": "payment_status",
                        "render": function(data) {
                            return `<span class="${data.toLowerCase()}">${data}</span>`;
                        }
                    },
                    {
                        "data": "age",
                        "render": function(data, type, row) {
                            return `${row.age_years} Years ${row.age_months} Months`;
                        }
                    },
                    {
                        "data": "appointment_date"
                    },
                    {
                        "data": "appointment_status",
                        "render": function(data) {
                            return `<span class="${data.toLowerCase()}">${data}</span>`;
                        }
                    },
                    {
                        "data": null,
                        "defaultContent": `
                        <div class="action-buttons">
                            <div class="btn-group">
                                <button class="history"><a href="{{ route('get.appointment.history') }}">History</a></button>
                                <button class="btn reschedule openCustomModal" type="button">Reschedule</button>
                                <button class="prescription">Prescription</button>
                                <button class="complete">Complete</button>
                            </div>
                        </div>
                    `
                    }
                ]
            });
            const customModal = document.getElementById("customModal");
            const customModalClose = document.getElementById("customModalClose");
            const customModalCloseBtn = document.getElementById("customModalCloseBtn");

            $(document).on('click', '.openCustomModal', function() {
                customModal.classList.remove('hide');
                customModal.classList.add('show');
                customModal.style.display = "block";
            });

            function closeModal() {
                customModal.classList.remove('show');
                customModal.classList.add('hide');
                setTimeout(() => {
                    customModal.style.display = "none";
                    customModal.classList.remove('hide');
                }, 300); // Match the animation duration
            }

            customModalClose.onclick = function() {
                closeModal();
            }

            customModalCloseBtn.onclick = function() {
                closeModal();
            }

            window.onclick = function(event) {
                if (event.target == customModal) {
                    closeModal();
                }
            }
        });
    </script>
@endsection
