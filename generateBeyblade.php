<?php

require_once ("database/config.php");

/**
 * @var BeybladeFactory $factory
 */
$beyblade = $factory->generateBeyblade();

$factory->insertBeyblade($beyblade);

exit();