
//変数
$date = new Date();
//$grade = '';

$day = $date.getDate();
$hour = $date.getHours();
$minute = $date.getMinutes();
$Second = $date.getSeconds();
$tes = 'クリック';
//console.log($tes);



//初期表示
$(function(){   
    let url = location.href;
    if(url == 'http://localhost/influencer_education/public/user/timetable'){
        $year = $date.getFullYear();
        $month = $date.getMonth()+1;
        
        classBtn();  
        search();
        
    };
    
});

//カリキュラムの開講年と開講月の表示
$(document).on('click','#dataInc',function(){
    $date.setMonth($date.getMonth() +1);
    $year = $date.getFullYear();
    $month = $date.getMonth()+1;
    $('#date').html('<h3>'+$year+'年'+$month+'月スケジュール</h3>');
    search();
    return false;
});

$(document).on('click','#dataDec',function(){
    $date.setMonth($date.getMonth() -1);
    $year = $date.getFullYear();
    $month = $date.getMonth()+1;
    $('#date').html('<h3>'+$year+'年'+$month+'月スケジュール</h3>');
    search();
    return false;
});

//学年ボタンの表示
function classBtn(){
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        type:'POST',
        async: true,
        timeout: 10000,
        url:'timetable/classBtn',
        datatype: 'json',

    }).done(function (res){
        $classKey = Object.keys(res[0]);
        $clearflg = res[0];
        $gradeCount = 0;
        for(i=1;i<=res[1];i++){
            if(i==$classKey[i-1]){
               $gradeCount++;   
            }else{
                
            }    
        };
        for(i=0;i<=$gradeCount;i++){
            $('#classesBlock').append(
                "<h6 class='btn m-auto mb-3 px-auto py-1 border border-secondary bg-primary text-white rounded classLink' id='"+res[2][i].id+"'>"+res[2][i].name+"</h6>"
            ) 
        };
        for(i=$gradeCount+2;i<res[1];i++){
            $('#classesBlock').append(
                "<h6 class='btn m-auto mb-3 px-auto py-1 border border-secondary bg-secondary text-white rounded' id='"+res[2][i-1].id+"'>"+res[2][i-1].name+"</h6>"
            )
        };
        $grade = res[2][$gradeCount].name;
        $gradeNum = res[2][$gradeCount].id;
        $('#grade').html('<h4 class="mx-4 px-3 py-1 border border-secondary bg-primary text-white rounded grade" id="'+$gradeNum+'">'+$grade+'</h4>');
        $('#date').html('<h3>'+$year+'年'+$month+'月スケジュール</h3>');

    }).fail(function(jqXHR, textStatus, errorThrown){
        console.log('ファイルの取得に失敗しました。');
                    console.log("ajax通信に失敗しました");
                    console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
                    console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
                    console.log("errorThrown    : " + errorThrown.message); // 例外情報
                    console.log("URL            : " + url);
    }).always(function() {

    });
};

//学年の切り替え
$(document).on('click','.classLink',function(){
    $grade = $(this).text();
    $gradeNum = $(this).attr('id');
    $('#grade').html('<h4 class="mx-4 px-3 py-1 border border-secondary bg-primary text-white rounded grade" id="'+$gradeNum+'">'+$grade+'</h4>');
    search();
    return false;
});

//詳細ページへ
$(document).on('click','#curriculumField',function(){
    let Link = $(this).attr('name');
    console.log(Link+'に飛びます');
   // window.location.href = 'http://localhost/influencer_education/public/user/timetable'+Link
});

//検索機能
function search(){
    $gradeNum = $('.grade').attr('id');
    $dateFrom = $year*10000000000+$month*100000000+31*1000000;
    $dateTo = $year*10000000000+$month*100000000+1*1000000;
    var data = {
        'grade' : $gradeNum,
        'date_from' : $dateFrom,
        'date_to' : $dateTo,
    };

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        type:'POST',
        async: true,
        timeout: 10000,
        url:'timetable/search',
        datatype: 'json',
        data: data

    }).done(function (res){
        $curriculums = res[0];
        $delivery_times = res[1];
        console.log(res[1]);

        $('#curriculumBlock').empty();
        for(i=0; i<$curriculums.length;i++){
            $('#curriculumBlock').append(
                "<div class='col' id='curriculumField' name='"+$curriculums[i].id+"'>"+
                "<div class='card my-2 ms-2'>"+
                "<img src='../storage/"+$curriculums[i].thumbnail+"' class='card-img-top p-2'>"+
                "<div class='card-body"+i+" p-2'>"+
                "<h5 class='card-title'>"+$curriculums[i].title+"</h5>"
            )
            for(j=0; j<res[1][i].length;j++){
                $('.card-body'+[i]).append(
                    "<span class='card-text'>"+$delivery_times[i][j]+"</span></br>"
                )        
            }
            $('.card-body'+[i]).append(
                "</div></div></div>"
            )

        }
       
        return false;

    }).fail(function(jqXHR, textStatus, errorThrown){
        console.log('ファイルの取得に失敗しました。');
                    console.log("ajax通信に失敗しました");
                    console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
                    console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
                    console.log("errorThrown    : " + errorThrown.message); // 例外情報
                    console.log("URL            : " + url);
    }).always(function() {

    });
};