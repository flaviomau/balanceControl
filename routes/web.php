<?php

$this->group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){
    $this->get('/balance', 'BalanceController@index')->name('admin.balance');
    $this->get('/balance/deposit', 'BalanceController@deposit')->name('balance.deposit');
    $this->post('/balance/deposit', 'BalanceController@depositStore')->name('deposit.store');
    $this->get('/balance/withdraw', 'BalanceController@withdraw')->name('balance.withdraw');
    $this->post('/balance/withdraw', 'BalanceController@withdrawStore')->name('withdraw.store');
    $this->get('/', 'AdminController@index')->name('admin.home');
});

$this->get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
