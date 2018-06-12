var url=window.location.href;
var score=url.split("?")[1].split("=")[1];
var scores=score*100;
$.ajax({
  type:'post',
  data:{"score":scores},
  url:'php/record_score.php',
  success:function(data) {
  	   var alldata=JSON.parse(data);
  	   var str='最辉煌的成绩:'+alldata.lastScore+'当前排名:'+alldata.count;

  	   $('#all-money').html(alldata.newScore);
  	   $('#txt-score').val(str);
  }

});
$("#share-friends").on('click',function(){
	$(".main-btn").css('display','none');
	$("#share-friends").css('display','none');
})