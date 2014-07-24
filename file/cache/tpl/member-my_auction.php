<?php defined('IN_DESTOON') or exit('Access Denied');?><?php include template('header', 'member');?>
<script language="javascript" type="text/javascript" src="../file/My97DatePicker/WdatePicker.js"></script>
<script type="text/javascript">c(1);</script>
<script  type="text/javascript" src="http://www.w3school.com.cn/jquery/jquery-1.11.1.min.js"></script>
<!-- <script>
$(document).ready(function(){
  $("p").click(function(){
    $(this).hide();
  });
  $("#butzc").click(function(){
    var zhuanchang1=$("#zhuanchang").val();
$("#zctishi").text(zhuanchang1);
  });
});
</script> -->
<script type="text/javascript">
//专场设置ajax
$(document).ready(function(){
 $("#butzc").click(function(){
 var zhuanchang88=$("#zhuanchang88").val();
  var userid=<?php echo $_userid;?>;
  if($("#zhuanchang88").val()==""){
$("#zctishi").html("<font color='red'>提示：专场不能为空！</font>");
  }else{
$.get("/member/type2.php?zhuanchang88="+zhuanchang88+"&userid="+userid,function(data){
var result=data;
if(result=="N"){
$("#zctishi").html("<font color='red'>设置失败！</font>");
}else{
$("#zctishi").html("<font color='green'>设置成功,请点击选择框选取！</font>");
$("select[name='post[mycatid]']").prepend("<option value='"+result+"'>"+zhuanchang88+"</option>");   //为Select插入一个Option(第一个位置)
} 
   });
  }
 
 });
});
</script>
<div class="menu">
<table cellpadding="0" cellspacing="0">
<tr>
<td class="tab" id="add"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&action=add"><span>添加<?php echo $MOD['name'];?></span></a></td>
<?php if($_userid) { ?>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="s3"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>"><span>已发布<span class="px10">(<?php echo $nums['3'];?>)</span></span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="s2"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=2"><span>审核中<span class="px10">(<?php echo $nums['2'];?>)</span></span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="s1"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=1"><span>未通过<span class="px10">(<?php echo $nums['1'];?>)</span></span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="s4"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=4"><span>已过期<span class="px10">(<?php echo $nums['4'];?>)</span></span></a></td>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="type"><a href="auction.php"><span>订单管理<span class="px10">(<?php echo $nums['9'];?>)</span></span></a></td>
<td class="tab" id="s5"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=5"><span>我的竞价记录<span class="px10">(<?php echo $nums['5'];?>)</span></span></a></td>
<td class="tab" id="s6"><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=6"><span>成功竞拍记录<span class="px10">(<?php echo $nums['6'];?>)</span></span></a></td>
<?php } ?>
<td class="tab_nav">&nbsp;</td>
<td class="tab" id="type"><a href="javascript:Dwidget('type.php?item=auction', '[<?php echo 专场;?>分类]', 600, 300);"><span><?php echo 专场;?>分类<span class="px10">(<?php echo $nums['0'];?>)</span></span></a></td>
</tr>
</table>
</div>
<?php if($action=='add' || $action=='edit') { ?>
<iframe src="" name="send" id="send" style="display:none;"></iframe>
<form method="post" id="dform" action="<?php echo $DT['file_my'];?>" target="send" onsubmit="return check();">
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="itemid" value="<?php echo $itemid;?>"/>
<input type="hidden" name="forward" value="<?php echo $forward;?>"/>
<table cellpadding="6" cellspacing="1" class="tb">
<?php if($status==1 && $action=='edit' && $note) { ?>
<tr>
<td class="tl">未通过原因</td>
<td class="tr f_blue"><?php echo $note;?></td>
</tr>
<?php } ?>
<tr>
<td class="tl"><span class="f_red">*</span> 所属分类</td>
<td class="tr"><?php echo category_select('post[catid]', '选择分类', $catid, $moduleid);?> <span id="dcatid" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> <?php echo $MOD['name'];?>标题</td>
<td class="tr f_gray"><input name="post[title]" type="text" id="title" size="50" value="<?php echo $title;?>"/><span id="dtitle" class="f_red"></span></td>
</tr>
<?php if($action=='add' && $could_color) { ?>
<tr>
<td class="tl">标题颜色</td>
<td class="tr">
<?php echo dstyle('color');?>&nbsp;
设置信息标题颜色需消费 <strong class="f_red"><?php echo $MOD['credit_color'];?></strong> <?php echo $DT['credit_name'];?>
</td>
</tr>
<?php } ?>
<!--<tr>
<td class="tl"><span class="f_red">*</span> 标题图片</td>
<td class="tr"><input name="post[thumb]" id="thumb" type="text" size="60" value="<?php echo $thumb;?>" readonly/>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="Dthumb(<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value, true);" class="t">[上传]</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="_preview(Dd('thumb').value);" class="t">[预览]</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="Dd('thumb').value='';" class="t">[删除]</a></td>
</tr>-->
<tr>
<td class="tl"><span class="f_red">*</span> 组图</td>
<td>
<input type="text" name="post[thumb]" id="thumb" value="<?php echo $thumb;?>" style=" height:0px; border:none"/>
<input type="hidden" name="post[thumb1]" id="thumb1" value="<?php echo $thumb1;?>"/>
<input type="hidden" name="post[thumb2]" id="thumb2" value="<?php echo $thumb2;?>"/>
<input type="hidden" name="post[thumb3]" id="thumb3" value="<?php echo $thumb3;?>"/>
<input type="hidden" name="post[thumb4]" id="thumb4" value="<?php echo $thumb4;?>"/>
<input type="hidden" name="post[thumb5]" id="thumb5" value="<?php echo $thumb5;?>"/>
<input type="hidden" name="post[thumb6]" id="thumb6" value="<?php echo $thumb6;?>"/>
<input type="hidden" name="post[thumb7]" id="thumb7" value="<?php echo $thumb7;?>"/>
<table width="360">
<tr align="center" height="120" class="c_p">
<td width="120"><img src="<?php echo $thumb ? $thumb : DT_SKIN.'image/waitpic.gif';?>" width="100" height="100" id="showthumb" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb').src, 1);}else{Dalbum('',<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value, true);}"/></td>

<td width="120"><img src="<?php echo $thumb1 ? $thumb1 : DT_SKIN.'image/waitpic.gif';?>" width="100" height="100" id="showthumb1" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb1').src, 1);}else{Dalbum(1,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb1').value, true);}"/></td>
<td width="120"><img src="<?php echo $thumb2 ? $thumb2 : DT_SKIN.'image/waitpic.gif';?>" width="100" height="100" id="showthumb2" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb2').src, 1);}else{Dalbum(2,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb2').value, true);}"/></td>
<td width="120"><img src="<?php echo $thumb3 ? $thumb3 : DT_SKIN.'image/waitpic.gif';?>" width="100" height="100" id="showthumb3" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb3').src, 1);}else{Dalbum(3,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb3').value, true);}"/></td>

