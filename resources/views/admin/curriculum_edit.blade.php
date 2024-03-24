

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<a href="{{ route('curriculums.index') }}" class="btn btn-secondary">Back</a>

<form method="POST" action="{{ route('curriculum.update', $curriculum->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <img src="{{ asset('storage/thumbnails/画像ファイル名') }}" alt="Thumbnail" width="200">

    
    <div class="form-group">
        <label for="thumbnail">Thumbnail:</label>
        <input type="file" id="thumbnail" name="thumbnail" class="form-control">
    </div>

    <div class="form-group">
        <label for="grade_id">Grade:</label>
        <select id="grade_id" name="grade_id" class="form-control">
            @foreach($grades as $grade)
                <option value="{{ $grade->id }}" {{ $curriculum->grade_id == $grade->id ? 'selected' : '' }}>{{ $grade->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" class="form-control" value="{{ $curriculum->title }}">
    </div>

    <div class="form-group">
        <label for="video_url">Video URL:</label>
        <input type="text" id="video_url" name="video_url" class="form-control" value="{{ $curriculum->video_url }}">
    </div>

    <div class="form-group">
        <label for="description">Description:</label>
        <textarea id="description" name="description" class="form-control" rows="4">{{ $curriculum->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="alway_delivery_flg">Always Delivery:</label>
        <input type="checkbox" id="alway_delivery_flg" name="alway_delivery_flg" {{ $curriculum->alway_delivery_flg ? 'checked' : '' }}>
    </div>

    <button type="submit" class="btn btn-primary">Update Curriculum</button>
</form>
