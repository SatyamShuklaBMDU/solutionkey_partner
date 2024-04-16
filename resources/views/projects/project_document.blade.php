@extends('include.master')
@section('style-area')
    <style>
        div {
            margin-bottom: 5px;
        }


        label {
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
        }


        input[type="text"] {
            padding: 10px;
            border: none;
            border-bottom: 1px solid #ccc;
            font-size: 16px;
            transition: border-color 0.3s ease;
            outline: none;
        }


        input[type="text"]:focus {
            border-color: #007bff;
        }

        input[type="file"].custom {
            border: 0;
            clip: rect(0, 0, 0, 0);
            height: 1px;
            overflow: hidden;
            padding: 0;
            position: absolute !important;
            white-space: nowrap;
            width: 1px;
        }

        .m5 {
            margin: 0 5px;
        }

        .switch {
            display: inline-block;
        }

        .switch input {
            display: none;
        }

        .switch small {
            display: inline-block;
            width: 43px;
            height: 18px;
            background: #e23535;
            border-radius: 30px;
            position: relative;
            cursor: pointer;
            padding: 0px 5px;
        }

        .switch small:after {
            content: "Inc";
            position: absolute;
            color: #fff;
            font-size: 11px;
            font-weight: 600;
            width: 100%;
            left: 0px;
            text-align: right;
            padding: 0 6px;
            box-sizing: border-box;
            line-height: 18px;
        }

        .switch small:before {
            content: "";
            position: absolute;
            width: 12px;
            height: 12px;
            background: #fff;
            border-radius: 50%;
            top: 3px;
            left: 3px;
            transition: .3s;
            box-shadow: -3px 0 3px rgba(0, 0, 0, 0.1);
        }

        .switch input:checked~small {
            background: #4bac37;
            transition: .3s;
        }

        .switch input:checked~small:before {
            transform: translate(25px, 0px);
            transition: .3s;
        }

        .switch input:checked~small:after {
            content: "Act";
            text-align: left;
        }
    </style>
@endsection
@section('content')
<main class="s-layout__content px-4 border mt-3">
    <div class="row">
        <div class="col-lg-6">
            <label for="">Document_ID :</label>
            <input type="text">
        </div>
        <div class="col-lg-6">
            <label for=""> Plant_ID :</label>
            <input type="text">
        </div>
        <div class="col-lg-12">
            <div class="row mt-3">
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Proforma
                                Invoice :</label>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Payment_Advices
                                :</label>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Sales_Quotation
                                :</label>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Electricity
                                Bill :</label>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Aadhar Card
                                :</label>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Property
                                Paper :</label>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Vendor
                                Invoices :</label>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">NM_Application
                                :</label>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Site_SLD
                                :</label><br>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default"
                                class="block text-sm leading-5 font-medium text-gray-700 ">Final_BOM_Letter
                                :</label>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Site
                                Photos
                                (Pre-Installation) :</label>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Site
                                Photos
                                (Post-Installation) :</label>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Cheques
                                :</label><br>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
                <div class="col-lg-6">
                    <section class="container max-w-xl mx-auto flex flex-col py-8">
                        <div class="py-8">
                            <label for="default" class="block text-sm leading-5 font-medium text-gray-700 ">Others
                                :</label><br>
                            <input type="file" name="default" id="default" class="border p-2">
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <label for="">Document Remark :</label>
            <input type="text">
        </div>
        <div class="col-lg-6">
            <label for=""> Uploaded_By :</label>
            <input type="text">
        </div>
        <div class="col-lg-6">
            <label for="">Uploading_Date :</label>
            <input type="text">
        </div>
        <div class="col-lg-6 mt-2">
            <label for=""> Document_Status (Active / Inactive) :</label>
            <label class="switch m5">
                <input type="checkbox" class="px-2">
                <small></small>
        </div>
        <div class="col-lg-6">
            <label for="">Created_By :</label>
            <input type="text">
        </div>
        <div class="col-lg-6">
            <label for=""> Creation_Dt :</label>
            <input type="text">
        </div>
        <div class="col-lg-6">
            <label for=""> Updated_By :</label>
            <input type="text">
        </div>
        <div class="col-lg-6">
            <label for=""> Updation_Dt :</label>
            <input type="text">
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6"></div>
        <div class="col-lg-6">
            <button class="btn btn-outline-primary mt-3" style="width: 50%">Submit</button>
        </div>
    </div>
</main>
@endsection
@section('script-area')
    <script>
        function imageData(url) {
            const originalUrl = url || '';
            return {
                previewPhoto: originalUrl,
                fileName: null,
                emptyText: originalUrl ? 'No new file chosen' : 'No file chosen',
                updatePreview($refs) {
                    var reader,
                        files = $refs.input.files;
                    reader = new FileReader();
                    reader.onload = (e) => {
                        this.previewPhoto = e.target.result;
                        this.fileName = files[0].name;
                    };
                    reader.readAsDataURL(files[0]);
                },
                clearPreview($refs) {
                    $refs.input.value = null;
                    this.previewPhoto = originalUrl;
                    this.fileName = false;
                }
            };
        }
    </script>
@endsection
