<?php

require_once __DIR__ . '/vendor/autoload.php';
ini_set('display_errors', 'On');
ini_set('error_reporting', E_ALL);










$workflow = new \Alfred\Workflows\Workflow();
$workflow->variable('fruit', 'apple')
    ->variable('vegetables', 'carrots');

$workflow->result()
    ->uid('bob-belcher')
    ->title('Bob')
    ->subtitle('Head Burger Chef')
    ->quicklookurl('http://www.bobsburgers.com')
    ->type('default')
    ->arg('bob')
    ->valid(true)
    ->icon('bob.png')
    ->mod('cmd', 'Search for Bob', 'search')
    ->text('copy', 'Bob is the best!')
    ->autocomplete('Bob Belcher');

$workflow->result()
    ->uid('linda-belcher')
    ->title('Linda')
    ->subtitle('Wife')
    ->quicklookurl('http://www.bobsburgers.com')
    ->type('default')
    ->arg('linda')
    ->valid(true)
    ->icon('linda.png')
    ->mod('cmd', 'Search for Linda', 'search')
    ->text('largetype', 'Linda is the best!')
    ->autocomplete('Linda Belcher');

echo $workflow->output();