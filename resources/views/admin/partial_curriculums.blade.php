
    <h1 class="mb-4">Curriculums</h1>
    <div class="row">
        @foreach($curriculums as $curriculum)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <img src="{{ asset('storage/' . $curriculum->thumbnail) }}" class="card-img-top img-thumbnail" alt="Thumbnail" style="max-height: 200px; max-width: 200px;">
                <div class="card-body">
                    <h5 class="card-title">{{ $curriculum->title }}</h5>
                    <ul class="list-unstyled">
                        @foreach($curriculum->deliveryTimes as $deliveryTime)
                        <li>
                            <p>{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $deliveryTime->delivery_from)->format('m-d H:i') }} ～ {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $deliveryTime->delivery_to)->format('m-d H:i') }}</p>
                        </li>
                        @endforeach
                    </ul>
                    <div class="btn-group" role="group">
                        <a href="{{ route('curriculums.delivery_time', $curriculum) }}" class="btn btn-primary">配信日時編集</a>
                        <a href="{{ route('curriculum.edit', $curriculum) }}" class="btn btn-warning">授業内容編集</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
