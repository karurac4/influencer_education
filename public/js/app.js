function showImage(imageId) {
    // すべての画像を非表示にする
    document.querySelectorAll('.banner').forEach(function(img) {
        img.style.display = 'none';
    });

    // クリックされたボタンに対応する画像を表示する
    document.getElementById('image-' + imageId).style.display = 'block';
}