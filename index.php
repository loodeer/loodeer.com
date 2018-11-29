<?php
require_once __DIR__ . '/vendor/autoload.php';
ini_set('display_errors', 'On');
ini_set('error_reporting', E_ALL);












// ----------------------------------------------------------------------------
// https://github.com/hoaproject/Ruler

$rule = "requestParam.fightGroup = 1 and requestParam.platform = 'beidian'";
$requestParam = new stdClass();
//$requestParam->fightGroup = 1; // 字段不存在的话，会抛异常
$requestParam->platform = 'beidian';
$context = new \Hoa\Ruler\Context();
$context['requestParam'] = $requestParam;

$ruler = new \Hoa\Ruler\Ruler();
var_dump($ruler->assert($rule, $context));die();

// 语意分析
$model = \Hoa\Ruler\Ruler::interpret('points > 30');
// 翻译成 php 代码
$compiler = new \Hoa\Ruler\Visitor\Compiler();
print_r($compiler->visit($model));
// 转回成 rule 语句，可能语法上有略微差别，但是不会改变语意
$disassembly = new \Hoa\Ruler\Visitor\Disassembly();
print_r($disassembly->visit($model));die;
die;

// 语意分析 rule 为 AST，再翻译为 model
$compiler = \Hoa\Compiler\Llk\Llk::load(new \Hoa\File\Read('hoa://Library/Ruler/Grammar.pp'));
$ast = $compiler->parse('points > 30');
$interpreter = new \Hoa\Ruler\Visitor\Interpreter();
$model = $interpreter->visit($ast);
print_r($model);die;


// 自定义方法
class User {
    const DISCONNECTED = 0;
    const CONNECTED = 1;
    protected $_status = 0;
    public function getStatus() {
        return $this->_status;
    }
}

$logged = function (User $user) {
    return User::CONNECTED === $user->getStatus();
};

$rule = 'logged(user) and points > 30';

$context = new \Hoa\Ruler\Context();
$context['user'] = new User();
$context['points'] = 42;

$asserter = new \Hoa\Ruler\Visitor\Asserter();
$asserter->setOperator('logged', $logged);

$ruler = new \Hoa\Ruler\Ruler();
$ruler->setAsserter($asserter);
var_dump($ruler->assert($rule, $context));
die;


// 显示定义 asserter
$rule = 'points > 50';

$context = new \Hoa\Ruler\Context();
$context['points'] = 42;

$ruler = new \Hoa\Ruler\Ruler();
$asserter = new \Hoa\Ruler\Visitor\Asserter();
$ruler->setAsserter($asserter);
var_dump($ruler->assert($rule, $context));
die();



$ruler = new \Hoa\Ruler\Ruler();
$rule  = 'group in ["customer", "guest"] and points > 30';

$context = new Hoa\Ruler\Context();
$context['group']  = 'customer';
$context['points'] = function () {return 42;};

var_dump($ruler->assert($rule, $context));
die;

// ----------------------------------------------------------------------------
// https://github.com/joetannenbaum/alfred-workflow

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