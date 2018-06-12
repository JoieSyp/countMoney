// 首页面的几大事件
// 点击事件
$("#start").on('click',function(){
    $.ajax({
       type:'post',
       url:'php/start.php',
       success:function(data){
         if (data=='1') {
            $(".main-btn").css('display','block');
            $("#login").css('display','block');
         }else{    
             var alldata=JSON.parse(data);
             $('#username').val(alldata.userName);
             $('#userphone').val(alldata.userPhone);
             $(".main-btn").css('display','block');
             $("#login").css('display','block');

         }

       }


    })
  
})



// 活动规则几大点击事件
$(".common-list").each(function(index,value){
    $(value).on('click',function(){
       $(".main-btn").css('display','block');
       $(".special-common").eq(index).css('display','block');
    })
})
// 取消事件
$(".cancle-btn").each(function(index,value){
   $(value).on('click',function(){
        $(".main-btn").css('display','none');
        $(".bomb-common").eq(index).css('display','none'); 
   });
});
$("#cancle-btn").on('click',function(){
        $(".main-btn").css('display','none');
        $("#login").css('display','none'); 
});

// 再来一次
$("#again-person").on('click',function(){
   window.location.href="main.html";
})
// 分享给别人
$("#share-person").on('click',function(){
    $(".main-btn").css('display','block');
    $(".again-common").css('display','block');
})
// 进行数据请求传入数据库
 $('#submit').on('click',function(){
     var username=$('#username').val();
     var userphone=$('#userphone').val();
     if (username!=''&& userphone!='') {
        $.ajax({
        type:'post',
        url:'php/main.php',
        data:{'username':username,'userphone':userphone},
        success:function(data){
          // 返回是不是更新了数据
            var alldata=JSON.parse(data);
            alert(alldata.msg);
           if (alldata.msg=="1" || alldata.msg=="2") {
              window.location.href='http://sypkings.applinzi.com/countMoney/main.html';
           }else{
             alert("数据不能为空");
           }
           
        }
      })
     }else{
        console.log("输入数据不能为空");
     }
 });

// 数钱榜获取数据
var arrImg=['images/first-score.png','images/second-score.png','images/third-score.png'];
$('#count-list').on('click',function(){
    $.ajax({
          type:'post',
          url:'php/count_list.php',
          success:function(data){
              $(".main-btn").css('display','block');
              $("#count-listinfo").css('display','block');
              if (data=='0') {
                 console.log("数据没有数据快去找玩家");
              }else{
                 var alldata=JSON.parse(data);
                 $('#player-list').html("");
                  var i=4;
                  $.each(alldata,function(index,element){
                    var str1='</div><div class="player-content"><div class="player-head">';
                  
                    if (index==0) {var str='<li><div class="rank-name"><img src="'+arrImg[index]+'">'+str1;
$oli=$(str+'<img src="'+alldata[index].headImgurl+'"/></div>'+'<span>'+alldata[index].nikename+'</span></div><span class="player-score">￥'+alldata[index].score+'</span></li>');
                      $oli.appendTo($("#player-list"));
                    }
                    if (index==1) {var str='<li><div class="rank-name"><img src="'+arrImg[index]+'">'+str1;
$oli=$(str+'<img src="'+alldata[index].headImgurl+'"/></div>'+'<span>'+alldata[index].nikename+'</span></div><span class="player-score">￥'+alldata[index].score+'</span></li>');
                     $oli.appendTo($("#player-list"));
                    }
                    if (index==2) {var str='<li><div class="rank-name"><img src="'+arrImg[index]+'">'+str1;
$oli=$(str+'<img src="'+alldata[index].headImgurl+'"/></div>'+'<span>'+alldata[index].nikename+'</span></div><span class="player-score">￥'+alldata[index].score+'</span></li>');
                      $oli.appendTo($("#player-list"));
                     }
                 
                    if (index>=3) {

                    var str='<li><div class="rank-name">'+i+str1;
$oli=$(str+'<img src="'+alldata[index].headImgurl+'"/></div>'+'<span>'+alldata[index].nikename+'</span></div><span class="player-score">￥'+alldata[index].score+'</span></li>');
                   $oli.appendTo($("#player-list"));
                    i++;
                  }
                      
                })
              }
          
          }



    })

   
})





















