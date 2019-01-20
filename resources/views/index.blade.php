@extends('common')

@section('content')
<div class="row">
    <div class="col-sm-6">
        a
    </div>
    <div class="col-sm-6">
        a
    </div>
</div>
<a href="{{ route('generate') }}" class="btn btn-primary">早速、フォトダイビングログを生成する</a>
@endsection
