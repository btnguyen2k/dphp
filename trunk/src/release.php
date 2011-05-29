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

function zipDir($dir, $filename) {
    $zip = new ZipArchive();

    if ( $zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE ) {
        error("cannot open <$filename>\n");
    }

    performZipDir($dir, $dir, $zip);

    echo "Number of Files: " . $zip->numFiles . "\n";
    echo "Status:" . $zip->status . "\n";
    $zip->close();
}

function performZipDir($parent, $dir, $zip) {
    if ( !is_dir($dir) ) {
        error("$source is not a directory or does not exists!");
    }

    if ( $source_dh = opendir($dir) ) {
        $isEmpty = true;
        while ( $file = readdir($source_dh) ) {
            //if ( $file != "." && $file != ".." ) {
            if ( $file[0] != "." ) {
                $isEmpty = false;
                $realFile = $dir.DIRECTORY_SEPARATOR.$file;
                $zipEntry = substr($realFile, strlen($parent)+1);
                if ( is_dir($realFile) ) {
                    //echo "Added dir:\t$zipEntry\n";
                    //$zip->addEmptyDir($zipEntry);
                    performZipDir($parent, $realFile, $zip);
                } else {
                    echo "Added file:\t$zipEntry\n";
                    $zip->addFile($realFile, $zipEntry);
                }
            }
        }
        if ( $isEmpty ) {
            $zipEntry = substr($dir, strlen($parent)+1);
            echo "Added dir:\t$zipEntry\n";
            $zip->addEmptyDir($zipEntry);
        }
        closedir($source_dh);
    }
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
$DIR_PACKAGE_RELEASE = $DIR_RELEASE.$PATH_SEPARATOR.$PACKAGE.$PATH_SEPARATOR.'Ddth'.$PATH_SEPARATOR.$PACKAGE;
removeTree($DIR_RELEASE.$PATH_SEPARATOR.$PACKAGE, true);
mkdir($DIR_PACKAGE_RELEASE, 0755, true);
if ( !is_dir($DIR_PACKAGE_RELEASE) ) {
    error("$DIR_PACKAGE_RELEASE is not a directory or does not exists!");
}
copyDir($DIR_PACKAGE_SOURCE, $DIR_PACKAGE_RELEASE);
copyFile("license.txt", $DIR_RELEASE.$PATH_SEPARATOR.$PACKAGE.$PATH_SEPARATOR."license.txt");
copyFile("copyright.txt", $DIR_RELEASE.$PATH_SEPARATOR.$PACKAGE.$PATH_SEPARATOR."copyright.txt");
$CHANGELOG_FILE = $PACKAGE.$PATH_SEPARATOR.$PACKAGE_PHP_VERSION.$PATH_SEPARATOR."ChangeLog.txt";
if ( is_file($CHANGELOG_FILE) ) {
    copyFile($CHANGELOG_FILE, $DIR_RELEASE.$PATH_SEPARATOR.$PACKAGE.$PATH_SEPARATOR."ChangeLog.txt");
}

$includePath = ".";
$includePath .= PATH_SEPARATOR."Commons/php5";
$includePath .= PATH_SEPARATOR."Xpath/php5";
ini_set("include_path", $includePath);

if ( !function_exists('ddthAutoload') ) {
    /**
     * Automatically loads class source file when used.
     *
     * @param string
     * @ignore
     */
    function ddthAutoload($className) {
        require_once 'Ddth/Commons/ClassDefaultClassNameTranslator.php';
        require_once 'Ddth/Commons/ClassLoader.php';
        $translator = Ddth_Commons_DefaultClassNameTranslator::getInstance();
        Ddth_Commons_Loader::loadClass($className, $translator);
    }
}
spl_autoload_register('ddthAutoload');

$xml = Ddth_Commons_Loader::loadFileContent($DIR_PACKAGE_SOURCE.'/package.xml');
$xpath = Ddth_Xpath_XmlParser::getInstance();
$xnode = $xpath->parseXml($xml);
$xnodes = $xnode->xpath("/package/version");
$VERSION = $xnodes[0]->getValue();

$t = date("Ymd");
$ZIPFILE = "$PACKAGE-$PACKAGE_PHP_VERSION-$VERSION-$t.zip";
$ZIPFILE = strtolower($ZIPFILE);
$ZIPFILE = $DIR_RELEASE.$PATH_SEPARATOR.$ZIPFILE;
echo "Zipping package to [$ZIPFILE]...\n";
@unlink($ZIPFILE);
zipDir($DIR_RELEASE.$PATH_SEPARATOR.$PACKAGE, $ZIPFILE);
?>