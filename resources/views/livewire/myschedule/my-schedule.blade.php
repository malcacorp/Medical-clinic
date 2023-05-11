<x-slot name="header" class="">
    <h2 class="ms-4 h3">
        {{ __('Work Schedule') }}
    </h2>
    <style>
        .table {
            width: 50%;
            margin: auto;
        }

        .small-input {
            width: 40%;
            max-width: 150px;
        }

        input[type="time"],
        select {
            width: 100%;
            box-sizing: border-box;
        }

        @media screen and (max-width: 1200px) {
            .input-group {
                display: block !important;
            }

            .small-input {
                width: 100% !important;
                max-width: none !important;
                margin-top: 4px;
            }

            .table {
                width: 100%;
            }

            input[type="time"],
            select {
                max-width: 80px;
            }

            .button-container {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-top: 10px;
            }
        }
    </style>
</x-slot>


<div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Day</th>
                    <th>From</th>
                    <th>To</th>
                </tr>
            </thead>
            <tbody>
                {{-- ----------------------------------- --}}
                <tr>
                    <td>
                        <h4 class="text-md">Monday</h4>
                    </td>
                    <td>
                        <div class="row">

                            <div class="input-group flex-column: align-items-center col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="mon_am">
                                <select class="form-select small-input mx-1" name="mon_am_pm">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group flex-column: align-items-center col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="mon_pm">
                                <select class="form-select small-input mx-1" name="mon_pm_pm">
                                    <option value="PM">PM</option>
                                    <option value="AM">AM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                {{-- ----------------------------------- --}}
                <tr>
                    <td>
                        <h4> Tuesday</h4>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="tue_am">
                                <select class="form-select small-input mx-1" name="tue_am_pm">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="tue_pm">
                                <select class="form-select small-input mx-1" name="tue_pm_pm">
                                    <option value="PM">PM</option>
                                    <option value="AM">AM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                {{-- ----------------------------------- --}}
                <tr>
                    <td>
                        <h4>Wednesday</h4>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="wed_am">
                                <select class="form-select small-input mx-1" name="wed_am_pm">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="wed_pm">
                                <select class="form-select small-input mx-1" name="wed_pm_pm">
                                    <option value="PM">PM</option>
                                    <option value="AM">AM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                {{-- ----------------------------------- --}}
                <tr>
                    <td>
                        <h4>Thursday</h4>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="thu_am">
                                <select class="form-select small-input mx-1" name="thu_am_pm">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="thu_pm">
                                <select class="form-select small-input mx-1" name="thu_pm_pm">
                                    <option value="PM">PM</option>
                                    <option value="AM">AM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                {{-- ----------------------------------- --}}
                <tr>
                    <td>
                        <h4>Friday</h4>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="fri_am">
                                <select class="form-select small-input mx-1" name="fri_am_pm">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="fri_pm">
                                <select class="form-select small-input mx-1" name="fri_pm_pm">
                                    <option value="PM">PM</option>
                                    <option value="AM">AM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                {{-- ----------------------------------- --}}
                <tr>
                    <td>
                        <h4>Saturday</h4>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="sat_am">
                                <select class="form-select small-input mx-1" name="sat_am_pm">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="sat_pm">
                                <select class="form-select small-input mx-1" name="sat_pm_pm">
                                    <option value="PM">PM</option>
                                    <option value="AM">AM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Sunday</h4>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="sun_am">
                                <select class="form-select small-input mx-1" name="sun_am_pm">
                                    <option value="AM">AM</option>
                                    <option value="PM">PM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="row">
                            <div class="input-group col-sm-8 col-md-6">
                                <input type="time" class="form-control small-input" name="sun_pm">
                                <select class="form-select small-input mx-1" name="sun_pm_pm">
                                    <option value="PM">PM</option>
                                    <option value="AM">AM</option>
                                </select>
                            </div>
                        </div>
                    </td>
                </tr>

            </tbody>
        </table>
    </div>
    <div style="display: flex; justify-content: center; align-items: center;">
        <button class="btn btn-primary text-white py-1 m-4 px-3 rounded">Submit</button>
    </div>
</div>
