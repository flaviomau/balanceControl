<?php

$this->group([
    'middleware'=> ['auth'],
    'namespace' => 'Admin', 
    'prefix'    => 'admin'], function()
{
    $this->get('/',                 'AdminController@index')->name('admin.home');
    $this->get('/balance',          'BalanceController@index')->name('admin.balance');
    $this->get('/balance/deposit',  'BalanceController@deposit')->name('balance.deposit');    
    $this->get('/balance/withdraw', 'BalanceController@withdraw')->name('balance.withdraw');
    $this->get('/balance/transfer', 'BalanceController@transfer')->name('balance.transfer');

    $this->post('/balance/deposit', 'BalanceController@depositStore')->name('deposit.store');
    $this->post('/balance/withdraw','BalanceController@withdrawStore')->name('withdraw.store');
    $this->post('/balance/confirm-transfer','BalanceController@confirmTransfer')->name('transfer.confirm');
    $this->post('/balance/transfer','BalanceController@transferStore')->name('transfer.store');
});

$this->get('/', 'Site\SiteController@index')->name('home');

Auth::routes();
