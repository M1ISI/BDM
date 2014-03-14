
var rolText_k=3; //菜单总数
var rolText_i=1; //菜单默认值
  rolText_tt=setInterval("rolText(1)",3000);   //设置3秒间隔变幻
function rolText(a){

rolText_i+=a;
if (rolText_i>rolText_k){rolText_i=1;}
if (rolText_i==0){rolText_i=rolText_k;}

for (var jj=1; jj<=rolText_k; jj++){
document.getElementById("rolTextMenu"+jj).style.display="none";
 }
document.getElementById("rolTextMenu"+rolText_i).style.display="block";


obj=document.getElementById("rolTextMenu"+rolText_i);
obj.onmouseover=function(){  clearInterval(rolText_tt); } //层在鼠标移上时清除上面的间隔事件，实现层在的鼠标移上时停止运动的效果
obj.onmouseout=function(){rolText_tt=setInterval("rolText(1)", 3000)}   //层在鼠标移开时开始间隔事件，实现层在的鼠标移开时继续运动的效果  
} 


<!--
var rollText_k=2; //菜单总数
var rollText_i=1; //菜单默认值
  //rollText_tt=setInterval("rollText(1)",8000);   设置8秒间隔变幻
function rollText(a){
   // clearInterval(rollText_tt);
	// rollText_tt=setInterval("rollText(1)",8000);
rollText_i+=a;
if (rollText_i>rollText_k){rollText_i=1;}
if (rollText_i==0){rollText_i=rollText_k;}
//alert(i)
for (var j=1; j<=rollText_k; j++){
document.getElementById("rollTextMenu"+j).style.display="none";
 }
document.getElementById("rollTextMenu"+rollText_i).style.display="block";
// document.getElementById("pageShow").innerHTML = rollText_i+"/"+rollText_k;   显示当前页
} 
//-->


function disp(id)
{	var t1=document.getElementById("t1");
	var t2=document.getElementById("t2");
	if(id == "t1")
	{
		t1.style.display = "" ;
		t2.style.display = "none";
	}
	else
	{
		t1.style.display = "none" ;
		t2.style.display = "" ;
	}
	return true ;
}

function jump(obj)
{
	url = obj.options[obj.options.selectedIndex].value ;
	
	window.open(url,"_blank");
	return true ;
}


<!--
function mOver(){
document.getElementById("layer").style.display="block";
}
function mOut(){
document.getElementById("layer").style.display="none";
}
function mOver1(){
document.getElementById("layer1").style.display="block";
}
function mOut1(){
document.getElementById("layer1").style.display="none";
}
function mOver2(){
document.getElementById("layer2").style.display="block";
}
function mOut2(){
document.getElementById("layer2").style.display="none";
}
function mOver3(){
document.getElementById("layer3").style.display="block";
}
function mOut3(){
document.getElementById("layer3").style.display="none";
}
function mOver4(){
document.getElementById("layer4").style.display="block";
}
function mOut4(){
document.getElementById("layer4").style.display="none";
}
function mOver5(){
document.getElementById("layer5").style.display="block";
}
function mOut5(){
document.getElementById("layer5").style.display="none";
}
function mOver6(){
document.getElementById("layer6").style.display="block";
}
function mOut6(){
document.getElementById("layer6").style.display="none";
}

//-->

<!--
function mOver7(){
document.getElementById("layer7").style.display="block";
}
function mOut7(){
document.getElementById("layer7").style.display="none";
}
function mOver8(){
document.getElementById("layer8").style.display="block";
}
function mOut8(){
document.getElementById("layer8").style.display="none";
}
function mOver9(){
document.getElementById("layer9").style.display="block";
}
function mOut9(){
document.getElementById("layer9").style.display="none";
}
function mOver10(){
document.getElementById("layer10").style.display="block";
}
function mOut10(){
document.getElementById("layer10").style.display="none";
}
function mOver11(){
document.getElementById("layer11").style.display="block";
}
function mOut11(){
document.getElementById("layer11").style.display="none";
}
function mOver12(){
document.getElementById("layer12").style.display="block";
}
function mOut12(){
document.getElementById("layer12").style.display="none";
}
function mOver13(){
document.getElementById("layer13").style.display="block";
}
function mOut13(){
document.getElementById("layer13").style.display="none";
}

//-->



