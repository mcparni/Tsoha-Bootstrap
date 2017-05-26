<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function lajit(){
      View::make('lajit.html');
    }

    public static function laji(){
      View::make('laji.html');
    }

    public static function urheilijat(){
      View::make('urheilijat.html');
    }

    public static function urheilija(){
      View::make('urheilija.html');
    }

    public static function tulokset(){
      View::make('tulokset.html');
    }

    public static function kirjaudu(){
      View::make('kirjaudu.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      echo 'Hello World!';
    }
  }
