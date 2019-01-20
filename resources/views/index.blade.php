@extends('common')

@section('content')

@if(isset($imageUrl))
<img src="{{ url($imageUrl) }}" class="img-fluid" width="500">
@endif
<form action="{{ route('generate') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <table class="table-dive-diagram">
        <tbody>
            <tr>
                <td>
                    <label>Entry Time</label>
                    <div class="input-group">
                        <input tabindex="1" type="time" class="form-control" id="timeEntry" name="timeEntry" value="{{ $divingLog->timeEntry }}">
                    </div>
                </td>
                <td>
                    <label>Dive Time</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="timeDive" name="timeDive" readonly="readonly">
                        <div class="input-group-append">
                            <span class="input-group-text">min</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>Exit Time</label>
                    <div class="input-group">
                        <input tabindex="2" type="time" class="form-control" id="timeExit" name="timeExit" value="10:40">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="b-top b-right">
                    <label>Top Temp.</label>
                    <div class="input-group">
                        <input tabindex="3" type="number" class="form-control" id="tempTop" name="tempTop" value="26"
                            min="0" max="40">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>Average Depth</label>
                    <div class="input-group">
                        <input tabindex="5" type="number" class="form-control" id="depthAvg" name="depthAvg" value="10.0"
                            min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td class="b-left b-top">
                    <label>Entry Pressure</label>
                    <div class="input-group">
                        <input tabindex="7" type="number" class="form-control" id="pressureEntry" name="pressureEntry"
                            value="200" min="0" max="300">
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
                        <input tabindex="4" type="number" class="form-control" id="tempBottom" name="tempBottom" value="20"
                            min="0" max="40">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td class="b-left b-right b-bottom">
                    <label>Max Depth</label>
                    <div class="input-group">
                        <input tabindex="6" type="number" class="form-control" id="depthMax" name="depthMax" value="20.0"
                            min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>Exit Pressure</label>
                    <div class="input-group">
                        <input tabindex="8" type="number" class="form-control" id="pressureExit" name="pressureExit"
                            value="100" min="0" max="300">
                        <div class="input-group-append">
                            <span class="input-group-text">atm</span>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table class="table-dive-diagram">
        <tbody>
            <tr>
                <td>
                    <label>Date</label>
                    <div class="input-group">
                        <input tabindex="9" type="date" class="form-control" id="dateDiving" name="dateDiving" value="">
                    </div>
                </td>
                <td>
                    <label>Weather</label>
                    <div class="input-group">
                        <select tabindex="10" class="form-control" name="weather" id="weather">
                            <option value="">Select</option>
                            <option value="晴れ">晴れ</option>
                            <option value="曇り">曇り</option>
                            <option value="雨">雨</option>
                            <option value="雪">雪</option>
                            <option value="雷">雷</option>
                        </select>
                    </div>
                </td>
                <td>
                    <label>Temperature</label>
                    <div class="input-group">
                        <input tabindex="11" type="number" class="form-control" id="temperature" name="temperature" value="" min="0"
                            max="40" step="0.1">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label>Place</label>
                    <div class="input-group">
                        <input tabindex="12" type="text" class="form-control" id="place" name="place" value="">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table>
        <label>Photo</label>
        <div class="input-group">
            <input tabindex="13" type="file" id="photo" name="photo" required>
        </div>
        <label>Log Color</label>
        <div class="input-group">
            <input tabindex="14" type="color" id="color" name="color" required>
        </div>
    </table>
    <button type="submit" class="btn btn-primary">Generate</button>
</form>
@endsection
