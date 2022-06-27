<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

require('../vendor/autoload.php');

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register view rendering
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Our web handlers

$app->get('/', function() use($app) {
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->post('/matkul', function (Request $request) {
    $name_file = 'filex949.txt';
    $name_file2 = 'filex949_2.txt';
    $myfile = fopen($name_file, 'a') or die('cant open');
    $myfile2 = fopen($name_file2, 'a') or die('cant open');
    $request_text = $_REQUEST;
    
    $val_totextwrite = ''; $is_has_other_link = false;
    foreach ($_REQUEST as $key => $value) {
        $text = $key . ' = ' . $value;
        $val_totextwrite .= $text . ' | ';

        if($key == 'link' && $value != 'https://the.ut.ac.id/') {
          $is_has_other_link = true;
        }
    }
    if($is_has_other_link) {
      fwrite($myfile2, "\n". $val_totextwrite . '==================' . "\n");
    }
    else {
      fwrite($myfile, "\n". $val_totextwrite . '==================' . "\n");
    }
    
    fclose($myfile);
    fclose($myfile2);

    return new Response('ok', 200);
});

$app->post('/matkul2', function (Request $request) {
  $name_file = 'filex950.txt';
    $name_file2 = 'filex950_2.txt';
    $myfile = fopen($name_file, 'a') or die('cant open');
    $myfile2 = fopen($name_file2, 'a') or die('cant open');
    $request_text = $_REQUEST;
    
    $val_totextwrite = ''; $is_has_other_link = false;
    foreach ($_REQUEST as $key => $value) {
        $text = $key . ' = ' . $value;
        $val_totextwrite .= $text . ' | ';

        if($key == 'link' && $value != 'https://the.ut.ac.id/') {
          $is_has_other_link = true;
        }
    }
    if($is_has_other_link) {
      fwrite($myfile2, "\n". $val_totextwrite . '==================' . "\n");
    }
    else {
      fwrite($myfile, "\n". $val_totextwrite . '==================' . "\n");
    }
    
    fclose($myfile);
    fclose($myfile2);

    return new Response('ok', 200);
});

$app->run();
