@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Curriculums</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Thumbnail</th>
                    <th>Description</th>
                    <th>Video URL</th>
                    <th>Always Delivery</th>
                    <th>Class ID</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Delivery Times</th> <!-- 配信日時を表示するための見出し -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($curriculums as $curriculum)
                    <tr>
                        <td>{{ $curriculum->title }}</td>
                        <td>{{ $curriculum->thumbnail }}</td>
                        <td>{{ $curriculum->description }}</td>
                        <td>{{ $curriculum->video_url }}</td>
                        <td>{{ $curriculum->alway_delivery_flg ? 'Yes' : 'No' }}</td>
                        <td>{{ $curriculum->grade_id }}</td>
                        <td>{{ $curriculum->created_at }}</td>
                        <td>{{ $curriculum->updated_at }}</td>
                        <td>
                            <!-- 配信日時を表示 -->
                            @foreach($curriculum->deliveryTimes as $deliveryTime)
                                <div>
                                    <p>Delivery From: {{ $deliveryTime->delivery_from }}</p>
                                    <p>Delivery To: {{ $deliveryTime->delivery_to }}</p>
                                </div>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('curriculums.delivery_time', $curriculum) }}" class="btn btn-primary">Check Delivery Time</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
