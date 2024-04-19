let loop=0;
//初期表示
$(function(){   
    let url = location.href;
    if(url == 'http://localhost/influencer_education/public/admin/banner'){
        bannerList();
       // console.log(loop+'繰り返し');
    };
    
});

//一覧表示
function bannerList(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        type:'POST',
        async: true,
        timeout: 10000,
        url:'banner/list',
        datatype: 'json',

    }).done(function (res){
        loop = res.length;
        for($i=1;$i<res.length+1;$i++){
            $('#bannerBlock').append(
                "<div class='d-flex align-items-center ms-lg-5 ps-5 my-2'>"+
                    "<div class='w-25 me-5'>"+
                        "<img class='w-100 mx-4' src='../storage/"+res[$i-1].image+"' id='image"+$i+"'>"+
                    "</div>"+
                    "<input class='bannerFile' type='file' name='img"+$i+"'>"+
                    "<input class='d-none' type='text' name='"+$i+"' value='"+res[$i-1].id+"'>"+
                    "<button class='btn fw-bold fs-3 mx-4 bg-danger text-white rounded-circle  border border-white bannerDelete' type='button' name='"+$i+"' id='"+res[$i-1].id+"'>ー</button>"+
                "</div>"
            )
        };
        $('#bannerBlock').append(
            "<div class='d-none loop'>"+
                "<input class='d-none' type='text' name='loop' value='"+res.length+"' id='loopNum'>"+
                "<p>"+res.length+"</p>"+
            "</div>"
        )
        
       

    }).fail(function(jqXHR, textStatus, errorThrown){
        console.log('ファイルの取得に失敗しました。');
                    console.log("ajax通信に失敗しました");
                    console.log("jqXHR          : " + jqXHR.status); 
                    console.log("textStatus     : " + textStatus);    
                    console.log("errorThrown    : " + errorThrown.message);
                    console.log("URL            : " + url);
    }).always(function() {

    });
}

//変更画像のプレビュー
$(document).on('change','.bannerFile',function(){ 
    console.log('ファイル');
    let id = $(this).prev();
    let elem = this;
    let fileReader = new FileReader();
    fileReader.readAsDataURL(elem.files[0]);                   
    fileReader.onload = (function () {                          
        let imgTag = `<img class="w-100 mx-4" src='${fileReader.result}'>`         
        id.html(imgTag);            
    });
    
});

//入力欄の追加
$(document).on('click','#bannerCreate',function(){
    loop++;
    $test = 'none';
    console.log(loop);
    
    $('#bannerBlock').append(
        "<div class='d-flex align-items-center ms-lg-5 ps-5 my-2' id='image"+loop+"'>"+
            "<div class='w-25 me-5'>"+
                "<img class='w-100 mx-4' src='../storage/img/none.jpg'>"+
            "</div>"+
            "<input class='bannerFile' type='file' name='image"+loop+"'>"+
            "<input class='d-none' type='text' name='"+loop+"' value='"+$test+"'>"+
            "<button class='btn fw-bold fs-3 mx-4 bg-danger text-white rounded-circle  border border-white Delete' type='button' name='"+loop+"' id='"+$test+"'>ー</button>"+
        "</div>"
    )
});

//登録ボタンの押下
$(document).on('click','#bannerEdit',function(){
  $('#bannerForm').submit()
});

//バナーデータ削除
$(document).on('click','.bannerDelete',function(){
    $loopNum = $(this).attr('name');
    $delNum = $(this).attr('id');
    $imgUrl = $("#image"+$loopNum).attr('src');
    $imgPath = $imgUrl.substr(11);
    console.log($imgUrl );

    if(!confirm($loopNum+'番目のバナー画像を削除しますか？')){
        return false;
    }else{
        var data = {
            'id' : $delNum,
            'imgPath' : $imgPath,
        };

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
            type:'POST',
            async: true,
            timeout: 10000,
            url:'banner/delete',
            datatype: 'json',
            data: data

        }).done(function (){
           console.log('接続できました');
           $('#bannerBlock').empty();
           bannerList();
           $('#flash_message').text('削除しました');

        }).fail(function(jqXHR, textStatus, errorThrown){
            console.log('ファイルの取得に失敗しました。');
                        console.log("ajax通信に失敗しました");
                        console.log("jqXHR          : " + jqXHR.status); 
                        console.log("textStatus     : " + textStatus);    
                        console.log("errorThrown    : " + errorThrown.message);
                        console.log("URL            : " + url);
        }).always(function() {

        });
    }
});

//入力欄削除
$(document).on('click','.Delete',function(){
    $loopNum = $(this).attr('name');
    $('#image'+$loopNum).empty();
    console.log($loopNum);

});