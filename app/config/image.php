<?php

return array(
    'library'     => 'imagick',
    'upload_path' => public_path() . '/uploads/',
    'quality'     => 85,
    'upload_dir'  => 'uploads',
 
    'dimensions' => array(
        'thumb'  => array(100, 100, true,  80),
        'medium' => array(600, 400, false, 90),
    ),
);