<?php

/**
 * Hoa
 *
 *
 * @license
 *
 * New BSD License
 *
 * Copyright © 2007-2016, Hoa community. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Hoa nor the names of its contributors may be
 *       used to endorse or promote products derived from this software without
 *       specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS AND CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * @copyright  Copyright © 2007-2016 Hoa community
 */

$autoloadFiles = [
    dirname(__DIR__) . DIRECTORY_SEPARATOR .
    'vendor' . DIRECTORY_SEPARATOR .
    'autoload.php',
    dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR .
    'autoload.php'
];

foreach ($autoloadFiles as $autoload) {
    if (true === file_exists($autoload)) {
        require_once $autoload;
    }
}

if (false === defined('HOA')) {
    echo 'The autoload.php file is not found.', "\n";
    exit(1);
}

use Hoa\Console;
use Hoa\Dispatcher;
use Hoa\Exception;
use Hoa\Router;

Exception\Error::enableErrorHandler();
Exception\Idle::enableUncaughtHandler();

try {
    $router = new Router\Cli();
    $router->get(
        'g',
        '((?<command>\w+)(?<_tail>.*?))?',
        'main',
        'main',
        ['command' => 'welcome']
    );

    $dispatcher = new Dispatcher\ClassMethod([
        'synchronous.call'
            => 'Atoum\PraspelExtension\Bin\Command\(:%variables.command:lU:)',
        'synchronous.able'
            => 'main'
    ]);
    $dispatcher->setKitName('Hoa\Console\Dispatcher\Kit');
    exit($dispatcher->dispatch($router));
} catch (Exception $e) {
    $message = $e->raise(true);
    $code    = 1;
} catch (\Exception $e) {
    $message = $e->getMessage();
    $code    = 2;
}

ob_start();

Console\Cursor::colorize('foreground(white) background(red)');
echo $message, "\n";
Console\Cursor::colorize('normal');
$content = ob_get_contents();

ob_end_clean();

file_put_contents('php://stderr', $content);
exit($code);
