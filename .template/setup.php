<?php

$projectName = basename(realpath("."));

// Reset README.md
file_put_contents( __DIR__ . '/../README.md', "#$projectName");

// Edit composer.json
$composerFilepath = __DIR__ . '/../composer.json';
$composerJson = file_get_contents($composerFilepath);
// Change name and description
$composerJson = preg_replace('/composer-template|Composer\spackage\stemplate/', $projectName, $composerJson);
// Use project name in Pascal case in psr-4 autoload
$projectName = preg_replace('/[-_]/', ' ', $projectName);
$projectName = ucwords($projectName);
$projectName = preg_replace('/\s/', '', $projectName);
$composerJson = preg_replace('/Template/', $projectName, $composerJson);
// Remove post-create-project-cmd script
$composerJson = preg_replace('/,\n.+"post-create-project-cmd":\s"php\s\.template\/setup\.php"/', '', $composerJson);
file_put_contents($composerFilepath, $composerJson);

// Remove template setup files
unlink(__DIR__ . '/setup.php');
rmdir(__DIR__ . '/../.template');
