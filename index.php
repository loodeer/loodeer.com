<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/sentry_secret.php';
ini_set('display_errors', 'On');
ini_set('error_reporting', E_ALL);

require_once __DIR__ . '/Workflow.php';

$url = 'http://sapi.xxx.com/item/detail/v1-32105602.html';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 100);
curl_setopt($ch, CURLOPT_TIMEOUT_MS, 200);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$j = curl_exec($ch);
curl_close($ch);
$obj = json_decode($j);

$fields = ['title', 'iid', 'event_id', 'product_id', 'uid', 'price', 'gmt_begin', 'gmt_end'];

$workflow = new \Alfred\Workflows\Workflow();
foreach ($fields as $index => $field) {
    if (strpos($field, 'gmt') === false) {
        $value = $obj->$field;
    } else {
        $value = date("Y-m-d H:i:s", $obj->field);
    }

    $workflow->result()->uid($index)->title($field)->subtitle($value)->type('default')->arg($obj->$field)->valid(true)->icon('icon.png');
}

echo $workflow->output();
die;
$db = new MysqliDb('127.0.0.1', 'root', '123456', 'test', '3306', 'utf8');
$b = $db->get('citys');
print_r($b);die;
die();

$connect = mysqli_connect('127.0.0.1', 'root', '123456', 'test');
if (!$connect) {
    echo mysqli_connect_errno() . '==>' . mysqli_connect_error();
    die();
}
mysqli_set_charset($connect, 'utf8');
$result = mysqli_query($connect, 'select * from citys');
$a = mysqli_fetch_all($result);
print_r($a);die;

function logger($filename) {
    $fd = fopen($filename, 'w+');
    while ($msg = yield) {
        fwrite($fd, date('y-m-d H:i:s') . ':' . $msg . PHP_EOL);
    }
    fclose($fd); // 这句一直没执行到啊
}
$logger = logger('log.txt');
$logger->send('promgram starts!'); // send 可以将数据传回生成器
$logger->send('promgram ends!');
die;

// 命令行里可执行
// yield 可以看成 return, 生成器执行到一次返回一次。
function foo() {
    yield "key1" => "value1"; // yield $key => $value: 返回数据的key和value;
    yield 100; // yield $value: 返回数据，key由系统分配；从 0 开始
    $count = 0;
    while ($count < 5) {
        yield $count; // yield $value: 返回数据，key由系统分配；
        ++ $count;
    }
    yield; // yield: 返回null值，key由系统分配；
}

$gen = foo();
while ($gen->valid()) {
    fwrite(STDOUT, "key:{$gen->key()}, value: {$gen->current()}\n");
    $gen->next();
}

fwrite(STDOUT, "\ndata from foreach\n");
foreach (foo() as $key => $value) {
    fwrite(STDOUT, "key:$key, value:$value\n");
}
die;

function foo1()
{
    exit('exit script when generator runs');
    yield;
}
$gen = foo1(); // 这行没有输出，生成器函数只有在调用是才执行一次，然后暂停，等待下次调用
var_dump($gen); // 先输出 object(Generator)[4]
$gen->current(); // 再输出 exit script when generator runs
echo 'unreachable code!'; // 这行不会输出
die;

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