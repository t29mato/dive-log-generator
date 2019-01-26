@extends('common')

@section('content')

@if(isset($imageUrl))
<img src="{{ $imageUrl }}" class="img-fluid mb-3" width="500"><br>
<a href="{{ $imageUrl }}" download="#{{ $oldInput->numberDiving . '_' . $oldInput->dateDiving }}" class="btn btn-secondary mb-2">ダウンロード</a>
@endif
<form action="{{ route('generate') }}" method="post" enctype="multipart/form-data" class="p-2">
    {{ csrf_field() }}
    <h2>1. 写真選択</h2>
    <div class="row mb-2">
        <div class="col-12">
            <div class="input-group">
                <input tabindex="1" type="file" id="photo" name="photo" required>
                <p>※ 推奨画像：縦横1,200ピクセル以上</p>
                @if(isset($oldInput->numberDiving))
                <button type="submit" class="btn btn-primary mb-2">フォトログ再生成</button>
                @endif
            </div>
        </div>
    </div>
    <h2>2. ダイビングログ入力</h2>
    <div class="row mb-2">
        <div class="col-6">
            <span>本数</span>
            <div class="input-group">
                <input tabindex="2" type="number" class="form-control" id="numberDiving" name="numberDiving" value=@if(isset($oldInput->numberDiving))
                {{ $oldInput->numberDiving }}
                @else
                100
                @endif
                min="1" max="99999" required>
                <div class="input-group-append">
                    <span class="input-group-text">本目</span>
                </div>
            </div>
        </div>
        <div class="col-6">
            <span>日付</span>
            <div class="input-group">
                <input tabindex="3" type="date" class="form-control" id="dateDiving" name="dateDiving" value="{{ $oldInput->dateDiving }}" required>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-6">
            <span>天気</span>
            <div class="input-group">
                <select tabindex="4" class="form-control" id="weather" name="weather" value="{{ $oldInput->weather }}">
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
                <input tabindex="5" type="number" class="form-control" id="temperature" name="temperature" value=@if(isset($oldInput->temperature))
                {{ $oldInput->temperature }}
                @else
                25
                @endif
                min="0" max="40" step="0.1">
                <div class="input-group-append">
                    <span class="input-group-text">℃</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-2">
        <div class="col-12">
            <span>場所 (18文字以内)</span>
            <div class="input-group">
                <input tabindex="6" type="text" class="form-control" id="place" name="place" value="{{ $oldInput->place }}"
                    maxlength="18" placeholder="例：慶良間諸島 渡嘉敷島">
            </div>
        </div>
    </div>
    <table class="table-dive-diagram mb-2">
        <tbody>
            <tr>
                <td>
                    <span>開始時刻</span>
                    <div class="input-group">
                        <input tabindex="7" type="time" class="form-control" id="timeEntry" name="timeEntry" value=@if(isset($oldInput->timeEntry))
                        {{ $oldInput->timeEntry }}
                        @else
                        10:00
                        @endif
                    </div>
                </td>
                <td>
                    <span>潜水時間</span>
                    <div class="input-group">
                        <input type="number" class="form-control" id="timeDive" name="timeDive" value="{{ $oldInput->timeDive }}"
                            readonly="readonly">
                        <div class="input-group-append"> <span class="input-group-text">min</span>
                        </div>
                    </div>
                </td>
                <td>
                    <span>終了時刻</span>
                    <div class="input-group">
                        <input tabindex="8" type="time" class="form-control" id="timeExit" name="timeExit" value=@if(isset($oldInput->timeExit))
                        {{ $oldInput->timeExit }}
                        @else
                        10:45
                        @endif
                    </div>
                </td>
            </tr>
            <tr>
                <td class="b-top b-right">
                    <span>水温 (水面)</span>
                    <div class="input-group">
                        <input tabindex="9" type="number" class="form-control" id="tempTop" name="tempTop" value=@if(isset($oldInput->tempTop))
                        {{ $oldInput->tempTop }}
                        @else
                        25
                        @endif
                        min="0" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td>
                    <span>平均水深</span>
                    <div class="input-group">
                        <input tabindex="11" type="number" class="form-control" id="depthAvg" name="depthAvg" value=@if(isset($oldInput->depthAvg))
                        {{ $oldInput->depthAvg }}
                        @else
                        10.0
                        @endif
                        min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td class="b-left b-top">
                    <span>開始圧</span>
                    <div class="input-group">
                        <input tabindex="13" type="number" class="form-control" id="pressureEntry" name="pressureEntry"
                            value=@if(isset($oldInput->pressureEntry))
                        {{ $oldInput->pressureEntry }}
                        @else
                        200
                        @endif
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
                        <input tabindex="10" type="number" class="form-control" id="tempBottom" name="tempBottom" value=@if(isset($oldInput->tempBottom))
                        {{ $oldInput->tempBottom }}
                        @else
                        22
                        @endif
                        min="0" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">℃</span>
                        </div>
                    </div>
                </td>
                <td class="b-left b-right b-bottom">
                    <span>最大水深</span>
                    <div class="input-group">
                        <input tabindex="12" type="number" class="form-control" id="depthMax" name="depthMax" value=@if(isset($oldInput->depthMax))
                        {{ $oldInput->depthMax }}
                        @else
                        20
                        @endif
                        min="1" max="40" step="0.1">
                        <div class="input-group-append">
                            <span class="input-group-text">m</span>
                        </div>
                    </div>
                </td>
                <td>
                    <span>終了圧</span>
                    <div class="input-group">
                        <input tabindex="14" type="number" class="form-control" id="pressureExit" name="pressureExit"
                            value=@if(isset($oldInput->pressureExit))
                        {{ $oldInput->pressureExit }}
                        @else
                        100
                        @endif
                        <div class="input-group-append">
                            <span class="input-group-text">atm</span>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <h2>3. テンプレート選択</h2>
    <div class="row">
        <div class="col-12">
            <div class="input-group">
                <input id="top-left-white" type="radio" name="template" value="top-left-white" @if($oldInput->template === 'top-left-white')
                checked
                @endif
                checked>
                <label for="top-left-white">
                    <img class="img-fluid m-1" src="{{ asset('images/top-left-white.png') }}" width="80">
                </label>
                <input id="top-right-white" type="radio" name="template" value="top-right-white" @if($oldInput->template === 'top-right-white')
                checked
                @endif>
                <label for="top-right-white">
                    <img class="img-fluid m-1" src="{{ asset('images/top-right-white.png') }}" width="80">
                </label>
                <input id="top-left-black" type="radio" name="template" value="top-left-black" @if($oldInput->template === 'top-left-black')
                checked
                @endif>
                <label for="top-left-black">
                    <img class="img-fluid m-1" src="{{ asset('images/top-left-black.png') }}" width="80">
                </label>
                <input id="top-right-black" type="radio" name="template" value="top-right-black" @if($oldInput->template === 'top-right-black')
                checked
                @endif>
                <label for="top-right-black">
                    <img class="img-fluid m-1" src="{{ asset('images/top-right-black.png') }}" width="80">
                </label>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">
        @if(isset($oldInput->numberDiving))
        フォトログ再生成
        @else
        フォトログ生成
        @endif
    </button>
</form>
@endsection
