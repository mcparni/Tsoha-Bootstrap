<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/lajit', function() {
    SportController::lajit();
  });

  $routes->get('/lajit/:id', function($id){
    SportController::laji($id);
  });

  $routes->get('/urheilijat', function() {
    PlayerController::urheilijat();
  });

  $routes->get('/urheilijat/:id', function($id){
    PlayerController::urheilija($id);
  });

  $routes->get('/tulokset', function() {
    ResultsController::tulokset();
  });

  $routes->get('/kirjaudu', function() {
    HelloWorldController::kirjaudu();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
