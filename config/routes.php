<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/lajit', function() {
    SportController::lajit();
  });

  $routes->get('/lajit/:id', function($id){
    SportController::show($id);
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
