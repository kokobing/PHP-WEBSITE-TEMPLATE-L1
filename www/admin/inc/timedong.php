<script language="JavaScript">
document.write('<div id="Today"></div>');
var a=0; 
function clock() {
sec=<? echo strtotime('8 hours')?>+a; //(GMT+8:00)时区:中国标准时间
S=sec%60; //秒
I=Math.floor(sec/60)%60; //分
H=Math.floor(sec/3600)%24; //时
if(S<10) S='0'+S;
if(I<10) I='0'+I;
if(H<10) H='0'+H;
timeStr=H+':'+I+':'+S;
Today.innerHTML = timeStr;
a++;
}
clock(); //这行可以不要,只为初始化...
setInterval(clock,1000);
</script>
