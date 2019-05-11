<?php
include_once '../libs/SmartyBC.class.php';

include_once '../config/define.php';
include_once '../libs/class/MySQL/class.DBPDO.php';
$smarty = new Smarty;

$smarty->debugging = false;
$smarty->caching = false;
$smarty->cache_lifetime = 120;

/*

 SELECT Count(*)                             AS RECO,
       Date_format(create_time, '%d/%m/%Y') AS RECO_DATE
FROM   aritem_scan_rate
GROUP  BY Date_format(create_time, '%d/%m/%Y')
ORDER  BY Date_format(create_time, '%d/%m/%Y')
*/

$smarty->assign("countReco", current($countReco));

$smarty->display('index.tpl');
