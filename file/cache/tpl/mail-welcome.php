<?php defined('IN_DESTOON') or exit('Access Denied');?><table cellpadding="0" cellspacing="0" width="700" align="center" style="font-family:Verdana,Arial;">
<tr>
<td style="background:#62B81B;line-height:30px;font-size:14px;font-weight:bold;color:#FFFFFF;">&nbsp;&nbsp;<?php echo $title;?></td>
</tr>
<tr>
<td style="border:#CCCCCC 1px solid;padding:20px 20px 20px 20px;line-height:180%;font-size:13px;">
<strong>尊敬的<?php echo $username;?></strong>：<br/>
您好！<br/>
欢迎您加入<?php echo $DT['sitename'];?>，您的会员帐号为：<br/>
<strong>户名：</strong><?php echo $username;?><br/>
<strong>密码：</strong><?php if(isset($post['password'])) { ?><?php echo $post['password'];?> 请您妥善保存，勿告诉他人。<?php } else { ?><i>已加密</i> (如果您忘记了密码，<a href="<?php echo linkurl($MODULE['2']['linkurl'], 1);?>send.php" target="_blank">请点这里找回</a>)<?php } ?>
<br/>
本站网址：<a href="<?php echo DT_PATH;?>" target="_blank"><?php echo DT_PATH;?></a><br/>
</td>
</tr>
<tr>
<td style="background:#333333;padding:10px;line-height:180%;font-size:12px;color:#FFFFFF;">请注意：此邮件系 <a href="<?php echo DT_PATH;?>" target="_blank" style="color:#FFFFFF;"><?php echo $DT['sitename'];?></a> 自动发送，请勿直接回复。<br/>如果此邮件不是您请求的，请忽略并删除！</td>
</tr>
</table>