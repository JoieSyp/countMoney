// 轮播播放
var  carouselFigure=function(){
  var timer=null;
  var newIndx=0;
  var len=$("#count-content div").length;
  timer=setInterval(function(){
      $("#count-content div").each(function(index,value){
      $(value).css('opacity','0');
    });
    newIndx++;
    if (newIndx>len-1) {
      newIndx=0;
    }
    $("#count-content div").eq(newIndx).css('opacity',1);

  },2000)
  clearInterval(timer);
  
}; 
// 轮播执行
carouselFigure();
// 数钱滑动方法就按照下边
// touchmove  触摸手机端事件
var num=0;
var bol=false;
var money=document.getElementById("money");
var timers=null;
  var block=5;
// creatImg();
// 滑动的效果
var handle_move=function(){
  // 生成一个钱；
  bol=true;
  createImg();
  setTimeout(function(){
      money.removeChild(document.getElementById('move-money'));
  },3000);
   num++;
   OpareteNum($("#money-count .count-num"),num);
};
money.addEventListener('touchstart',handle_move,false);


  timers=setInterval(function(){
       if(bol){
          if (block==0) {
               //bol=false;
               clearInterval(timers);
               console.log(num);
               money.removeEventListener('touchstart',handle_move,false);
               window.location.href="http://sypkings.applinzi.com/countMoney/person_score.html?score="+num;
              $(".last").html(0);
          }else{
              block--;
              $(".last").html(block);
          }
      }
    },1000); 


// // 生成一个新的钱
function createImg(){
  var img=document.createElement('img');
    img.setAttribute('src','images/money.png');
    img.setAttribute('id','move-money');
    money.insertBefore(img,money.childNodes[0]);
};
// 操作数字
function OpareteNum(element,num){
  // console.log(element.eq(2).html(num));
   switch(true){
    case num<10:
       element.eq(2).html(num);
       break;
    case (num>=10 && num<100):
       element.eq(1).html(parseInt(num/10));
       element.eq(2).html((num%10));
        break;
    case num>=100:
        var handred=parseInt(num/100);
        var decade=parseInt(num-handred*100);
        element.eq(0).html(handred);
        element.eq(1).html(parseInt((num-handred*100)/10));
        element.eq(2).html(decade%10);
        break;
   }
}










