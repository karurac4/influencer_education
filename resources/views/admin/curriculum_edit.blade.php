@extends('layouts.admin_layout') 

@section('content')

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<a href="{{ route('curriculums.index') }}" class="btn btn-secondary">戻る</a>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">授業設定</div>

                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ $curriculum->thumbnail ? asset('storage/' . $curriculum->thumbnail) : asset('storage/default-thumbnail.jpg') }}" alt="Thumbnail" style="max-height: 200px; max-width: 200px;">
                    </div>

                    <form method="POST" action="{{ route('curriculum.update', $curriculum->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="thumbnail">サムネイル:</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="thumbnail" name="thumbnail">
                                <label class="custom-file-label" for="thumbnail">ファイルを選択してください</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="grade_id">学年:</label>
                            <select id="grade_id" name="grade_id" class="form-control">
                                @foreach($grades as $grade)
                                    <option value="{{ $grade->id }}" {{ $curriculum->grade_id == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">授業名:</label>
                            <input type="text" id="title" name="title" class="form-control" value="{{ $curriculum->title }}">
                        </div>

                        <div class="form-group">
                            <label for="video_url">動画URL:</label>
                            <input type="text" id="video_url" name="video_url" class="form-control" value="{{ $curriculum->video_url }}">
                        </div>

                        <div class="form-group">
                            <label for="description">授業概要:</label>
                            <textarea id="description" name="description" class="form-control" rows="4">{{ $curriculum->description }}</textarea>
                        </div>

                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="alway_delivery_flg" name="alway_delivery_flg" {{ $curriculum->alway_delivery_flg ? 'checked' : '' }}>
                            <label class="form-check-label" for="alway_delivery_flg">常時公開</label>
                        </div>

                        <button type="submit" class="btn btn-primary">登録</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection