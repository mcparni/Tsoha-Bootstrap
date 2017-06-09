<?php

  $routes->get('/', function() {
    IndexController::index();
  });

  $routes->get('/sports', function() {
    SportController::sports();
  });
  
  $routes->post('/sports', function() {
    SportController::store();
  });

  $routes->get('/sports/new', function() {
    SportController::new();
  });

  $routes->get('/sports/:id', function($id){
    SportController::sport($id);
  });

  $routes->get('/sports/:id/edit', function($id){
    SportController::editSport($id);
  });

  $routes->post('/sports/:id/edit', function($id){
    SportController::update($id);
  });

  $routes->post('/sports/:id/remove', function($id){
    SportController::remove($id);
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

  $routes->get('/results/new', function() {
    ResultsController::new();
  });

  $routes->get('/results', function() {
    ResultsController::results();
  });

  $routes->post('/results', function() {
    ResultsController::store();
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
