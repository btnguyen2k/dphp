<?php
/* Use phpDocumentor to build docs for php projects */
if ( count($argv) != 5 && count($argv) != 6 ) {
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
    if ( ($dir_handle = opendir($dir)) ) {
        while ( ($file = readdir($dir_handle)) ) {
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
@mkdir($DIR_PACKAGE_DOCS);
if ( !is_dir($DIR_PACKAGE_DOCS) ) {
    error("$DIR_PACKAGE_DOCS is not a directory or does not exists!");
}
removeTree($DIR_PACKAGE_DOCS);

/*
 * Some styles:
 * - HTML:frames:* - output is HTML with frames.
 *   + HTML:frames:default - JavaDoc-like template, very plain, minimal formatting
 *   + HTML:frames:earthli - BEAUTIFUL template written by Marco von Ballmoos
 *   + HTML:frames:l0l33t - Stylish template
 *   + HTML:frames:phpdoc.de - Similar to phpdoc.de's PHPDoc output
 *   + HTML:frames:phphtmllib - Very nice user-contributed template
 *   all of the templates listed above are also available with javascripted expandable
 *   indexes, as HTML:frames:DOM/name where name is default, l0l33t, phpdoc.de, etcetera
 *   + HTML:frames:phpedit - Based on output from PHPEdit Help Generator
 * - HTML:Smarty:* - output is HTML with no frames.
 *   + HTML:Smarty:default - Bold template design using css to control layout
 *   + HTML:Smarty:HandS - Layout is based on PHP, but more refined, with logo image
 *   + HTML:Smarty:PHP - Layout is identical to the PHP website
 * - CHM:default:* - output is CHM, compiled help file format (Windows help).
 *   + CHM:default:default - Windows help file, based on HTML:frames:l0l33t
 * - PDF:default:* - output is PDF, Adobe Acrobat format.
 *   + PDF:default:default - standard, plain PDF formatting
 * - XML:DocBook:* - output is XML, in DocBook format
 *   + XML:DocBook/peardoc2:default - documentation ready for compiling into peardoc
 *     for online pear.php.net documentation, 2nd revision
 */
$STYLE = "";
if ( count($argv) == 6 ) {
    $STYLE = "-o \"$argv[5]\"";
} else {
    //default stype
    $STYLE = "-o \"HTML:Smarty:HandS\"";
    //$STYLE = "-o \"HTML:frames/Extjs:default\"";
    //$STYLE = "-o \"HTML:Smarty/Evolve:default\"";
}
$CMD = "$PHP \"$PHP_DOCUMENTOR\" -t \"$DIR_PACKAGE_DOCS\" $STYLE -d \"$DIR_PACKAGE_SOURCE\" -ti \"$PACKAGE Documentation\"";
echo $CMD, "\n";
system($CMD);
echo "==================================================\n";
echo "DEBUG INFORMATION\n";
echo "==================================================\n";
echo "PHP               : $PHP\n";
echo "PHP_DOCUMENTOR    : $PHP_DOCUMENTOR\n";
echo "STYLE             : $STYLE\n";
echo "DIR_OUTPUT        : $DIR_PACKAGE_DOCS\n";
echo "DIR_PACKAGE_SOURCE: $DIR_PACKAGE_SOURCE\n";
echo "PACKAGE           : $PACKAGE\n";
echo "==================================================\n";
?>
