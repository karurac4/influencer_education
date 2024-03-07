<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Delivery Time</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .separator {
            position: relative;
            top: 32px; /* フォームの高さに合わせて調整 */
            font-weight: bold;
        }
        .form-group {
            margin-bottom: 0; /* フォームグループの間の余白を削除 */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Edit Delivery Time</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('delivery_times.store') }}">
    @csrf

    @for ($i = 0; $i < 3; $i++)
    <div class="form-row">
        <div class="form-group col-md-4">
            <label for="start_date_{{ $i }}">Start Date (YYYYMMDD):</label>
            <input type="text" id="start_date_{{ $i }}" name="delivery_from_date[]" class="form-control" value="{{ isset($deliveryTimes[$i]) ? substr(str_replace('-', '', $deliveryTimes[$i]->delivery_from), 0, 8) : '' }}">
        </div>
        <div class="form-group col-md-2">
            <label for="start_time_{{ $i }}">Start Time (HH:MM):</label>
            <input type="text" id="start_time_{{ $i }}" name="delivery_from_time[]" class="form-control" value="{{ isset($deliveryTimes[$i]) ? substr($deliveryTimes[$i]->delivery_from, 11, 5) : '' }}">
        </div>
        <div class="form-group col-md-1 separator">
            〜
        </div>
        <div class="form-group col-md-4">
            <label for="end_date_{{ $i }}">End Date (YYYYMMDD):</label>
            <input type="text" id="end_date_{{ $i }}" name="delivery_to_date[]" class="form-control" value="{{ isset($deliveryTimes[$i]) ? substr(str_replace('-', '', $deliveryTimes[$i]->delivery_to), 0, 8) : '' }}">
        </div>
        <div class="form-group col-md-2">
            <label for="end_time_{{ $i }}">End Time (HH:MM):</label>
            <input type="text" id="end_time_{{ $i }}" name="delivery_to_time[]" class="form-control" value="{{ isset($deliveryTimes[$i]) ? substr($deliveryTimes[$i]->delivery_to, 11, 5) : '' }}">
        </div>
    </div>
    @endfor

    <input type="hidden" name="curriculums_id" value="{{ $curriculum->id }}">

    <button type="submit" class="btn btn-primary">Add Delivery Time</button>
</form>
    </div>
    <!-- Bootstrap JS (jQuery is required) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