<td width="120"><img src="<?php echo $thumb4 ? $thumb4 : DT_SKIN.'image/waitpic.gif';?>" width="100" height="100" id="showthumb4" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb4').src, 1);}else{Dalbum(4,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb4').value, true);}"/></td>
<td width="120"><img src="<?php echo $thumb5 ? $thumb5 : DT_SKIN.'image/waitpic.gif';?>" width="100" height="100" id="showthumb5" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb5').src, 1);}else{Dalbum(5,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb5').value, true);}"/></td>
<td width="120"><img src="<?php echo $thumb6 ? $thumb6 : DT_SKIN.'image/waitpic.gif';?>" width="100" height="100" id="showthumb6" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb6').src, 1);}else{Dalbum(6,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb6').value, true);}"/></td>
<td width="120"><img src="<?php echo $thumb7 ? $thumb7 : DT_SKIN.'image/waitpic.gif';?>" width="100" height="100" id="showthumb7" title="预览图片" alt="" onclick="if(this.src.indexOf('waitpic.gif') == -1){_preview(Dd('showthumb7').src, 1);}else{Dalbum(7,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb7').value, true);}"/></td>
</tr>
<tr align="center" class="c_p">
<td><span onclick="Dalbum('',<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb').value, true);" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum('');"/>&nbsp;&nbsp;<span onclick="delAlbum('', 'wait');" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>

