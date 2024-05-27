@extends('include.master')
@section('style-area')
    <style>
        .container {
            margin-top: 10px;
        }

        .table-responsive {
            margin-top: 20px;
        }

        .total-income {
            text-align: right;
            font-size: 20px;
            font-weight: bold;
        }

        .pagination {
            justify-content: center;
        }
    </style>
@endsection
@section('content')
    <main class="s-layout__content">
        <div class="py-3">
            <div class="container">
                <h1>Transactions</h1>
                <div class="total-income">
                    Total Income Earned: <span id="total-income">0</span>
                </div>
                <div class="table-responsive">
                    <table id="transactions-table" class="table table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Date & Time</th>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Remaining Balance</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows will be populated here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script-area')
    <script>
        $(document).ready(function() {
            // Example data - Replace this with actual data fetching logic
            const transactions = [{
                    dateTime: '01/01/2024, 10:00 AM',
                    type: 'Credit',
                    amount: 1000,
                    balance: 5000,
                    description: 'Salary'
                },
                {
                    dateTime: '02/01/2024, 12:00 PM',
                    type: 'Debit',
                    amount: 500,
                    balance: 4500,
                    description: 'Grocery'
                },
                // Add more transactions here
            ];

            let totalIncome = 0;
            const table = $('#transactions-table').DataTable({
                data: transactions,
                columns: [{
                        data: null
                    },
                    {
                        data: 'dateTime'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'amount',
                        render: $.fn.dataTable.render.number(',', '.', 2, 'Rs. ')
                    },
                    {
                        data: 'balance',
                        render: $.fn.dataTable.render.number(',', '.', 2, 'Rs. ')
                    },
                    {
                        data: 'description'
                    }
                ],
                columnDefs: [{
                    targets: 0,
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                }],
                drawCallback: function(settings) {
                    totalIncome = transactions.reduce((acc, transaction) => acc + (transaction.type ===
                        'Credit' ? transaction.amount : 0), 0);
                    $('#total-income').text(totalIncome.toLocaleString('en-IN', {
                        style: 'currency',
                        currency: 'INR'
                    }));
                },
                pagingType: 'full_numbers',
                language: {
                    paginate: {
                        first: 'First',
                        last: 'Last',
                        next: '>',
                        previous: '<'
                    },
                    emptyTable: 'No Record found.'
                }
            });

            table.on('draw', function() {
                const info = table.page.info();
                table.column(0, {
                    search: 'applied',
                    order: 'applied',
                    page: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1 + info.start;
                });
            }).draw();
        });
    </script>
@endsection
