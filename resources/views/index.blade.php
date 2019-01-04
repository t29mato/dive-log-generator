@extends('common')

@section('content')
<form>
    <table class="table-dive-diagram">
        <tbody>
            <tr>
                <td class="border-dark border-bottom">
                    <label>Entry Time</label>
                    <div class="input-group">
                        <input tabindex="1" type="time" class="form-control" id="timeEntry" value="10:00">
                    </div>
                </td>
                <td>
                    <label>Dive Time</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="timeDive" disabled>
                        <div class="input-group-append">
                            <span class="input-group-text">min</span>
                        </div>
                    </div>
                </td>
                <td class="border-dark border-bottom">
                    <label>Exit Time</label>
                    <div class="input-group">
                        <input tabindex="2" type="time" class="form-control" id="timeExit" value="10:00">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Top Temp.</label>
                    <div class="input-group">
                        <input tabindex="3" type="number" class="form-control" id="tempTop" value="20" min="0" max="40">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td class="border-dark border-left border-right">
                    <label>Average Depth</label>
                    <div class="input-group">
                        <input tabindex="5" type="number" class="form-control" id="tempTop" value="10.0" min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>Entry Pressure</label>
                    <div class="input-group">
                        <input tabindex="7" type="number" class="form-control" id="tempTop" value="20" min="0" max="40">
                        <div class="input-group-append">
                            <span class="input-group-text">atm</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Bottom Temp.</label>
                    <div class="input-group">
                        <input tabindex="4" type="number" class="form-control" id="tempTop" value="20" min="0" max="40">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td class="border-dark border-left border-right border-bottom">
                    <label>Max Depth</label>
                    <div class="input-group">
                        <input tabindex="6" type="number" class="form-control" id="tempTop" value="10.0" min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>Exit Pressure</label>
                    <div class="input-group">
                        <input tabindex="8" type="number" class="form-control" id="tempTop" value="20" min="0" max="40">
                        <div class="input-group-append">
                            <span class="input-group-text">atm</span>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection
