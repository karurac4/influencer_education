@extends('layouts.admin_layout')

@section('content')
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

    {{-- プラスボタンを押した時に追加されるフォームのテンプレート --}}
<script type="text/template" id="template-delivery-time">
    <div class="delivery-time-form-set">
        <input type="hidden" name="curriculums_id" value="{{ $curriculum->id }}">
        <input type="datetime-local" name="delivery_from[]" required>
        <input type="datetime-local" name="delivery_to[]" required>
        <button type="button" class="remove-delivery-time">削除</button>
    </div>
</script>

<form action="{{ route('delivery_times.store') }}" method="POST">
    @csrf
    <div id="delivery-time-forms">
    @forelse ($deliveryTimes as $deliveryTime)
    <div class="delivery-time-form-set">
        @php
            $deliveryFrom = \Carbon\Carbon::parse($deliveryTime->delivery_from);
            $deliveryTo = \Carbon\Carbon::parse($deliveryTime->delivery_to);
        @endphp
        <input type="hidden" name="curriculums_id" value="{{ $curriculum->id }}">
        <input type="datetime-local" name="delivery_from[]" value="{{ $deliveryFrom->format('Y-m-d\TH:i') }}" required>
        <input type="datetime-local" name="delivery_to[]" value="{{ $deliveryTo->format('Y-m-d\TH:i') }}" required>
        <button type="button" class="remove-delivery-time">削除</button>
    </div>
    @empty
    <!-- データがない場合でも最初から1つのフォームを表示 -->
    <div class="delivery-time-form-set">
        <input type="hidden" name="curriculums_id" value="{{ $curriculum->id }}">
        <input type="datetime-local" name="delivery_from[]" required>
        <input type="datetime-local" name="delivery_to[]" required>
        <button type="button" class="remove-delivery-time">削除</button>
    </div>
    @endforelse
</div>

    <button type="button" id="add-delivery-time">＋ 日時を追加</button>
    <button type="submit">登録</button>
</form>

</div>



<!-- Bootstrap JS (jQuery is required) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


<script>
$(document).ready(function () {
    // 「＋ 日時を追加」ボタンクリックイベント
    $('#add-delivery-time').click(function() {
        // テンプレートからフォームセットを複製して追加
        var template = $('#template-delivery-time').html();
        $('#delivery-time-forms').append(template);
    });

    // 動的に生成された「削除」ボタンのクリックイベント
    // 動的要素に対しては $(document).on を使う
    $(document).on('click', '.remove-delivery-time', function() {
        // フォームセットを削除
        $(this).closest('.delivery-time-form-set').remove();
    });
});

</script>


</body>
</html>
@endsection

