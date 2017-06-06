<?php

  $routes->get('/', function() {
    IndexController::index();
  });

  $routes->get('/sports', function() {
    SportController::sports();
  });

  $routes->get('/sports/:id', function($id){
    SportController::sport($id);
  });

  $routes->get('/players', function() {
    PlayerController::players();
  });

  $routes->post('/players', function() {
    PlayerController::store();
  });

  $routes->get('/players/new', function() {
    PlayerController::new();
  });

  $routes->get('/players/:id', function($id){
    PlayerController::player($id);
  });

  $routes->get('/players/:id/edit', function($id){
    PlayerController::editPlayer($id);
  });

  $routes->post('/players/:id/edit', function($id){
    PlayerController::update($id);
  });

  $routes->post('/players/:id/remove', function($id){
    PlayerController::remove($id);
  });

  $routes->get('/results', function() {
    ResultsController::results();
  });

  $routes->get('/login', function() {
    AdminController::login();
  });

  $routes->post('/login', function() {
    AdminController::handleLogin();
  });
  $routes->post('/logout', function() {
    AdminController::logout();
  });

  $routes->get('/sandbox', function() {
    SandBoxController::sandbox();
  });
