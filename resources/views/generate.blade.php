@extends('common')

@section('content')

@if(isset($imageUrl))
<img src="{{ $imageUrl }}" class="img-fluid mb-3" width="500"><br>
<a href="{{ $imageUrl }}" download="PhotoDiveLog_{{ $oldInput->dateDiving }}" class="btn btn-secondary mb-2">ダウンロード</a>
@endif
<form action="{{ route('generate') }}" method="post" enctype="multipart/form-data" class="p-2">
    {{ csrf_field() }}
    <h2>1. 写真選択</h2>
    <div class="row mb-2">
        <div class="col-12">
            <div class="input-group">
                <input tabindex="13" type="file" id="photo" name="photo" required>※ 推奨画像：縦横1,200ピクセル以上
                @if(isset($oldInput))
                <button type="submit" class="btn btn-primary mb-2">フォトログ再生成</button>
                @endif
            </div>
        </div>
    </div>
    <h2>2. ダイビングログ入力</h2>
    <div class="row mb-2">
        <div class="col-6">
            <span>何本目</span>
            <div class="input-group">
                <input tabindex="9" type="number" class="form-control" id="numberDiving" name="numberDiving" value="{{ $oldInput->numberDiving }}"
                    min="1" max="99999" placeholder="例: 100">
            </div>
        </div>
        <div class="col-6">
            <span>日付</span>
            <div class="input-group">
                <input tabindex="9" type="date" class="form-control" id="dateDiving" name="dateDiving" value="{{ $oldInput->dateDiving }}">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <span>天気</span>
            <div class="input-group">
                <select tabindex="10" class="form-control" id="weather" name="weather" value="{{ $oldInput->weather }}">
                    <option value="">選択する</option>
                    <option value="晴れ" @if($oldInput->weather === '晴れ') selected @endif>晴れ</option>
                    <option value="曇り" @if($oldInput->weather === '曇り') selected @endif>曇り</option>
                    <option value="雨" @if($oldInput->weather === '雨') selected @endif>雨</option>
                    <option value="雪" @if($oldInput->weather === '雪') selected @endif>雪</option>
                    <option value="雷" @if($oldInput->weather === '雷') selected @endif>雷</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <span>気温</span>
            <div class="input-group">
                <input tabindex="11" type="number" class="form-control" id="temperature" name="temperature" value="{{ $oldInput->temperature }}"
                    min="0" max="40" step="0.1">
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12">
            <span>場所</span>
            <div class="input-group mb-2">
                <input tabindex="12" type="text" class="form-control" id="place" name="place" value="{{ $oldInput->place }}"
                    maxlength="40">
            </div>
        </div>
    </div>
    <table class="table-dive-diagram mb-2">
        <tbody>
            <tr>
                <td>
                    <span>開始時刻</span>
                    <div class="input-group">
                        <input tabindex="1" type="time" class="form-control" id="timeEntry" name="timeEntry" value="{{ $oldInput->timeEntry }}">
                    </div>
                </td>
                <td>
                    <span>潜水時間</span>
                    <div class="input-group">
                        <input type="number" class="form-control" id="timeDive" name="timeDive" value="{{ $oldInput->timeDive }}"
                            readonly="readonly">
                        <div class="input-group-append">
                            <span class="input-group-text">min</span>
                        </div>
                    </div>
                </td>
                <td>
                    <span>終了時刻</span>
                    <div class="input-group">
                        <input tabindex="2" type="time" class="form-control" id="timeExit" name="timeExit" value="{{ $oldInput->timeExit }}">
                    </div>
                </td>
            </tr>
            <tr>
                <td class="b-top b-right">
                    <span>水温 (水面)</span>
                    <div class="input-group">
                        <input tabindex="3" type="number" class="form-control" id="tempTop" name="tempTop" value="{{ $oldInput->tempTop }}"
                            min="0" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td>
                    <span>平均水深</span>
                    <div class="input-group">
                        <input tabindex="5" type="number" class="form-control" id="depthAvg" name="depthAvg" value="{{ $oldInput->depthAvg }}"
                            min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td class="b-left b-top">
                    <span>開始圧</span>
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
                    <span>水温 (水底)</span>
                    <div class="input-group">
                        <input tabindex="4" type="number" class="form-control" id="tempBottom" name="tempBottom" value="{{ $oldInput->tempBottom }}"
                            min="0" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td class="b-left b-right b-bottom">
                    <span>最大水深</span>
                    <div class="input-group">
                        <input tabindex="6" type="number" class="form-control" id="depthMax" name="depthMax" value="{{ $oldInput->depthMax }}"
                            min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td>
                    <span>終了圧</span>
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
    <button type="submit" class="btn btn-primary">
        @if(isset($oldInput))
        フォトログ再生成
        @else
        フォトログ生成
        @endif
    </button>
</form>
@endsection
