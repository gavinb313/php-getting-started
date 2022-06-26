<?php

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

$app->post('/matkul', function($request) use($app) {
  $name_file = 'filex949.txt';
  $myfile = fopen($name_file, 'a') or die('cant open');
  $request_text = $request;

  foreach ($request_text as $key => $value) {
      echo $key . ' = ' . $value . "\n";
      $text = $key . ' = ' . $value;
      fwrite($myfile, ''. $text . ' | ');
  }
  fwrite($myfile, "\n". '==================' . "\n");
  fclose($myfile);
  
  $app['monolog']->addDebug('logging output.');
  return $app['twig']->render('index.twig');
});

$app->run();
