<?php defined('IN_DESTOON') or exit('Access Denied');?><div id="floatTips" style="position:fixed;_position:absolute;padding: 3px;top: 150px;right: 125px;width: 30px;height: 300px;z-index:999;display:;">
  <div id="serviceCenter">
    <div class="sc_header"> <font style="float:left;margin:6px 0 0 10px">客服中心</font> <a href="javascript:;" title="关闭" style="width:15px;height:16px;display:block;margin:7px 0 0 45px;float:left;" onclick="document.getElementById('floatTips').style.display='none'"></a> </div>
    <ul class="sc_ul" id="sc_ul">
      <li id="sc_0">
        <h3><font class="li_down" id="sc_pre"></font><font style="float:left;margin:8px 0 0 9px;font-weight:700;">拍前咨询</font></h3>
        <div style="display:block;height:144px; line-height:22px;" id="sc_yes_sale">   <a target="_blank" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $DT['kfqq'];?>&site=qq&menu=yes"  style="float:right;cursor:pointer;position:relative;top:8px;left:-20px;"  ><img src='<?php echo DT_SKIN;?>image/wenbao/counseling_style_52.png' /></a>  <br />
<br />
&nbsp;服务热线：<br />
&nbsp;<font style="color:#990000"><strong><?php print_r($DT['telephone']);?></strong></font>
</div>
      </li>
      
      
      
    </ul>
  </div>
</div>
<script>
var scLiObjs=document.getElementById("sc_ul").getElementsByTagName("li");
for(var i = 0 ; i<scLiObjs.length;i++){
scLiObjs[i].onclick=function (){
var liObjs = this.parentNode.getElementsByTagName("li"); //获取父UL节点 LI标签们
for (var j=0;j<liObjs.length;j++){
if (liObjs[j]==this){
this.getElementsByTagName("font")[0].className = "li_down";
this.getElementsByTagName("div")[0].style.display="block";
}else{
liObjs[j].getElementsByTagName("font")[0].className = "li_left";
liObjs[j].getElementsByTagName("div")[0].style.display="none";
}
}

}
}
  
 
//<![CDATA[  
var tips; var theTop = 96/*这是默认高度,越大越往下*/; var old = theTop;
function initFloatTips() {
tips = document.getElementById('floatTips');
moveTips();
};
function moveTips() {
var tt = 50;
if (window.innerHeight) {
pos = window.pageYOffset
}
else if (document.documentElement && document.documentElement.scrollTop) {
pos = document.documentElement.scrollTop
}
else if (document.body) {
pos = document.body.scrollTop;
}
pos = pos - tips.offsetTop + theTop;
pos = tips.offsetTop + pos / 10;
if (pos < theTop) pos = theTop;
if (pos != old) {
tips.style.top = pos + "px";
tt = 10;
}
old = pos;
setTimeout(moveTips, tt);
}
//!]]> 
if(navigator.appVersion.indexOf("MSIE 6")>-1){
var tmptips = document.getElementById('floatTips')
//tmptips.style.cssText="display:absolute;top:10px;"

initFloatTips()
}

slideAd('ZhujiwuTopAd',8); //控制顶部浮动广告

</script>
<div style="clear:both"></div>
<div class="footer"><a href="<?php echo $MODULE['1']['linkurl'];?>">网站首页</a>  <?php echo tag("table=webpage&condition=item=1&areaid=$cityid&order=listorder desc,itemid desc&template=list-webpage");?> <br />
 <?php echo $DT['copyright'];?></div>
 
<div id="back2top" class="back2top"><a href="javascript:void(0);" title="返回顶部">&nbsp;</a></div>
<script type="text/javascript">
<?php if($destoon_task) { ?>
show_task('<?php echo $destoon_task;?>');
<?php } else { ?>
<?php include DT_ROOT.'/api/task.inc.php';?>
<?php } ?>
<?php if($lazy) { ?>$(function(){$("img").lazyload();});<?php } ?>
$('#back2top').click(function() {
$("html, body").animate({scrollTop:0}, 200);
});
</script>