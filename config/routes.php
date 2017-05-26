<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/lajit', function() {
    HelloWorldController::lajit();
  });

  $routes->get('/lajit/laji', function() {
    HelloWorldController::laji();
  });

  $routes->get('/urheilijat', function() {
    HelloWorldController::urheilijat();
  });

  $routes->get('/urheilijat/urheilija', function() {
    HelloWorldController::urheilija();
  });

  $routes->get('/tulokset', function() {
    HelloWorldController::tulokset();
  });

  $routes->get('/kirjaudu', function() {
    HelloWorldController::kirjaudu();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
