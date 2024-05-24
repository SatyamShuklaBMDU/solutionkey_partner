@extends('include.master')
@section('style-area')
    <style>
        .file-display {
            width: 300px;
            height: 400px;
            overflow: auto;
            position: relative;
        }

        .file-display img,
        .file-display iframe {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .file-display pre {
            width: 100%;
            height: 100%;
            overflow: auto;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .btn-close {
            position: absolute;
            top: 5px;
            right: 5px;
        }
    </style>
@endsection
@section('content')
    <main class="s-layout__content">
        <div class="py-3">
            <h2>View Appointment</h2>
            <main class="container p-3 border m-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                <img src="{{ auth()->guard('admins')->user()->profile_pic }}" alt="" width="25px"
                                    height="25px" class="rounded-circle"> {{ auth()->guard('admins')->user()->name }}
                            </div>
                            <div class="card-body d-flex">
                                <div class="me-3">
                                    <label for="bp" class="form-label">BP</label>
                                    <input type="text" class="form-control" id="bp" placeholder="--">
                                </div>
                                <div class="me-3">
                                    <label for="pulse" class="form-label">Pulse</label>
                                    <input type="text" class="form-control" id="pulse" placeholder="--">
                                </div>
                                <div class="me-3">
                                    <label for="temp" class="form-label">Temp</label>
                                    <input type="text" class="form-control" id="temp" placeholder="--">
                                </div>
                                <div class="me-3">
                                    <label for="spO2" class="form-label">SpO2</label>
                                    <input type="text" class="form-control" id="spO2" placeholder="--">
                                </div>
                                <div class="me-3">
                                    <label for="fbs" class="form-label">FBS</label>
                                    <input type="text" class="form-control" id="fbs" placeholder="--">
                                </div>
                                <div class="me-3">
                                    <label for="ppbs" class="form-label">PPBS</label>
                                    <input type="text" class="form-control" id="ppbs" placeholder="--">
                                </div>
                                <div class="me-3">
                                    <label for="rbs" class="form-label">RBS</label>
                                    <input type="text" class="form-control" id="rbs" placeholder="--">
                                </div>
                                <div class="me-3">
                                    <label for="rr" class="form-label">RR</label>
                                    <input type="text" class="form-control" id="rr" placeholder="--">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row m-3">
                    <div class="col-md-12 text-center p-3" style="border:1px dashed grey;" id="uploadDiv">
                        <input type="file" id="fileInput" style="display:none;" multiple>
                        <button type="button" class="btn btn-primary" id="uploadButton">Attach Files</button>
                        <div id="fileList" class="mt-3"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-3">
                            <div class="card-header">
                                History
                            </div>
                            <div class="card-header">
                                Prescription
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        prescription23/05/2024 5:17 PM
                                        <span class="badge bg-primary rounded-pill">Edit</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        prescription18/05/2024 5:34 PM
                                        <span class="badge bg-primary rounded-pill">Edit</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-3 pt-2 border-top">
                    <button type="button" class="btn btn-warning rounded-pill text-light">Write Prescription</button>
                </div>
            </main>
        </div>
    </main>
@endsection
@section('script-area')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('fileInput');
            const uploadDiv = document.getElementById('uploadDiv');
            const fileList = document.getElementById('fileList');
            const uploadButton = document.getElementById('uploadButton');

            uploadDiv.addEventListener('click', function() {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                fileList.innerHTML = '';
                Array.from(fileInput.files).forEach(file => {
                    const reader = new FileReader();
                    const listItem = document.createElement('div');
                    listItem.className = 'file-display alert alert-secondary';

                    const closeButton = document.createElement('button');
                    closeButton.className = 'btn-close';
                    closeButton.addEventListener('click', function() {
                        listItem.remove();
                    });

                    reader.onload = function(e) {
                        const fileContent = e.target.result;

                        if (file.type.startsWith('image/')) {
                            const img = document.createElement('img');
                            img.src = fileContent;
                            img.alt = file.name;
                            listItem.appendChild(img);
                        } else if (file.type.startsWith('text/')) {
                            const pre = document.createElement('pre');
                            pre.textContent = fileContent;
                            listItem.appendChild(pre);
                        } else if (file.type === 'application/pdf') {
                            const iframe = document.createElement('iframe');
                            iframe.src = fileContent;
                            listItem.appendChild(iframe);
                        } else {
                            const p = document.createElement('p');
                            p.textContent = file.name;
                            listItem.appendChild(p);
                        }

                        listItem.appendChild(closeButton);
                        fileList.appendChild(listItem);
                    };

                    if (file.type.startsWith('image/') || file.type.startsWith('text/') || file
                        .type === 'application/pdf') {
                        reader.readAsDataURL(file);
                    } else {
                        const p = document.createElement('p');
                        p.textContent = file.name;
                        listItem.appendChild(p);
                        listItem.appendChild(closeButton);
                        fileList.appendChild(listItem);
                    }
                });
            });

            // Prevent button click from propagating to div
            uploadButton.addEventListener('click', function(event) {
                event.stopPropagation();
            });
        });
    </script>
@endsection
