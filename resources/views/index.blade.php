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
                        <input tabindex="1" type="time" class="form-control" id="timeEntry" name="timeEntry" value="{{ $oldInput->timeEntry }}">
                    </div>
                </td>
                <td>
                    <label>Dive Time</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="timeDive" name="timeDive" value="{{ $oldInput->timeDive }}"
                            readonly="readonly">
                        <div class="input-group-append">
                            <span class="input-group-text">min</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>Exit Time</label>
                    <div class="input-group">
                        <input tabindex="2" type="time" class="form-control" id="timeExit" name="timeExit" value="{{ $oldInput->timeExit }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="b-top b-right">
                    <label>Top Temp.</label>
                    <div class="input-group">
                        <input tabindex="3" type="number" class="form-control" id="tempTop" name="tempTop" value="{{ $oldInput->tempTop }}"
                            min="0" max="40">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>Average Depth</label>
                    <div class="input-group">
                        <input tabindex="5" type="number" class="form-control" id="depthAvg" name="depthAvg" value="{{ $oldInput->depthAvg }}"
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
                            value="{{ $oldInput->pressureEntry }}" min="0" max="300">
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
                        <input tabindex="4" type="number" class="form-control" id="tempBottom" name="tempBottom" value="{{ $oldInput->tempBottom }}"
                            min="0" max="40">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td class="b-left b-right b-bottom">
                    <label>Max Depth</label>
                    <div class="input-group">
                        <input tabindex="6" type="number" class="form-control" id="depthMax" name="depthMax" value="{{ $oldInput->depthMax }}"
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
                            value="{{ $oldInput->pressureExit }}" min="0" max="300">
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
                        <input tabindex="9" type="date" class="form-control" id="dateDiving" name="dateDiving" value="{{ $oldInput->dateDiving }}">
                    </div>
                </td>
                <td>
                    <label>Weather</label>
                    <div class="input-group">
                        <select tabindex="10" class="form-control" id="weather" name="weather" value="{{ $oldInput->weather }}">
                            <option value="">Select</option>
                            <option value="晴れ" @if($oldInput->weather === '晴れ') selected @endif>晴れ</option>
                            <option value="曇り" @if($oldInput->weather === '曇り') selected @endif>曇り</option>
                            <option value="雨" @if($oldInput->weather === '雨') selected @endif>雨</option>
                            <option value="雪" @if($oldInput->weather === '雪') selected @endif>雪</option>
                            <option value="雷" @if($oldInput->weather === '雷') selected @endif>雷</option>
                        </select>
                    </div>
                </td>
                <td>
                    <label>Temperature</label>
                    <div class="input-group">
                        <input tabindex="11" type="number" class="form-control" id="temperature" name="temperature"
                            value="{{ $oldInput->temperature }}" min="0" max="40" step="0.1">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label>Place</label>
                    <div class="input-group">
                        <input tabindex="12" type="text" class="form-control" id="place" name="place" value="{{ $oldInput->place }}">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <table>
        <label>Photo</label>
        <div class="input-group">
            <input tabindex="13" type="file" id="photo" name="photo">
        </div>
        <label>Log Color</label>
        <div class="input-group">
            <input tabindex="14" type="color" id="color" name="color" value="{{ $oldInput->color }}" required>
        </div>
    </table>
    <button type="submit" class="btn btn-primary">Generate</button>
</form>
@endsection
