<?php defined('IN_DESTOON') or exit('Access Denied');?></td>
<?php if($side_pos==1) { ?>
<td width="10" id="split"></td>
<td width="<?php echo $side_width;?>" valign="top" id="side"><?php include template('side', $template);?></td>
<?php } ?>
</tr>
</table>
</div>
<div class="m">
<div class="foot" id="foot">
<div>
&copy;<?php echo timetodate($DT_TIME, 'Y');?> <?php echo $COM['company'];?> 版权所有&nbsp;&nbsp;
技术支持：<a href="<?php echo DT_PATH;?>" target="_blank"><?php echo $DT['sitename'];?></a>&nbsp;&nbsp;
<?php if($show_stats) { ?>访问量:<?php echo $COM['hits'];?>&nbsp;&nbsp;<?php } ?>

<a href="<?php echo $COM['linkurl'];?>">网站首页</a>&nbsp;&nbsp;
<a href="<?php echo $MODULE['2']['linkurl'];?>">管理入口</a>&nbsp;&nbsp;
<?php if($api_stats && $stats) { ?>
<?php include DT_ROOT.'/api/stats/'.$api_stats.'/show.inc.php';?>
<?php } ?>
<?php if($COM['icp']) { ?><br/><a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $COM['icp'];?></a><?php } ?>
</div>
</div>
</div>
<script type="text/javascript">Dd('position').innerHTML = Dd('pos_show').innerHTML;</script>
<?php if($album_js) { ?><script type="text/javascript" src="<?php echo DT_STATIC;?>file/script/album.js"></script><?php } ?>
<?php if($api_kf && $kf) { ?>
<?php include DT_ROOT.'/api/kf/'.$api_kf.'/show.inc.php';?>
<?php } ?>
</body>
</html>