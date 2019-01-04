@extends('common')

@section('content')

{{ $hoge }}
{{ $imageUrl }}

@if(isset($imageUrl))
aaa
<img src="{{ asset($imageUrl) }}">
@endif
<form action="{{ route('generate') }}" method="post">
{{ csrf_field() }}
    <table class="table-dive-diagram">
        <tbody>
            <tr>
                <td>
                    <label>Entry Time</label>
                    <div class="input-group">
                        <input tabindex="1" type="time" class="form-control" id="timeEntry" value="10:00">
                    </div>
                </td>
                <td>
                    <label>Dive Time</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="timeDive" value="40" disabled>
                        <div class="input-group-append">
                            <span class="input-group-text">min</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>Exit Time</label>
                    <div class="input-group">
                        <input tabindex="2" type="time" class="form-control" id="timeExit" value="10:40">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="b-top b-right">
                    <label>Top Temp.</label>
                    <div class="input-group">
                        <input tabindex="3" type="number" class="form-control" id="tempTop" value="26" min="0" max="40">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>Average Depth</label>
                    <div class="input-group">
                        <input tabindex="5" type="number" class="form-control" id="tempTop" value="10.0" min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td class="b-left b-top">
                    <label>Entry Pressure</label>
                    <div class="input-group">
                        <input tabindex="7" type="number" class="form-control" id="tempTop" value="200" min="0" max="300">
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
                <td class="b-left b-right b-bottom">
                    <label>Max Depth</label>
                    <div class="input-group">
                        <input tabindex="6" type="number" class="form-control" id="tempTop" value="20.0" min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>Exit Pressure</label>
                    <div class="input-group">
                        <input tabindex="8" type="number" class="form-control" id="tempTop" value="100" min="0" max="300">
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
