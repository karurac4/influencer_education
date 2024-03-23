// 各ボタンの要素を取得
var btn1 = document.getElementById('btn1');
var btn2 = document.getElementById('btn2');

// 全てのボタンを配列として取得
var allButtons = document.getElementsByClassName('btn');

// 画像の要素を取得
var img = document.getElementById('img');

// ボタンがクリックされたときの処理を設定
btn1.addEventListener('click', function() {
    changeImage("{{ asset('storage/images/コーラ.jpg') }}");
    setActiveButton(btn1);
});

btn2.addEventListener('click', function() {
    changeImage("{{ asset('storage/images/なっちゃん.jpg') }}");
    setActiveButton(btn2);
});

// 画像を切り替える関数
function changeImage(path) {
    img.src = path;
}

// アクティブなボタンを設定する関数
function setActiveButton(activeButton) {
    // すべてのボタンから 'show' クラスを削除
    for (var i = 0; i < allButtons.length; i++) {
        allButtons[i].classList.remove('show');
    }

    // アクティブなボタンに 'show' クラスを追加
    activeButton.classList.add('show');
}

// クラス 'btn' を持つすべてのボタンに対してクリックイベントリスナーをアタッチ
Array.from(document.getElementsByClassName('btn')).forEach(function(button) {
    button.addEventListener('click', function() {
        // ここでは、クリックされたボタンに応じて画像を変更し、アクティブなボタンを設定する例を示しています。
        // 具体的な要件に応じてこの部分を調整する必要があります。
        changeImage("{{ asset('storage/images/コーラ.jpg') }}"); // 例の画像パス
        setActiveButton(this);
    });
});





document.getElementById('notice-container').addEventListener('click', function() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});

//サムネイルの切り替え
const images = document.querySelectorAll('.thumb');
let currentImageIndex = 0;

images.forEach(function(item, i) {
    item.onclick = function() {
        currentImageIndex = i;
        displayCurrentImage();
    };
});

function displayCurrentImage() {
    document.getElementById('mainImg').src = images[currentImageIndex].dataset.image;
}

//buttonで画像の切り替え
function changeImage(num) {
    currentImageIndex += num;
    if (currentImageIndex >= images.length) {
        currentImageIndex = 0; // ループして最初に戻る
    } else if (currentImageIndex < 0) {
        currentImageIndex = images.length - 1; // ループして最後に戻る
    }
    displayCurrentImage();
};

document.getElementById('prev').onclick = function() {
    changeImage(-1);
};

document.getElementById('next').onclick = function() {
    changeImage(1);
};




var changeImageButton = document.getElementById('changeImageButton');
changeImageButton?.addEventListener('click', function() {
    document.getElementById('imageToChange').src = "{{ asset('storage/images/なっちゃん.jpg') }}";
});