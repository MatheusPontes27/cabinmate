<?php
require '../../../vendor/autoload.php';

use Hybridauth\Hybridauth;

$config = require '../../config/oauth.php';

$hybridauth = new Hybridauth($config);
$hybridauth->authenticate('linkedin');
