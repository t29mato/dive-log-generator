@extends('common')

{{ phpinfo() }}

@section('content')
<h2>１ダイブの思い出を１枚の写真に。</h2>
<p>このサービスでは手軽にダイビングログをお気に入りの水中写真に合成することができます。<br>
ダイビングの後も、友達に写真を共有したりTwitterやInstagramなどのSNSにシェアして、ダイビング生活をもっと楽しみましょう♪</p>
<h2>こんなフォトログが作れます</h2>
<div class="row">
    <div class="col-sm-6">
        <img src="{{ asset('images/home_generated_photo_1.png') }}" class="img-fluid">
    </div>
    <div class="col-sm-6">
        <img src="{{ asset('images/home_generated_photo_2.png') }}" class="img-fluid">
    </div>
</div>
<br>
<a href="{{ route('generate') }}" class="btn btn-primary">フォトログを生成する</a>
@endsection
