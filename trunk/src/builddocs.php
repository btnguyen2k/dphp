<?php
/* Use phpDocumentor to build docs for php projects */
if ( count($argv) != 5 ) {
    echo "Usage:\n";
    echo "\tphp builddocs.php <full_path_to_php_executable> <path_to_phpDocumentor> <package> <package_php_version>";
    echo "\n";
    echo "Example:\n";
    echo "\tphp builddocs.php /usr/bin/php /usr/phpDocumentor Commons php5";
    echo "\n";
    exit;
}

function error($str) {
    echo "Error: $str\n";
    echo "\n";
    exit;
}

function removeTree($dir, $removeCurrent = false) {
    if ( $dir_handle = opendir($dir) ) {
        while ( $file = readdir($dir_handle) ) {
            if ( $file != "." && $file != ".." ) {
                if ( is_dir($dir."/".$file) ) {
                    removeTree($dir."/".$file, true);
                } else {
                    unlink($dir."/".$file);
                }
            }
        }
        closedir($dir_handle);
        if ( $removeCurrent ) {
            rmdir($dir);
        }
        return true;
    } else {
        return false;
    }
}

$PATH_SEPARATOR = isset($_SERVER["OS"]) && strpos($_SERVER["OS"], 'Win')>-1 ? '\\' : '/';

$PHP = $argv[1];
if ( !is_executable($PHP) ) {
    error("$PHP is not an executable file!");
}

$PHP_DOCUMENTOR = $argv[2].$PATH_SEPARATOR.'phpDocumentor'.$PATH_SEPARATOR.'phpdoc.inc';
if ( !is_readable($PHP_DOCUMENTOR) ) {
    error("$PHP_DOCUMENTOR is not readable!");
}

$PACKAGE = $argv[3];
$PACKAGE_PHP_VERSION = $argv[4];
$DIR_PACKAGE_SOURCE = $PACKAGE.$PATH_SEPARATOR.$PACKAGE_PHP_VERSION.$PATH_SEPARATOR.'Ddth'.$PATH_SEPARATOR.$PACKAGE;
#$DIR_PACKAGE_SOURCE = $PACKAGE.$PATH_SEPARATOR.$PACKAGE_PHP_VERSION;
if ( !is_dir($DIR_PACKAGE_SOURCE) ) {
    error("$DIR_PACKAGE_SOURCE is not a directory or does not exists!");
}
$DIR_PACKAGE_DOCS = $PACKAGE.$PATH_SEPARATOR.$PACKAGE_PHP_VERSION.$PATH_SEPARATOR.'phpDocs';
if ( !is_dir($DIR_PACKAGE_DOCS) ) {
    error("$DIR_PACKAGE_DOCS is not a directory or does not exists!");
}
removeTree($DIR_PACKAGE_DOCS);

$STYLE = "HTML:SMARTY:PHP";
$STYLE = "HTML:SMARTY:default";
$STYLE = "HTML:SMARTY:HandS";

$CMD = "$PHP \"$PHP_DOCUMENTOR\" -t \"$DIR_PACKAGE_DOCS\" -o $STYLE -d \"$DIR_PACKAGE_SOURCE\" -ti \"$PACKAGE Documentation\"";
system($CMD);
?>