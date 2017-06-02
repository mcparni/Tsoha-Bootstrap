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

  $routes->post('/urheilijat', function() {
    PlayerController::store();
  });

  $routes->get('/urheilijat/uusi', function() {
    PlayerController::uusi();
  });

  $routes->get('/urheilijat/:id', function($id){
    PlayerController::urheilija($id);
  });

  $routes->get('/urheilijat/:id/edit', function($id){
    PlayerController::editPlayer($id);
  });

  $routes->post('/urheilijat/:id/edit', function($id){
    PlayerController::update($id);
  });

  $routes->post('/urheilijat/:id/remove', function($id){
    PlayerController::remove($id);
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
