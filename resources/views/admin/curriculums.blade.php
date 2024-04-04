@extends('layouts.admin_layout')

@section('content')
<div class="container-fluid">
    <div class="row">
   
        @include('admin.sidebar')

       <!-- カリキュラムを表示する場所 -->
       <div class="col-md-9">
        <div id="curriculum-container"></div>
       </div>

    </div>
</div>
@endsection