<td><span onclick="Dalbum(1,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb1').value, true);" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum(1);"/>&nbsp;&nbsp;<span onclick="delAlbum(1, 'wait');" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
<td><span onclick="Dalbum(2,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb2').value, true);" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum(2);"/>&nbsp;&nbsp;<span onclick="delAlbum(2, 'wait');" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
<td><span onclick="Dalbum(3,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb3').value, true);" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum(3);"/>&nbsp;&nbsp;<span onclick="delAlbum(3, 'wait');" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>

<td><span onclick="Dalbum(4,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb4').value, true);" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum(4);"/>&nbsp;&nbsp;<span onclick="delAlbum(4, 'wait');" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
<td><span onclick="Dalbum(5,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb5').value, true);" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum(5);"/>&nbsp;&nbsp;<span onclick="delAlbum(5, 'wait');" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
<td><span onclick="Dalbum(6,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb6').value, true);" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum(6);"/>&nbsp;&nbsp;<span onclick="delAlbum(6, 'wait');" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
<td><span onclick="Dalbum(7,<?php echo $moduleid;?>,<?php echo $MOD['thumb_width'];?>,<?php echo $MOD['thumb_height'];?>, Dd('thumb7').value, true);" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_upload.gif" width="12" height="12" title="上传"/></span>&nbsp;&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/img_select.gif" width="12" height="12" title="选择" onclick="selAlbum(7);"/>&nbsp;&nbsp;<span onclick="delAlbum(7, 'wait');" class="jt"><img src="<?php echo $MODULE['2']['linkurl'];?>image/img_delete.gif" width="12" height="12" title="删除"/></span></td>
</tr>
</table>
<span id="dthumb" class="f_red"></span>
</td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 起拍价</td>
<td class="tr"><input name="post[price]" type="text" size="10" value="<?php echo $price;?>" id="price"/><span id="dprice" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red"> </span> 一口价</td>
<td class="tr"><input name="post[marketprice]" type="text" size="10" value="<?php echo $marketprice;?>" id="marketprice"/><span id="dmarketprice" class="f_red"></span></td>
</tr>
<tr>
<td class="tl"><span class="f_red">*</span> 加价幅度</td>
<td class="tr"><input name="post[minamount]" type="text" size="10" value="<?php echo $minamount;?>" id="minamount"/><span id="dminamount" class="f_red"></span></td>
</tr>
<!--<tr>
<td class="tl"><span class="f_red">*</span> 保证金</td>
<td class="tr"><input name="post_fields[margins]" type="text" size="10" value="<?php echo $margins;?>" id="margins"/><span id="dmargins" class="f_red"></span></td>
</tr>-->
<!-- <tr>
<td class="tl">最多人数</td>
<td class="tr"><input name="post[amount]" type="text" size="10" value="<?php echo $amount;?>" id="damount"/><span id="damount" class="f_red"></span></td>
</tr> -->
<tr>
<td class="tl"><span class="f_red">*</span> 竞拍时间</td>
<td class="tr"><!--<? if($_GET['action']=='add'){?><?php echo dcalendar('post[fromtime]', date('Y-m-d', time()));?> 至 <?php echo dcalendar('post[totime]', date('Y-m-d', time()+259200));?><? }else{?><?php echo dcalendar('post[fromtime]', date('Y-m-d', $fromtime));?> 至 <?php echo dcalendar('post[totime]', $totime);?><? }?>--> <input class="Wdate" name="post[fromtime]" id="postfromtime" value="<?php echo date('Y-m-d H:i:s', $fromtime);?>" type="text" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',autoPickDate:true})"> 至 <input class="Wdate" name="post[totime]" id="posttotime" value="<?php echo $totime;?>" type="text" onClick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss',autoPickDate:true})"><span id="dpostfromtime" class="f_red"></span><span id="dposttotime" class="f_red"></span></td>
</tr>
<?php if($CP) { ?>
<script type="text/javascript">
var property_catid = <?php echo $catid;?>;
var property_itemid = <?php echo $itemid;?>;
var property_admin = 0;
</script>
<script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/property.js"></script>
<?php if($itemid) { ?><script type="text/javascript">setTimeout("load_property()", 1000);</script><?php } ?>
<tbody id="load_property" style="display:none;">
<tr><td></td><td></td></tr>
</tbody>
<?php } ?>
<?php if($FD) { ?><?php echo fields_html('<td class="tl">', '<td class="tr">', $item);?><?php } ?>
<tr style="display:none">
<td class="tl"><?php echo $MOD['name'];?>简介</td>
<td class="tr"><textarea name="post[introduce]" style="width:90%;height:45px;"><?php echo $introduce;?></textarea></td>
</tr>
<tr>
<td class="tl">详细说明</td>
<td class="tr f_gray"><textarea name="post[content]" id="content" class="dsn"><?php echo $content;?></textarea>
<?php echo deditor($moduleid, 'content', $group_editor, '98%', 350);?><span id="dcontent" class="f_red"></span>
</td>
</tr>
<?php if($MOD['swfu'] == 1) { ?>
<?php include DT_ROOT.'/api/swfupload/editor.inc.php';?>
<?php } ?>
<tr>
<td class="tl">需要物流</td>
<td class="tr">
<? if($logistic==''){?>
<input type="radio" name="post[logistic]" value="1" checked id="logistic_1"/><label for="logistic_1"> 是</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="post[logistic]" value="0"  id="logistic_0"/><label for="logistic_0"> 否</label>
<? }else{ ?>
<input type="radio" name="post[logistic]" value="1"<?php if($logistic) { ?> checked<?php } ?>
 id="logistic_1"/><label for="logistic_1"> 是</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="post[logistic]" value="0"<?php if(!$logistic) { ?> checked<?php } ?>
 id="logistic_0"/><label for="logistic_0"> 否</label>
<? } ?>
</td>
</tr>
<tr<?php if(!$_userid) { ?> style="display:none;"<?php } ?>
 style=" display:">
