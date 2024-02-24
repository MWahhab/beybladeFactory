<?php

require_once ("database/config.php");

if ($argc < 2) {
    echo "Usage: php .\mergeBackup.php <backup_table_name>\n";
    exit(1);
}

$backupTableName = $argv[1] . "_backup";

/**
 * @var BeybladeFactory $factory
 */
$factory->emptyTable();

$factory->mergeBackup($backupTableName);

exit();