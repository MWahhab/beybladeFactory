<?php

require_once ("database/config.php");

if ($argc < 2) {
    echo "Usage: php .\createBackup.php <backup_table_name>\n";
    exit(1);
}

$backupTableName = $argv[1];

/**
 * @var BeybladeFactory $factory
 */
$factory->backupTable($backupTableName);

exit();