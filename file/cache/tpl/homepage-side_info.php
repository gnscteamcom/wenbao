<?php defined('IN_DESTOON') or exit('Access Denied');?><?php 
$COM['user']['regtime'] = date('Y-m-d',$COM['user']['regtime']);
$COM['user']['logintime'] = date('Y-m-d',$COM['user']['logintime']);
 ?>
<div class="side_head"><div><strong>第三方信息</strong></div></div>
<div class="side_body">
<ul>
<li>名称：<?php echo $COM['company'];?></li>
<li>
资料认证：
<!--
<?php if($COM['vcompany']) { ?>&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/v_company.gif" width="16" height="16" align="absmiddle" title="资料通过工商认证"/><?php } ?>
-->
<?php if($COM['vtruename']) { ?>&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/v_truename.gif" width="16" height="16" align="absmiddle" title="资料通过实名认证"/><?php } ?>
<?php if($COM['vbank']) { ?>&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/v_bank.gif" width="16" height="16" align="absmiddle" title="资料通过银行帐号认证"/><?php } ?>
<?php if($COM['vmobile']) { ?>&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/v_mobile.gif" width="16" height="16" align="absmiddle" title="资料通过手机认证"/><?php } ?>
<?php if($COM['vemail']) { ?>&nbsp;<img src="<?php echo $MODULE['2']['linkurl'];?>image/v_email.gif" width="16" height="16" align="absmiddle" title="资料通过邮件认证"/><?php } ?>
<?php if($COM['validated']) { ?>&nbsp;<img src="<?php echo DT_SKIN;?>image/check_right.gif" align="absmiddle"/> 企业资料通过<?php echo $COM['validator'];?>认证<?php } ?>

</li>
<li>信誉：<span style="color:red;"><?php echo $COM['user']['credit'];?></span></li>
<li>地区：<?php echo area_pos($COM['user']['areaid'], ' '); ?></li>
<?php if($COM['truename']) { ?><li>联系人：<?php echo $COM['truename'];?></li><?php } ?>
<!--
<?php if($COM['type']) { ?><li>类型：<?php echo $COM['type'];?></li><?php } ?>

<?php if($COM['regyear']) { ?><li title="<?php echo $COM['regyear'];?>">注册年份：<?php echo $COM['regyear'];?></li><?php } ?>
<?php if($COM['user']['regtime']) { ?><li title="<?php echo $COM['user']['regtime'];?>">加入文宝时间：<?php echo $COM['user']['regtime'];?></li><?php } ?>
-->
<?php if($COM['user']['logintime']) { ?><li title="<?php echo $COM['user']['logintime'];?>">最后登陆时间：<?php echo $COM['user']['logintime'];?></li><?php } ?>
</ul>
</div>