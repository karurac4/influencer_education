@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card my-5 ps-3">
                <div class="card-body mt-4 p-2 fs-5">
                    <lavel>ユーザーネーム：</lavel><span>{{ Auth::user()->name }}</span>
                </div>
                <div class="card-body mb-4 p-2 fs-5">
                    <lavel>メールアドレス：</lavel><span>{{ Auth::user()->email }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection