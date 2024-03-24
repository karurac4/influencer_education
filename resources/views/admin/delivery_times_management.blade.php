<!DOCTYPE html>
<html lang="ja">
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
        .add-delivery-time-btn {
            margin-bottom: 10px;
        }
        .remove-delivery-time {
            margin-left: 10px;
        }
    </style>
</head>
<body>
<a href="{{ route('curriculums.index') }}" class="btn btn-secondary">Back</a>
<div class="container">
<h1 class="mb-4">配信日時編集</h1>
    <div class="row">
        <div class="col">
            <h2>{{ $curriculum->title }}</h2>
        </div>
    </div>    

<form id="delivery-time-form" method="POST" action="{{ route('delivery_times.store') }}">
        @csrf


        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div id="delivery-time-fields">
            <div class="form-row">
            <input type="hidden" name="curriculums_id" value="{{ $curriculum->id }}">
                <div class="form-group col-md-3">
                    <label for="start_date">開始日 (YYYYMMDD):</label>
                    <input type="text" id="start_date" name="delivery_from_date[]" class="form-control" value="{{ old('delivery_from_date.0', isset($deliveryTimes[0]) ? substr(str_replace('-', '', $deliveryTimes[0]->delivery_from), 0, 8) : '') }}">
                </div>
                <div class="form-group col-md-2">
                    <label for="start_time">時刻 (HH:MM):</label>
                    <input type="text" id="start_time" name="delivery_from_time[]" class="form-control" value="{{ old('delivery_from_time.0', isset($deliveryTimes[0]) ? substr($deliveryTimes[0]->delivery_from, 11, 5) : '') }}">
                </div>
                <div class="form-group col-md-1 separator">〜</div>
                <div class="form-group col-md-3">
                    <label for="end_date">終了日 (YYYYMMDD):</label>
                    <input type="text" id="end_date" name="delivery_to_date[]" class="form-control" value="{{ old('delivery_to_date.0', isset($deliveryTimes[0]) ? substr(str_replace('-', '', $deliveryTimes[0]->delivery_to), 0, 8) : '') }}">
                </div>
                <div class="form-group col-md-2">
                    <label for="end_time">時刻 (HH:MM):</label>
                    <input type="text" id="end_time" name="delivery_to_time[]" class="form-control" value="{{ old('delivery_to_time.0', isset($deliveryTimes[0]) ? substr($deliveryTimes[0]->delivery_to, 11, 5) : '') }}">
                </div>
                <div class="form-group col-md-1 align-self-end">
                    <button class="btn btn-danger remove-delivery-time">×</button>
                </div>
            </div>
        </div>
        <button id="add-delivery-time" type="button" class="btn btn-success mt-2">＋</button>   
        <button type="submit" class="btn btn-primary mt-2">登録</button>


    </form>
</div>



<!-- Bootstrap JS (jQuery is required) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


<script>
$(document).ready(function () {
    var index = {{ count($deliveryTimes) }};
  
    // フォームを追加
    $("#add-delivery-time").click(function (e) {
        e.preventDefault(); 
        var newField = `
        <div class="form-row">
            <input type="hidden" name="curriculums_id[]" value="{{ $curriculum->id }}">
            <div class="form-group col-md-3">
                <label for="start_date_${index}">開始日 (YYYYMMDD):</label>
                <input type="text" id="start_date_${index}" name="delivery_from_date[]" class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label for="start_time_${index}">時刻 (HH:MM):</label>
                <input type="text" id="start_time_${index}" name="delivery_from_time[]" class="form-control">
            </div>
            <div class="form-group col-md-1 separator">〜</div>
            <div class="form-group col-md-3">
                <label for="end_date_${index}">終了日 (YYYYMMDD):</label>
                <input type="text" id="end_date_${index}" name="delivery_to_date[]" class="form-control">
            </div>
            <div class="form-group col-md-2">
                <label for="end_time_${index}">時刻 (HH:MM):</label>
                <input type="text" id="end_time_${index}" name="delivery_to_time[]" class="form-control">
            </div>
            <div class="form-group col-md-1 align-self-end">
                <button class="btn btn-danger remove-delivery-time">×</button>
            </div>
        </div>
        `;
        $("#delivery-time-fields").append(newField);
        index++;
        loadDeliveryTimeData(index);
    });

    // 削除機能
    $(document).on("click", ".remove-delivery-time", function () {
        $(this).closest(".form-row").remove();
    });

    // 最新のデータを再読み込み
    function loadDeliveryTimeData(index) {  
        $.ajax({
            url: "{{ route('get_delivery_times') }}",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                console.log("Data received from server:", data); // サーバーから受信したデータをログに表示
               
                if (data.length >= index) {
                    $("#start_date_" + index).val(data[index - 1].delivery_from_date);
                    $("#start_time_" + index).val(data[index - 1].delivery_from_time);
                    $("#end_date_" + index).val(data[index - 1].delivery_to_date);
                    $("#end_time_" + index).val(data[index - 1].delivery_to_time);
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.log("Error:", xhr.responseText);
            }
        });
    }

    // フォーム送信を非同期で行う
    $("#delivery-time-form").submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize(); 
        $.ajax({
            url: "{{ route('delivery_times.store') }}",
            type: 'POST',
            data: formData,
            success: function(response) {
                // 成功した場合の処理
                console.log("Success:", response);
            },
            error: function(xhr, textStatus, errorThrown) {
                // エラーが発生した場合の処理
                console.log("Error:", xhr.responseText);
            }
        });
    });
});

</script>





</body>
</html>
