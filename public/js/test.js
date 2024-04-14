// ここから削除非同期処理の記述
// function deleteEvent() {
$(function () {
    $('.btn-danger').on('click', function (e) {
        e.preventDefault();
        var deleteConfirm = confirm('削除してよろしいでしょうか？');
        if (deleteConfirm == true) {
            console.log('削除非同期開始');
            var clickEle = $(this)
            var article = clickEle.attr('data-article_id');
            var deleteTarget = clickEle.closest('tr');

            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: 'destroy',
                    dataType: 'json',
                    data: {
                        'article': article
                    },
                })

                .done(function () {
                    console.log('削除通信成功');
                    deleteTarget.remove();
                })
                .fail(function () {
                    alert('エラー');
                });

            //”削除しても良いですか”のメッセージで”いいえ”を選択すると次に進み処理がキャンセルされます
        } else {
            (function (e) {
                e.preventDefault()
            });
        };
    });
});
