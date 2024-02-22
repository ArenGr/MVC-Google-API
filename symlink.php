<?php

$sourceDist = __DIR__ . '/resources';
$symlinkDist = __DIR__ . '/public/resources';

if (!file_exists($symlinkDist)) {
    if (symlink($sourceDist, $symlinkDist)) {
        echo 'Symlink created successfully.';
    } else {
        echo 'Failed to create symlink.';
    }
} else {
    echo 'Symlink already exists.';
}
