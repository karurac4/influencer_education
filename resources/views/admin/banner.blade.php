@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <a  href="{{ url('admin/top') }}" class="text-decoration-none text-dark lead">←戻る</a>
            <h3 class="my-3">バナー管理</h3>
            @if (session('flash_message'))
            <div class="flash_message ps-4 py-2">
                <h4 class="text-center" id="flash_message">{{ session('flash_message') }}</h4>
            </div>
            @endif

            <form action="{{route('banner.update')}}" method="post" action="/upload" enctype="multipart/form-data" id="bannerForm">
                @csrf
                <div id='bannerBlock'>
                    <input class='d-none' type='text' name='newBanner' value='0'>
                </div>

                <div class="mx-5 my-4">
                    <button class="btn fw-bold fs-3 bg-success text-white rounded-circle  border border-white" type="button" id='bannerCreate'>＋</button>
                </div>
                <div class="m-3 text-center ">
                    <button class="btn btn-secondary px-5 py-0 fs-4" type="button" name="send" id='bannerEdit'>登録</button>
                </div>
            </form>         
        </div>
    </div>
</div>
@endsection