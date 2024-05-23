@extends('include.master')
@section('style-area')
    <style>
        /* Style for the input container */
        div {
            margin-bottom: 12px;
        }

        /* Style for the label */
        .custom-control-input:checked~.custom-control-label::before {
            color: #fff;
            border-color: #7B1FA2;
        }

        .custom-control-input:checked~.custom-control-label.red::before {
            background-color: red;
        }

        .custom-control-input:checked~.custom-control-label.green::before {
            background-color: green;
        }

        label {
            margin-bottom: 5px;
            color: #333;
            font-weight: bold;
            font-family: 'Poppins', sans-serif !important;
        }

        /* Style for the input field */
        input {
            padding: 10px;
            border: none;
            border-bottom: 1px solid #ccc;
            font-size: 16px;
            transition: border-color 0.3s ease;
            outline: none;
        }

        /* Style for the input field when focused */
        input:focus {
            border-color: #007bff;
        }

        /* Hide default radio button
        input[type="radio"] {
            display: none;
        }*/

        /* Style for the label (custom radio button) */
        .radio-label {
            display: inline-block;
            cursor: pointer;
            padding: 1px 10px;
            margin-right: 10px;
            border-radius: 5px;
            background-color: #f0f0f0;
            color: #333;
            transition: background-color 0.3s ease;
        }

        /* Style for the label when radio button is checked */
        input[type="radio"]:checked+.radio-label {
            background-color: #007bff;
            color: white;
        }

        /* Style for spacing between radio buttons */
        /* .radio-container {
            margin-bottom: 20px;
        } */


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
            content: "No";
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
            content: "Yes";
            text-align: left;
        }

        /* Custom styling for select dropdown */
        .custom-select-label {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 10px;
        }

        select {
            width: 100%;
        }

        select option {
            width: auto;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .form-check-input.pending:checked+.form-check-label.pending-complete::before {
            border-color: red;
            background-color: red;
        }

        /* Style for complete radio button */
        .form-check-input.complete:checked+.form-check-label.pending-complete::before {
            border-color: green;
            background-color: green;
        }

        /* Style for radio button circle */
        .form-check-input.pending:checked+.form-check-label.pending-complete::after {
            background-color: red;
        }

        /* Style for radio button circle */
        .form-check-input.complete:checked+.form-check-label.pending-complete::after {
            background-color: green;
        }

        .form-label {
            white-space: nowrap;
            text-overflow: ellipsis;
            margin-right: 5px;
        }

        .form-control {
            flex-grow: 1;
        }

        .form-check-input.pending:checked {
            background-color: red;
            border-color: #0d6efd;
        }

        .form-check-input.complete:checked {
            background-color: green;
            border-color: #0d6efd;
        }

        div {
            margin-bottom: 8px !important;
        }

        .form-check-input {
            border: 2px solid hsl(0, 1%, 83%);
        }

        .pending-complete {
            font-size: 13px !important;
            font-family: 'Poppins', sans-serif;
        }

        .form-check-input {
            width: 0.6em !important;
            height: 0.6em !important;
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <div class="form holder shadow-lg p-3">
                <form>
                    <h2 class="text-center mb-5" style="color: hsl(240, 76%, 52%); font-family: 'Montserrat',sans-serif;">
                        Project
                        Profile </h2>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="projectId" class="form-label fs-6"
                                    style="margin-left: -10px !important;">Project
                                    Id</label>
                                <input type="number" class="form-control" id="projectId" value="123456789">
                            </div>
                            <div class="col-md-6 d-flex align-items-center">
                                <label for="clientId" class="form-label fs-6">Client
                                    Id</label>
                                <input type="number" class="form-control" id="clientId" value="1234345">
                            </div>
                        </div>
                    </div>

                    <!-- End of plant types  -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="plantType" class="form-label custom-select-label me-3">Plant
                                Type</label>
                            <div class="custom-select-wrapper flex-grow-1">
                                <select class="form-select custom-select" id="plantType">
                                    <option value="none">Select
                                        Plant Types</option>
                                    <option value="onGrid">On
                                        Grid</option>
                                    <option value="offGrid">Off
                                        Grid</option>
                                    <option value="hybrid">Hybrid</option>
                                </select>
                            </div>
                        </div>
                        <!-- End of plant Types -->
                        <!-- start Plant Category  -->

                        <div class="col-md-6">
                            <label for="plantType" class="form-label custom-select-label me-3">Plant
                                Category</label>
                            <div class="custom-select-wrapper flex-grow-1">
                                <select class="form-select custom-select" id="plantType">
                                    <option value='none'>Select
                                        Plant Category</option>
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value="Industrial">
                                        Industrial</option>
                                    <option value="Agricultural">Agricultural</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- End Of Category -->
                    <!-- Started subsidy case  -->
                    <div>
                        <div class="col-md-6 d-flex mx-1">
                            <label for>Subsidy Case</label>
                            <label class="switch m-1">
                                <input type="checkbox" class="px-2">
                                <small></small>
                        </div>
                        <div class="col-md-6 d-flex mx-1">
                            <label for="financeCase">Finance
                                Case</label>
                            <label class="switch m-1">
                                <input type="checkbox" class="px-2 mt-1" name="financeCase">
                                <small></small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="SanctionLoad" class="form-label">Sanction
                                Load<span style="font-size: 12px;margin-left: 2px;">(in
                                    KW)</span></label>
                            <input type="number" class="form-control" id="SanctionLoad">

                        </div>
                        <!-- End Sanction_Load (in KW) -->
                        <!-- start  Plant Load (in KW) -->
                        <div class="col-md-6">
                            <label for="PlantLoad" class="form-label">Plant Load
                                <span style="font-size: 12px;margin-left: 2px;">
                                    (in
                                    KW)</span></label>
                            <input type="number" class="form-control" id="PlantLoad">

                        </div>
                    </div>
                    <!-- End . Plant Load (in KW) -->
                    <!-- started Created By -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="createdBy" class="form-label">Created
                                By</label>
                            <input type="text" class="form-control" id="CreatedBy" placeholder="Created By...">

                        </div>
                        <!-- End Created By -->
                        <!-- Started Created Date -->
                        <div class="col-md-6">
                            <label for="createdDate" class="form-label">Created
                                Date</label>
                            <input type="date" class="form-control" id="CreatedDate">

                        </div>
                    </div>
                    <!-- End Creation Date -->

                    <!-- Started Update By -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="updatedBy" class="form-label">Update
                                By</label>
                            <input type="text" class="form-control" id="updatedBy" placeholder="updated By...">

                        </div>
                        <!-- End updated By -->

                        <!-- Started Updation Date -->
                        <div class="col-md-6">
                            <label for="updatedDate" class="form-label">Updation Date
                            </label>
                            <input type="date" class="form-control" id="updatedDate">

                        </div>
                    </div>
                    <!-- Sales Owner Started -->
                    <div class="row">
                        <div class="col-md-6">
                            <label for="salesOwner" class="form-label">Sales Owner
                            </label>
                            <input type="text" class="form-control" id="salesOwner">

                        </div>
                        <!-- End Sales Owner -->
                        <!-- Project Owner Started -->
                        <div class="col-md-6">
                            <label for="projectOwner" class="form-label">Project Owner
                            </label>
                            <input type="text" class="form-control" id="projectOwner">

                        </div>
                    </div>
                    <!-- End Project Owner -->
                    <!-- Started Plant Booking Date -->
                    <div class="row">
                        <div class="col-md-4">
                            <label for="plantBookDate" class="form-label">Plant Booking
                                Date</label>
                            <input type="date" class="form-control" id="plantBookDate">

                        </div>
                        <!-- Start PI Date -->
                        <div class="col-md-4">
                            <label for="pidate" class="form-label">PI
                                Date</label>
                            <input type="date" class="form-control" id="pidate">

                        </div>
                        <!-- End PI Date-->
                        <!-- End Plant Booking  -->
                        <div class="col-md-4">
                            <label for="piNumber" class="form-label">PI
                                Number</label>
                            <input type="number" class="form-control" id="piNumber">
                        </div>

                    </div>
                    <!-- Start Area -->
                    <div class="row">
                        <div class="col-md-4">
                            <label for="Area" class="form-label">Area</label>
                            <input type="text" class="form-control" id="Area">

                        </div>
                        <!-- End Area -->
                        <!-- Start State -->
                        <div class="col-md-4">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select" id="state">
                                <option value>Select a
                                    state</option>
                                <option value="Andhra Pradesh">Andhra
                                    Pradesh</option>
                                <option value="Arunachal Pradesh">Arunachal
                                    Pradesh</option>
                                <option value="Assam">Assam</option>
                                <option value="Bihar">Bihar</option>
                                <option value="Chhattisgarh">Chhattisgarh</option>
                                <option value="Goa">Goa</option>
                                <option value="Gujarat">Gujarat</option>
                                <option value="Haryana">Haryana</option>
                                <option value="Himachal Pradesh">Himachal
                                    Pradesh</option>
                                <option value="Jharkhand">Jharkhand</option>
                                <option value="Karnataka">Karnataka</option>
                                <option value="Kerala">Kerala</option>
                                <option value="Madhya Pradesh">Madhya
                                    Pradesh</option>
                                <option value="Maharashtra">Maharashtra</option>
                                <option value="Manipur">Manipur</option>
                                <option value="Meghalaya">Meghalaya</option>
                                <option value="Mizoram">Mizoram</option>
                                <option value="Nagaland">Nagaland</option>
                                <option value="Odisha">Odisha</option>
                                <option value="Punjab">Punjab</option>
                                <option value="Rajasthan">Rajasthan</option>
                                <option value="Sikkim">Sikkim</option>
                                <option value="Tamil Nadu">Tamil
                                    Nadu</option>
                                <option value="Telangana">Telangana</option>
                                <option value="Tripura">Tripura</option>
                                <option value="Uttar Pradesh">Uttar
                                    Pradesh</option>
                                <option value="Uttarakhand">Uttarakhand</option>
                                <option value="West Bengal">West
                                    Bengal</option>
                                <option value="Andaman and Nicobar Islands">Andaman
                                    and Nicobar Islands</option>
                                <option value="Chandigarh">Chandigarh</option>
                                <option value="Dadra and Nagar Haveli">Dadra
                                    and Nagar Haveli</option>
                                <option value="Daman and Diu">Daman
                                    and Diu</option>
                                <option value="Lakshadweep">Lakshadweep</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Puducherry">Puducherry</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="pincode" class="form-label">Pin
                                Code</label>
                            <input type="number" class="form-control" id="pincode">

                        </div>

                    </div>

                    <!-- End PI Number-->

                    <!-- End Bill Amount-->
                    <!-- GST_Amount -->
                    <div class="row">
                        <!-- Start Bill Amount -->
                        <div class="col-md-4">
                            <label for="billAmount" class="form-label">Bill
                                Amount</label>
                            <input type="number" class="form-control" id="billAmount" placeholder="In Rs.">

                        </div>
                        <div class="col-md-4">
                            <label for="gstAmount" class="form-label">GST
                                Amount</label>
                            <input type="number" class="form-control" id="gstAmount" placeholder="In Rs.">

                        </div>
                        <!-- End GST_Amount -->
                        <!-- Total_Amount Started -->
                        <div class="col-md-4">
                            <label for="totalAmount" class="form-label">Total
                                Amount</label>
                            <input type="number" class="form-control" id="totalAmount" placeholder="In Rs.">

                        </div>
                    </div>
                    <!-- End Total_Amount -->

                    <!-- Started Plant Execution status  and Plant Documentation Status-->
                    <div class="row">
                        <div class="col-lg-6">
                            <h5 class="py-3 text-center">Plant
                                Execution Status</h5>
                            <div class="d-flex flex-column">
                                <div class="d-flex ">
                                    <label for="status1" style="width: 46%;font-size:14px;">Under
                                        O&M</label>
                                    <div class="form-check mx-2" style="margin-right: 43px !important;">
                                        <input class="form-check-input pending" type="radio" name="status1"
                                            id="status1_pendingO&M" value="pendingO&M">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status1_pendingO&M">No</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input complete" type="radio" name="status1"
                                            id="status1_completeO&M" value="completeO&M">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status1_completeO&M">Yes</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <label for="status2" style="width: 46%;font-size:14px;">Plant
                                        Commissioned</label>
                                    <div class="form-check mx-2" style="margin-right: 43px !important;">
                                        <input class="form-check-input pending" type="radio" name="status2"
                                            id="status2_pendingPCom" value="pendingPCom">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status2_pendingPCom">No</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input complete" type="radio" name="status2"
                                            id="status2_completePCom" value="completePCom">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status2_completePCom">Yes</label>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center">
                                    <label for="status3" style="width: 46%;font-size:14px;">Status
                                        Of
                                        Vendor
                                        Allocation</label>
                                    <div class="form-check mx-2">
                                        <input class="form-check-input pending" type="radio" name="status3"
                                            id="status3_pendingVendor" value="pendingVendor">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status3_pendingVendor">Pending</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input complete" type="radio" name="status3"
                                            id="status3_completeVendor" value="completeVendor">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status3_completeVendor">Complete</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <label for="status4" style="width: 46%;font-size:14px;">Status
                                        Of
                                        MMS
                                        Installation</label>
                                    <div class="form-check mx-2">
                                        <input class="form-check-input pending" type="radio" name="status4"
                                            id="status4_pendingMMS" value="pendingMMS">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status4_pendingMMS">Pending</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input complete" type="radio" name="status4"
                                            id="status4_completeMMS" value="completeMMS">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status4_completeMMS">Complete</label>
                                    </div>
                                </div>
                                <div class="d-flex gap-1">
                                    <label for="status5" style="width: 46%; font-size: 14px;">Status
                                        Of
                                        Panel
                                        Installation</label>
                                    <div class="form-check mx-1">
                                        <input class="form-check-input pending" type="radio" name="status5"
                                            id="status5_pendingPanel" value="pendingPanel">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status5_pendingPanel">Pending</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input complete" type="radio" name="status5"
                                            id="status5_completePanel" value="completePanel">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status5_completePanel">Complete</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <label for="status6" style="width: 46%;font-size:14px;">Status
                                        Of
                                        Net Metering</label>
                                    <div class="form-check mx-2">
                                        <input class="form-check-input pending" type="radio" name="status6"
                                            id="status6_pendingNetMetering" value="pendingNetMetering">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status6_pendingNetMetering">Pending</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input complete" type="radio" name="status6"
                                            id="status6_completeNetMetering" value="completeNetMetering">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status6_completeNetMetering">Complete</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h5 class="py-3 text-center">Plant
                                Documentation Status</h5>
                            <div class="d-flex flex-column">
                                <div class="d-flex gap-1">
                                    <label for="status_1" style="width: 46%;font-size:14px;">Status
                                        Of Application
                                        Filing</label>
                                    <div class="form-check mx-2">
                                        <input class="form-check-input pending" type="radio" name="status_1"
                                            id="status1_pendingAppFiling" value="pendingAppFiling">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status1_pendingAppFiling">Pending</label>
                                    </div>
                                    <div class="form-check ">
                                        <input class="form-check-input complete" type="radio" name="status_1"
                                            id="status1_completeAppFiling" value="completeAppFiling">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status1_completeAppFiling">Complete</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <label for="status_2" style="width: 46%;font-size:14px; margin-left: 1px;">Status
                                        Of Second Stage</label>
                                    <div class="form-check mx-2">
                                        <input class="form-check-input pending" type="radio" name="status_2"
                                            id="status2_pendingSecondStage" value="pendingSecondStage">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status2_pendingSecondStage">Pending</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input complete" type="radio" name="status_2"
                                            id="status2_completeSecondStage" value="completeSecondStage">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status2_completeSecondStage">Complete</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <label for="status_3" style="width: 46%;font-size:14px;">Status
                                        Of Third Stage</label>
                                    <div class="form-check mx-2">
                                        <input class="form-check-input pending" type="radio" name="status_3"
                                            id="status3_pendingThirdStage" value="pendingThirdStage">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status3_pendingThirdStage">Pending</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input complete" type="radio" name="status_3"
                                            id="status3_completeThirdStage" value="completeThirdStage">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status3_completeThirdStage">Complete</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <label for="status_4" style="width: 46%;font-size:14px;">Application
                                        Rejected</label>
                                    <div class="form-check mx-2" style="margin-right: 43px !important;">
                                        <input class="form-check-input pending" type="radio" name="status_4"
                                            id="status4_rejected" value="rejected">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status4_rejected">No</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input complete" type="radio" name="status_4"
                                            id="status4_approved" value="approved">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status4_approved">Yes</label>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <label for="status_5" style="width: 46%;font-size:14px;">Application
                                        Approved</label>
                                    <div class="form-check mx-2" style="margin-right: 43px !important;">
                                        <input class="form-check-input pending" type="radio" name="status_5"
                                            id="status5_rejected" value="rejected">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status5_rejected">No</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input complete" type="radio" name="status_5"
                                            id="status5_approved" value="approved">
                                        <label class="form-check-label fs-6 pending-complete"
                                            for="status5_approved">Yes</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--  -->
                    <!-- End Updation Date -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
