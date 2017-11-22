<?php
/**
 *
 * @filename  pull.php
 * @author    Zhenxun Du <5552123@qq.com>
 * @date      2017/9/17 22:03
 */

$output = shell_exec("cd /data/wwwroot/gc.91shiwan.com;git pull  origin master 2>&1");
print_r($output);
file_put_contents('git.log',"\n".date('Y-m-d H:i:s').' '.$output,FILE_APPEND);