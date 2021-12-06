<?php
$_CONFIG = array(
 
    'disabled' => true,
    'denyZipDownload' => false,
    'denyUpdateCheck' => false,
    'denyExtensionRename' => false,
 
    'theme' => "default",
 
    'uploadURL' => "upload",
    'uploadDir' => "",
 
    'dirPerms' => 0755,
    'filePerms' => 0644,
 
    'access' => array(
 
        'files' => array(
            'upload' => true,
            'delete' => true,
            'copy' => true,
            'move' => true,
            'rename' => true
        ),
 
        'dirs' => array(
            'create' => true,
            'delete' => true,
            'rename' => true
        )
    ),
 
    'deniedExts' => "exe com msi bat cgi pl php phps phtml php3 php4 php5 php6 py pyc pyo pcgi pcgi3 pcgi4 pcgi5 pchi6",
 
    'types' => array(
 
        // CKEditor & FCKEditor types
        'files'   =>  "",
        'flash'   =>  "swf",
        'images'  =>  "*img",
 
        // TinyMCE types
        'file'    =>  "",
        'media'   =>  "swf flv avi mpg mpeg qt mov wmv asf rm",
        'image'   =>  "*img",
    ),
 
    'filenameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),
 
    'dirnameChangeChars' => array(/*
        ' ' => "_",
        ':' => "."
    */),
 
    'mime_magic' => "",
 
    'maxImageWidth' => 0,
    'maxImageHeight' => 0,
 
    'thumbWidth' => 100,
    'thumbHeight' => 100,
 
    'thumbsDir' => ".thumbs",
 
    'jpegQuality' => 90,
 
    'cookieDomain' => "",
    'cookiePath' => "",
    'cookiePrefix' => 'KCFINDER_',
 
    // THE FOLLOWING SETTINGS CANNOT BE OVERRIDED WITH SESSION CONFIGURATION
    '_check4htaccess' => false,
    //'_tinyMCEPath' => "/tiny_mce",
 
    '_sessionVar' => &$_SESSION['ses_kcfinder'],
    //'_sessionLifetime' => 30,
    //'_sessionDir' => "/full/directory/path",
 
    //'_sessionDomain' => ".mysite.com",
    //'_sessionPath' => "/my/path",
);


?>