@extends('include.master')
@section('style-area')
<style>
    /* Style for the input container */
    div {
        margin-bottom: 20px;
    }

    /* Style for the label */
    label {
        margin-bottom: 5px;
        color: #333;
        font-weight: bold;
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

    /* Hide default radio button */
    input[type="radio"] {
        display: none;
    }

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
</style>
@endsection
@section('content')
    <main class="s-layout__content px-3">
            <div class="row">
                <div class="col-lg-4">
                    <label for="">Project Id:</label>
                    <input type="text" placeholder="Project Id">
                </div>
                <div class="col-lg-4">
                    <label for="">Client ID:</label>
                    <input type="text" placeholder="Client ID">
                </div>
                <div class="col-lg-4">
                    <label for="">Panels Count:</label>
                    <input type="text" placeholder="Panels Type">
                </div>
                <!-- <div> -->
                <div class="col-lg-6">
                    <label for="">Panel Type:</label>
                    <div class="radio-container px-3">
                        <input type="radio" id="monoPercHalfCut" name="property-type" value="Residential">
                        <label for="monoPercHalfCut" class=" fw-normal radio-label">Mono-PERC Half Cut</label>

                        <input type="radio" id="mono" name="property-type" value="Commercial">
                        <label for="mono" class=" fw-normal radio-label">Mono Perc Bifacial</label>

                        <input type="radio" id="topCon" name="property-type" value="Industrial">
                        <label for="topCon" class=" fw-normal radio-label">TopCon</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="">Panel Make:</label>
                    <div class="radio-container px-3">
                        <input type="radio" id="adani" name="property-type" value="Residential">
                        <label for="adani" class=" fw-normal radio-label">Adani</label>

                        <input type="radio" id="gautam" name="property-type" value="Commercial">
                        <label for="gautam" class=" fw-normal radio-label">Gautam</label>

                        <input type="radio" id="Vikram" name="property-type" value="Commercial">
                        <label for="Vikram" class=" fw-normal radio-label">Vikram</label>

                        <input type="radio" id="loom" name="property-type" value="Industrial">
                        <label for="loom" class=" fw-normal radio-label"> Loom</label>

                        <input type="radio" id="Saatvik" name="property-type" value="Industrial">
                        <label for="Saatvik" class=" fw-normal radio-label">Saatvik</label>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label for=""class="pt-1">Structure Type:</label>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="defaultFile">Normal RCC Structure</label>
                                <input type="file" class="form-control" id="defaultFile">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="defaultFile">Elevated RCC Structure (7-8 Feet)
                                </label>
                                <input type="file" class="form-control" id="defaultFile">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="defaultFile">Tinshed Structure</label>
                                <input type="file" class="form-control" id="defaultFile">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="defaultFile">Ground Mounted Structure</label>
                                <input type="file" class="form-control" id="defaultFile">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="defaultFile">PERGOLA Structure</label>
                                <input type="file" class="form-control" id="defaultFile">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="mb-3">
                                <label class="form-label" for="defaultFile">Customized Structure</label>
                                <input type="file" class="form-control" id="defaultFile">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="">Cable Make:</label>
                    <div class="radio-container px-3">
                        <input type="radio" id="Polycab" name="property-type" value="Residential">
                        <label for="Polycab" class=" fw-normal radio-label">Polycab</label>

                        <input type="radio" id="KEI" name="property-type" value="Commercial">
                        <label for="KEI" class=" fw-normal radio-label"> KEI</label>

                        <input type="radio" id="Finolex" name="property-type" value="Commercial">
                        <label for="Finolex" class=" fw-normal radio-label">Finolex</label>

                        <input type="radio" id="Others" name="property-type" value="Industrial">
                        <label for="Others" class=" fw-normal radio-label">Others</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="">Inverter Make:</label>
                    <div class="radio-container px-3">
                        <input type="radio" id="KSolare" name="property-type" value="Residential">
                        <label for="KSolare" class=" fw-normal radio-label">KSolare</label>

                        <input type="radio" id="Growatt" name="property-type" value="Commercial">
                        <label for="Growatt" class=" fw-normal radio-label">Growatt</label>

                        <input type="radio" id="Polycab1" name="property-type" value="Commercial">
                        <label for="Polycab1" class=" fw-normal radio-label">Polycab</label>

                        <input type="radio" id="Luminious" name="property-type" value="Commercial">
                        <label for="Luminious" class=" fw-normal radio-label">Luminious</label>

                        <input type="radio" id="Others1" name="property-type" value="Industrial">
                        <label for="Others1" class=" fw-normal radio-label">Others</label>
                    </div>
                </div>

                <div class="col-lg-4">
                    <label for="">Inverter Rating</label>
                    <!-- <label class="switch m5"> -->
                    <input type="number" placeholder=" In KW">
                    <!-- <small></small> -->
                </div>
                <div class="col-lg-4">
                    <label for="">Sprinkler_System</label>
                    <label class="switch m5">
                        <input type="checkbox" class="px-2">
                        <small></small>
                </div>
                <div class="col-lg-4">
                    <label for="">Panel Vendor</label>
                    <!-- <label class="switch m5"> -->
                    <input type="text">
                    <!-- <small></small> -->
                </div>
                <div class="col-lg-4">
                    <label for="">Inverter Vendor:</label>
                    <input type="text">
                </div>
                <div class="col-lg-4">
                    <label for=""> MMS Vendor</label>
                    <input type="text">
                </div>
                <div class="col-lg-4">
                    <label for=""> BOS Vendor:</label>
                    <input type="text">
                </div>
                <div class="col-lg-4">
                    <label for="">BOS Vendor:</label>
                    <input type="text">
                </div>
                <div class="col-lg-4">
                    <label for="">Installation Vendor:</label>
                    <input type="number">
                </div>
                <div class="col-lg-4">
                    <label for=""> Support Vendor:</label>
                    <input type="number">
                </div>
                <div class="col-lg-4">
                    <label for="">Created_By:</label>
                    <input type="number">
                </div>
                <div class="col-lg-4">
                    <label for="">Creation_Dt:</label>
                    <input type="number">
                </div>
                <div class="col-lg-4">
                    <label for="">Updated_By:</label>
                    <input type="number">
                </div>
                <div class="col-lg-4">
                    <label for="">Updation_Dt:</label>
                    <input type="number">
                </div>
            </div>
    </main>
@endsection
