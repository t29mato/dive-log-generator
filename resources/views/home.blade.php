@extends('common')

@section('content')
<h2>１ダイブの思い出を１枚の写真に。</h2>
<p>このサービスでは手軽にダイビングログをお気に入りの水中写真に合成することができます。<br>
    ダイビングの後も、友達に写真を共有したりTwitterやInstagramなどのSNSにシェアして、ダイビング生活をもっと楽しみましょう♪</p>
<h2>こんなフォトログが作れます</h2>
<div class="row">
    <div class="col-6">
        <img src="{{ asset('images/home_generated_photo_1.png') }}" class="img-fluid">
    </div>
    <div class="col-6">
        <img src="{{ asset('images/home_generated_photo_2.png') }}" class="img-fluid">
    </div>
</div>
<div class="text-center">
    <a href="{{ route('generate') }}" class="btn btn-primary m-4 btn-lg">フォトログを生成する</a>
</div>
<div class="row">
    <div class="col-sm-6">
        <h2>写真は自由にトリミング</h2>
        <img src="{{ asset('images/home_cropping.png') }}" class="img-fluid">
    </div>
    <div class="col-sm-6">
        <h2>テンプレートは４パターン</h2>
        <table>
            <tbody>
                <tr>
                    <td><img src="{{ asset('images/top-left-black.png') }}" class="img-fluid"></td>
                    <td><img src="{{ asset('images/top-right-black.png') }}" class="img-fluid"></td>
                </tr>
                <tr>
                    <td><img src="{{ asset('images/top-left-white.png') }}" class="img-fluid"></td>
                    <td><img src="{{ asset('images/top-right-white.png') }}" class="img-fluid"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="text-center">
    <a href="{{ route('generate') }}" class="btn btn-primary m-4 btn-lg">フォトログを生成する</a>
</div>
@endsection
