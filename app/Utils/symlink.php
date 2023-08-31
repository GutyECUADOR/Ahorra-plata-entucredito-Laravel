<?php
$targetFolder = '/home/y4lazgik0j5u/backendinv'.'/storage/app/public';
$linkFolder = $_SERVER['DOCUMENT_ROOT'].'/backendinv/storage';

symlink($targetFolder,$linkFolder);

/*
echo $linkFolder.'</br>';
echo var_dump(is_dir($linkFolder));*/

echo 'Symlink process successfully completed';