<td class="tl">选择专场</td>
<td class="tr"><?php echo $mycatid_select;?>&nbsp; <input type="text" name="zhuanchang" id="zhuanchang88"><input type="button" id="butzc" class="btn" value="设置专场">&nbsp;&nbsp;<div id="zctishi"></div><!--<a href="javascript:Dwidget('type.php?item=auction', '[<?php echo 专场;?>分类]', 600, 300);" class="t">[管理专场]</a>--></td>
<td class="tr"></td>
</tr>
<?php if($fee_add) { ?>
<tr>
<td class="tl">发布此信息需消费</td>
<td class="tr"><span class="f_b f_red"><?php echo $fee_add;?></span> <?php echo $fee_unit;?></td>
</tr>
<?php if($fee_currency == 'money') { ?>
<tr>
<td class="tl"><?php echo $DT['money_name'];?>余额</td>
<td class="tr"><span class="f_blue f_b"><?php echo $_money;?><?php echo $fee_unit;?></span> <a href="charge.php?action=pay" target="_blank" class="t">[充值]</a></td>
</tr>
<?php } else { ?>
<tr>
<td class="tl"><?php echo $DT['credit_name'];?>余额</td>
<td class="tr"><span class="f_blue f_b"><?php echo $_credit;?><?php echo $fee_unit;?></span> <a href="credit.php?action=buy" target="_blank" class="t">[购买]</a></td>
</tr>
<?php } ?>
<?php } ?>
<?php if($need_password) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 支付密码</td>
<td class="tr"><?php include template('password', 'chip');?> <span id="dpassword" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($need_question) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 验证问题</td>
<td class="tr"><?php include template('question', 'chip');?> <span id="danswer" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($need_captcha) { ?>
<tr>
<td class="tl"><span class="f_red">*</span> 验证码</td>
<td class="tr"><?php include template('captcha', 'chip');?> <span id="dcaptcha" class="f_red"></span></td>
</tr>
<?php } ?>
<?php if($action=='add') { ?>
<tr style="display:none;" id="weibo_sync">
<td class="tl">同步主题</td>
<td class="tr" id="weibo_show"></td>
</tr>
<?php } ?>
<tr>
<td class="tl">&nbsp;</td>
<td class="tr" height="50"><input type="submit" name="submit" value=" 提 交 " class="btn"/>&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value=" 返 回 " class="btn" onclick="history.back(-1);"/></td>
</tr>
</table>
</form>
<?php echo load('guest.js');?>
<?php echo load('clear.js');?>
<?php if($action=='add') { ?>
<script type="text/javascript">s('mid_<?php echo $mid;?>');m('<?php echo $action;?>');</script>
<?php } else { ?>
<script type="text/javascript">s('mid_<?php echo $mid;?>');m('s<?php echo $status;?>');</script>
<?php } ?>
<?php } else { ?>
<form action="<?php echo $DT['file_my'];?>">
<div class="tt">
<input type="hidden" name="mid" value="<?php echo $mid;?>"/>
<input type="hidden" name="status" value="<?php echo $status;?>"/>
&nbsp;<?php echo category_select('catid', '行业分类', $catid, $moduleid);?>&nbsp;
<input type="text" size="30" name="kw" value="<?php echo $kw;?>" title="关键词"/>&nbsp;
<select name="process">
<option value="-1">状态</option>
<option value="0"<?php if(($process == 0 && $process == 1) ) { ?> selected<?php } ?>
>竞拍中</option>
<!-- <option value="1"<?php if($process == 1) { ?> selected<?php } ?>
>团购中</option> -->
<option value="2"<?php if($process == 2) { ?> selected<?php } ?>
>已结束</option>
</select>&nbsp;
<!-- <?php echo $order_select;?>&nbsp; -->
<input type="submit" value=" 搜 索 " class="btn"/>
<input type="button" value=" 重 置 " class="btn" onclick="Go('<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&status=<?php echo $status;?>');"/>
</form>
</div>
<div class="ls">
<form method="post">
<table cellpadding="0" cellspacing="0" class="tb">
<tr>
<th width="20"><input type="checkbox" onclick="checkall(this.form);"/></th>
<th>图片</th>
<th>标题</th>
<th>分类</th>
<th>起拍价</th>
<th>加价幅度</th>
<th>竞拍人数</th>
<th>秒杀价</th>
<th>人气123</th>
<th width="100">管理</th>
</tr>
<?php if(is_array($lists)) { foreach($lists as $k => $v) { ?>
<tr onmouseover="this.className='on';" onmouseout="this.className='';" align="center">
<td><input type="checkbox" name="itemid[]" value="<?php echo $v['itemid'];?>"/></td>
<td><a href="javascript:_preview('<?php echo $v['thumb'];?>');"><img src="<?php if($v['thumb']) { ?><?php echo $v['thumb'];?><?php } else { ?><?php echo DT_SKIN;?>image/nopic50.gif<?php } ?>
" width="50" class="thumb"/></a></td>
<td align="left" title="<?php echo $v['alt'];?>"><ul><li><?php if($v['status']==3) { ?><a href="<?php echo $v['linkurl'];?>" target="_blank" class="t"><?php } else { ?><a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&action=edit&itemid=<?php echo $v['itemid'];?>" class="t"><?php } ?>
<?php echo $v['title'];?></a><?php if($v['status']==1 && $v['note']) { ?> <a href="javascript:" onclick="alert('<?php echo $v['note'];?>');"><img src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/why.gif" title="未通过原因"/></a><?php } ?>
</li><li title="更新时间 <?php echo timetodate($v['edittime'], 5);?> 添加时间 <?php echo timetodate($v['addtime'], 5);?>" class="px11 f_gray"><?php if($timetype=='add') { ?><?php echo timetodate($v['addtime'], 5);?><?php } else { ?><?php echo timetodate($v['edittime'], 5);?><?php } ?>
 <?php echo $_process[$v['process']];?></li></ul></td>
<td><a href="<?php echo $v['caturl'];?>" target="_blank"><?php echo $v['catname'];?></a></td>
<td class="f_price"><?php echo $v['price'];?></td>
<td class="f_price"><?php echo $v['minamount'];?>.00</td>
<td class="px11<?php if($v['orders']>0) { ?> f_blue f_b c_p" title="查看订单" onclick="Go('auction.php?gid=<?php echo $v['itemid'];?>');<?php } ?>
"><?php echo $v['orders'];?></td>
<td class="f_price"> <?php if($v['marketprice']>999999){echo "无";}else{ ?><?php echo $v['marketprice'];?><?php } ?></td>
<td class="px11"><?php echo $v['hits'];?></td>
<td>
<a href="auction.php?gid=<?php echo $v['itemid'];?>"><img width="16" height="16" src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/order.gif" title="订单管理" alt=""/></a>
<a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&action=edit&itemid=<?php echo $v['itemid'];?>"><img width="16" height="16" src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/edit.png" title="修改" alt=""/></a>
<?php if($MG['copy']) { ?>&nbsp;<a href="<?php echo $DT['file_my'];?>?mid=<?php echo $mid;?>&action=add&itemid=<?php echo $v['itemid'];?>&catid=<?php echo $v['catid'];?>"><img width="16" height="16" src="<?php echo DT_STATIC;?><?php echo $MODULE['2']['moduledir'];?>/image/new.png" title="复制信息" alt=""/></a><?php } ?>
<?php if($MG['delete']) { ?>&nbsp;<?php } ?>
</td>
</tr>
<?php } } ?>
</table>
</div>
<?php if($MG['delete'] || $timetype!='add') { ?>
<div class="btns">
<?php if($MG['delete']) { ?>
<span class="f_r"><input type="submit" value=" 删除选中 " class="btn" onclick="if(confirm('确定要删除选中<?php echo $MOD['name'];?>吗？')){this.form.action='?mid=<?php echo $mid;?>&status=<?php echo $status;?>&action=delete'}else{return false;}"/></span>
<?php } ?>
<?php if($timetype!='add') { ?>
<input type="submit" value=" 刷新选中 " class="btn" onclick="this.form.action='?mid=<?php echo $mid;?>&status=<?php echo $status;?>&action=refresh';"/>
<?php if($MOD['credit_refresh']) { ?>
刷新一条信息一次需消费 <strong class="f_red"><?php echo $MOD['credit_refresh'];?></strong> <?php echo $DT['credit_name'];?>，当<?php echo $DT['credit_name'];?>不足时将不可刷新
<?php } ?>
<?php } ?>
&nbsp;
</div>
<?php } ?>
</form>
<?php if($MG['group_limit'] || (!$MG['fee_mode'] && $MOD['fee_add'])) { ?>
<div class="limit">
<?php if($MG['group_limit']) { ?>
总共可发 <span class="f_b f_red"><?php echo $MG['group_limit'];?></span> 条&nbsp;&nbsp;&nbsp;
当前已发 <span class="f_b"><?php echo $limit_used;?></span> 条&nbsp;&nbsp;&nbsp;
还可以发 <span class="f_b f_blue"><?php echo $limit_free;?></span> 条&nbsp;&nbsp;&nbsp;
<?php } ?>
<?php if(!$MG['fee_mode'] && $MOD['fee_add']) { ?>
发布信息收费 <span class="f_b f_red"><?php echo $MOD['fee_add'];?></span> <?php if($MOD['fee_currency'] == 'money') { ?><?php echo $DT['money_unit'];?><?php } else { ?><?php echo $DT['credit_unit'];?><?php } ?>
/条&nbsp;&nbsp;&nbsp;
可免费发布 <span class="f_b"><?php if($MG['group_free_limit']<0) { ?>无限<?php } else { ?><?php echo $MG['group_free_limit'];?><?php } ?>
</span> 条&nbsp;&nbsp;&nbsp;
<?php } ?>
</div>
<?php } ?>
<div class="pages"><?php echo $pages;?></div>
<script type="text/javascript">s('mid_<?php echo $mid;?>');m('s<?php echo $status;?>');</script>
<?php } ?>
<?php if($action == 'add' || $action == 'edit') { ?>
<script type="text/javascript">
function _p() {
if(Dd('tag').value) {
Ds('reccate');
}
}
function check() {
var l;
var f;
f = 'catid_1';
if(Dd(f).value == 0) {
Dmsg('请选择所属分类', 'catid', 1);
return false;
}
f = 'title';
l = Dd(f).value.length;
if(l < 2) {
Dmsg('标题最少2字，当前已输入'+l+'字', f);
return false;
}
f = 'thumb';
l = Dd(f).value.length;
if(l < 15) {
Dmsg('请上传标题图片', f);
alert ('请上传标题图片', f);
return false;
}
f = 'price';
l = Dd(f).value;
if(l < 0.1) {
Dmsg('请填写起拍价', f);
return false;
}
f = 'marketprice';
l = Dd(f).value;
/*if(l < 0.1) {
Dmsg('请填写一口价', f);
return false;
}*/
<? if($auction_price){?>
if(l <= <?=$auction_price?> && l != '') {
Dmsg('一口价必须大于现拍价', f);
return false;
}
<? }else{?>
if(l <= Dd('price').value && l != '') {
Dmsg('一口价必须大于起拍价', f);
return false;
}
<? }?>

f = 'minamount';
l = Dd(f).value;
if(l < 0.1) {
Dmsg('请填写加价幅度', f);
return false;
}

f = 'postfromtime';
l = Dd(f).value;
if(l < 0.1) {
alert ('请填写起始时间', f);
Dmsg('请填写起始时间', f);
$("#postfromtime").focus();
return false;
$("#postfromtime").focus();
}

f = 'posttotime';
l = Dd(f).value;
if(l < 0.1) {
alert ('请填写截至时间', f);
Dmsg('请填写截至时间', f);
return false;
}

f = 'yunfei';
l = Dd(f).value;
if(l =='') {
Dmsg('请选择运费', f);
return false;
}

f = 'username';
l = Dd(f).value.length;
if(l < 2) {
Dmsg('请填写会员名', f);
return false;
}
<?php if($FD) { ?><?php echo fields_js();?><?php } ?>
if(Dd('property_require') != null) {
var ptrs = Dd('property_require').getElementsByTagName('option');
for(var i = 0; i < ptrs.length; i++) {
f = 'property-'+ptrs[i].value;
if(Dd(f).value == 0 || Dd(f).value == '') {
Dmsg('请填写或选择'+ptrs[i].innerHTML, f);
return false;
}
}
}
<?php if($need_password) { ?>
f = 'password';
l = Dd(f).value.length;
if(l < 6) {
Dmsg('请填写支付密码', f);
return false;
}
<?php } ?>
<?php if($need_question) { ?>
f = 'answer';
l = Dd(f).value.length;
if(l < 1) {
Dmsg('请填写验证问题', f);
return false;
}
if(Dd('c'+f).innerHTML.indexOf('error') != -1) {
Dd(f).focus();
return false;
}
<?php } ?>
<?php if($need_captcha) { ?>
f = 'captcha';
l = Dd(f).value;
if(!is_captcha(l)) {
Dmsg('请填写正确的验证码', f);
return false;
}
if(Dd('c'+f).innerHTML.indexOf('error') != -1) {
Dd(f).focus();
return false;
}
<?php } ?>
return true;
}
var destoon_oauth = '<?php echo $EXT['oauth'];?>';
</script>
<?php } ?>
<?php if($action=='add' && strlen($EXT['oauth']) > 1) { ?><?php echo load('weibo.js');?><?php } ?>
<?php include template('footer', 'member');?>