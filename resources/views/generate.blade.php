@extends('common')

@section('content')

@if(isset($imageUrl))
<p class="text-success">SUCCESS!</p>
<img src="{{ $imageUrl }}" class="img-fluid mb-3" width="500"><br>
<a href="{{ $imageUrl }}" download="PhotoDiveLog_{{ $oldInput->dateDiving }}" class="btn btn-secondary mb-1">フォトログをダウンロード</a>
<p>※ 条件変更は下から</p>
@endif
<form action="{{ route('generate') }}" method="post" enctype="multipart/form-data" class="p-2">
    {{ csrf_field() }}
    <h2>1. 写真選択</h2>
    <table class="mb-4">
        <div class="input-group">
            <input tabindex="13" type="file" id="photo" name="photo" required>
        </div>
    </table>
    <h2>2. ダイビングログ入力</h2>
    <table class="table-dive-diagram mb-2">
        <tbody>
            <tr>
                <td>
                    <label>開始時刻</label>
                    <div class="input-group">
                        <input tabindex="1" type="time" class="form-control" id="timeEntry" name="timeEntry" value="{{ $oldInput->timeEntry }}">
                    </div>
                </td>
                <td>
                    <label>潜水時間</label>
                    <div class="input-group">
                        <input type="number" class="form-control" id="timeDive" name="timeDive" value="{{ $oldInput->timeDive }}"
                            readonly="readonly">
                        <div class="input-group-append">
                            <span class="input-group-text">min</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>終了時刻</label>
                    <div class="input-group">
                        <input tabindex="2" type="time" class="form-control" id="timeExit" name="timeExit" value="{{ $oldInput->timeExit }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="b-top b-right">
                    <label>水温 (水面)</label>
                    <div class="input-group">
                        <input tabindex="3" type="number" class="form-control" id="tempTop" name="tempTop" value="{{ $oldInput->tempTop }}"
                            min="0" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>平均水深</label>
                    <div class="input-group">
                        <input tabindex="5" type="number" class="form-control" id="depthAvg" name="depthAvg" value="{{ $oldInput->depthAvg }}"
                            min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td class="b-left b-top">
                    <label>開始圧</label>
                    <div class="input-group">
                        <input tabindex="7" type="number" class="form-control" id="pressureEntry" name="pressureEntry"
                            value="{{ $oldInput->pressureEntry }}" min="0" max="300" step="10">
                        <div class="input-group-append">
                            <span class="input-group-text">atm</span>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <label>水温 (水底)</label>
                    <div class="input-group">
                        <input tabindex="4" type="number" class="form-control" id="tempBottom" name="tempBottom" value="{{ $oldInput->tempBottom }}"
                            min="0" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td class="b-left b-right b-bottom">
                    <label>最大水深</label>
                    <div class="input-group">
                        <input tabindex="6" type="number" class="form-control" id="depthMax" name="depthMax" value="{{ $oldInput->depthMax }}"
                            min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td>
                    <label>終了圧</label>
                    <div class="input-group">
                        <input tabindex="8" type="number" class="form-control" id="pressureExit" name="pressureExit"
                            value="{{ $oldInput->pressureExit }}" min="0" max="300" step="10">
                        <div class="input-group-append">
                            <span class="input-group-text">atm</span>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-dive-diagram">
        <tbody>
            <tr>
                <td>
                    <label>日付</label>
                    <div class="inpuひづk-group">
                        <input tabindex="9" type="date" class="form-control" id="dateDiving" name="dateDiving" value="{{ $oldInput->dateDiving }}">
                    </div>
                </td>
                <td>
                    <label>天気</label>
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
                    <label>気温</label>
                    <div class="input-group">
                        <input tabindex="11" type="number" class="form-control" id="temperature" name="temperature"
                            value="{{ $oldInput->temperature }}" min="0" max="40" step="0.1">
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <label>場所</label>
                    <div class="input-group mb-2">
                        <input tabindex="12" type="text" class="form-control" id="place" name="place" value="{{ $oldInput->place }}"
                            maxlength="40">
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <button type="submit" class="btn btn-primary">フォトログを生成する</button>
</form>
@endsection
