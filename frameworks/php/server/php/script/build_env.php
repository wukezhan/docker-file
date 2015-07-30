<?php
/**
 * 
 * @author wukezhan<wukezhan@gmail.com>
 * 2014-11-02 12:01
 * 
 */
$conf = '/server/conf/php-env.conf';
if(!file_exists($conf)){
    $ignores = array(
        'LESSOPEN' => 1,
        'SHLVL' => 1,
        'LS_COLORS' => 1,
        'PWD' => 1,
        'OLDPWD' => 1,
        'DEBIAN_FRONTEND' => 1,
        'LESSCLOSE' => 1,
        'PATH' => 1,
        'TERM' => 1,
        '_' => 1,
    );
    ob_start();
    system('env', $env);
    $env = trim(ob_get_contents());
    ob_end_clean();
    $env = explode("\n", $env);
    $content = array('[default]');
    foreach($env as $line){
        $line = explode("=", $line, 2);
        if(!isset($ignores[$line[0]])){
            $content[$line[0]] = "env[{$line[0]}] = \${$line[0]}";
            $ignores[$line[0]] = 1;
        }
    }
    $content = implode("\n", $content);
    usleep(1000*20);
    file_put_contents($conf, $content);
}