<?php
/**
 * Created by PhpStorm.
 * User: loodeer
 * Date: 3/12/18
 * Time: 10:05
 */

// https://sentry.io/settings/loodeer/php/keys/
$client = (new Raven_Client('MY_SENTRY_DSN'))->install();
$client->user_context(['email' => 'email@loodeer.com', 'server' => $_SERVER, 'get' => $_GET, 'post' => $_POST, 'cookie' => $_COOKIE]);