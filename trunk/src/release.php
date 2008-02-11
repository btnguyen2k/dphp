<?php
/* Create a release version of package(s) */
if ( count($argv) != 3 ) {
    echo "Usage:\n";
    echo "\tphp release.php <package> <package_php_version>";
    echo "\n";
    echo "Example:\n";
    echo "\tphp release.php Commons php5";
    echo "\n";
    exit;
}

function error($str) {
    echo "Error: $str\n";
    echo "\n";
    exit;
}

function removeTree($dir, $removeCurrent = false) {
    if ( !is_dir($dir) ) {
        return;
    }
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

function copyDir($source, $dest) {
    if ( !is_dir($source) ) {
        error("$source is not a directory or does not exists!");
    }
    if ( !is_dir($dest) ) {
        error("$dest is not a directory or does not exists!");
    }

    if ( $source_dh = opendir($source) ) {
        while ( $file = readdir($source_dh) ) {
            //if ( $file != "." && $file != ".." ) {
            if ( $file[0] != "." ) {
                if ( is_dir($source."/".$file) ) {
                    echo "Copying directory $source/$file...\n";
                    mkdir($dest."/".$file);
                    copyDir($source."/".$file, $dest."/".$file);
                } else {
                    copyFile($source."/".$file, $dest."/".$file);
                }
            }
        }
        closedir($source_dh);
    }
}

function copyFile($source, $dest) {
    echo "Copying file $source...\n";
    copy($source, $dest);
}

$DIR_RELEASE = "release";
if ( !is_dir($DIR_RELEASE) ) {
    mkdir($DIR_RELEASE);
}
if ( !is_dir($DIR_RELEASE) ) {
    error("$DIR_RELEASE is not a directory or does not exists!");
}

$PATH_SEPARATOR = isset($_SERVER["OS"]) && strpos($_SERVER["OS"], 'Win')>-1 ? '\\' : '/';

$PACKAGE = $argv[1];
$PACKAGE_PHP_VERSION = $argv[2];
$DIR_PACKAGE_SOURCE = $PACKAGE.$PATH_SEPARATOR.$PACKAGE_PHP_VERSION.$PATH_SEPARATOR.'Ddth'.$PATH_SEPARATOR.$PACKAGE;
if ( !is_dir($DIR_PACKAGE_SOURCE) ) {
    error("$DIR_PACKAGE_SOURCE is not a directory or does not exists!");
}
$DIR_PACKAGE_RELEASE = $DIR_RELEASE.$PATH_SEPARATOR.$PACKAGE.$PATH_SEPARATOR.$PACKAGE_PHP_VERSION.$PATH_SEPARATOR.'Ddth'.$PATH_SEPARATOR.$PACKAGE;
removeTree($DIR_PACKAGE_RELEASE, true);
mkdir($DIR_PACKAGE_RELEASE, 0755, true);
if ( !is_dir($DIR_PACKAGE_RELEASE) ) {
    error("$DIR_PACKAGE_RELEASE is not a directory or does not exists!");
}

copyDir($DIR_PACKAGE_SOURCE, $DIR_PACKAGE_RELEASE);
?>