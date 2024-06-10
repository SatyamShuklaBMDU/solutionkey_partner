@extends('include.master')

@section('style-area')
    <style>
        table {
            width: 100%;
            overflow-x: scroll;
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

        .btn {
            margin: 5px;
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
            margin: 1% auto;
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

        /* Switch Button CSS */
        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 20px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 12px;
            width: 12px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:checked+.slider:before {
            transform: translateX(14px);
        }
    </style>
@endsection

@section('content')
    <main class="s-layout__content">
        <div class="py-3">
            <div class="container2">
                <h1>Post's Table</h1>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table responsive" style="width: 100%; overflow-x: scroll;">
                                <table id="appointment-table" class="display">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date & Time</th>
                                            <th>Partner Id</th>
                                            <th>Partner Name</th>
                                            <th>Post Content</th>
                                            <th>Post Media</th>
                                            <th>Post Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
                <h4 class="custom-modal-title">Edit Post</h4>
                <button type="button" class="btn-close" style="margin-left: 13rem;" id="customModalClose"></button>
            </div>
            <div class="custom-modal-body">
                <form id="editPostForm">
                    <input type="hidden" name="id" id="post_id">
                    <div class="mb-3">
                        <label for="post_content" class="col-form-label">Post Content:</label>
                        <textarea name="post_content" id="post_content" class="form-control" cols="10" rows="5"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="post-media" class="col-form-label">Post Media:</label>
                        <input type="file" name="post_media" id="post-media" class="form-control">
                    </div>
                </form>
            </div>
            <div class="custom-modal-footer">
                <button type="button" class="btn btn-secondary" id="customModalCloseBtn">Close</button>
                <button type="button" class="btn btn-primary" id="updatePostBtn">Update Post</button>
            </div>
        </div>
    </div>
@endsection

@section('script-area')
    <script>
        $(document).ready(function() {
            const table = $('#appointment-table').DataTable({
                "ajax": {
                    "url": "{{ route('posts.data') }}",
                    "dataSrc": ""
                },
                "columns": [{
                        "data": null,
                        "render": function(data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        "data": "created_at"
                    },
                    {
                        "data": "vendor.vendor_id"
                    },
                    {
                        "data": "vendor.name"
                    },
                    {
                        "data": "content"
                    },
                    {
                        "data": "post_image_url",
                        "render": function(data) {
                            return data ? `<img src="${data}" alt="Post Image" width="50">` :
                                'No Image';
                        }
                    },
                    {
                        "data": "status",
                        "render": function(data, type, row) {
                            return `
                            <label class="switch">
                                <input type="checkbox" class="status-toggle" data-id="${row.id}" ${data ? 'checked' : ''}>
                                <span class="slider round"></span>
                            </label>`;
                        }
                    },
                    {
                        "data": null,
                        "defaultContent": `
                            <button class="btn btn-primary edit-post">Edit</button>
                            <button class="btn btn-danger delete-post">Delete</button>
                        `
                    }
                ]
            });

            $(document).on('click', '.edit-post', function() {
                const data = table.row($(this).parents('tr')).data();
                $('#post_id').val(data.id);
                $('#post_content').val(data.content);
                $('#customModal').addClass('show');
            });

            document.addEventListener('change', function(event) {
                if (event.target.classList.contains('status-toggle')) {
                    const postId = event.target.dataset.id;
                    const status = event.target.checked ? 1 : 0;
                    fetch('{{ route('posts.status') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                id: postId,
                                status: status
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            table.ajax.reload();
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.success
                            });
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                }
            });


            $('#updatePostBtn').on('click', function() {
                const formData = new FormData($('#editPostForm')[0]);
                $.ajax({
                    url: '{{ route('posts.update') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#customModal').removeClass('show');
                        table.ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.success
                        });
                    }
                });
            });
            document.querySelectorAll('#customModalClose, #customModalCloseBtn').forEach(function(element) {
                    element.addEventListener('click', function() {
                        document.getElementById('customModal').classList.remove('show');
                    });
                });
            $(document).on('click', '.delete-post', function() {
                const data = table.row($(this).parents('tr')).data();
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    text: 'You are about to delete this post.',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route('posts.delete') }}',
                            method: 'POST',
                            data: {
                                id: data.id,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                table.ajax.reload();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: data.success
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
