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
  $name_file2 = 'filex949_2.txt'; $ada = 0;
  $myfile = fopen($name_file, 'a') or die('cant open');
  $myfile2 = fopen($name_file2, 'a') or die('cant open');
  $request_text = $_REQUEST;
  
  foreach ($_REQUEST as $key => $value) {
      if($key == 'link' && $value == 'https://the.ut.ac.id/') {
        $text = $key . ' = ' . $value;
        fwrite($myfile, ''. $text . ' | ');
      }
      else {
        $ada = 1;
        $text = $key . ' = ' . $value;
        fwrite($myfile2, ''. $text . ' | ');
      }
      
  }
  fwrite($myfile, "\n". '==================' . "\n");
  fclose($myfile);
  if($ada == 1) {
    fwrite($myfile2, "\n". '==================' . "\n");
  }
  fclose($myfile2);

  return new Response('ok', 200);
});

$app->post('/matkul2', function (Request $request) {
  $name_file = 'filex950.txt';
  $name_file2 = 'filex950_2.txt'; $ada = 0;
  $myfile = fopen($name_file, 'a') or die('cant open');
  $myfile2 = fopen($name_file2, 'a') or die('cant open');
  $request_text = $_REQUEST;
  
  foreach ($_REQUEST as $key => $value) {
      if($key == 'link' && $value == 'https://the.ut.ac.id/') {
        $text = $key . ' = ' . $value;
        fwrite($myfile, ''. $text . ' | ');
      }
      else {
        $ada = 1;
        $text = $key . ' = ' . $value;
        fwrite($myfile2, ''. $text . ' | ');
      }
      
  }
  fwrite($myfile, "\n". '==================' . "\n");
  fclose($myfile);
  if($ada == 1) {
    fwrite($myfile2, "\n". '==================' . "\n");
  }
  fclose($myfile2);

  return new Response('ok', 200);
});

$app->run();
