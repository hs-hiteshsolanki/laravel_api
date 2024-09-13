<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BalanceController;
use App\Http\Controllers\api\ItemController;
use App\Http\Controllers\api\PartyController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\TransactionController;
use Illuminate\Support\Facades\Route;

// Route::apiResource('products',ProductController::class);
// Route::apiResource('products',ProductController::class);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);

Route::post('/issue_item', [TransactionController::class, 'issueItem']);
Route::post('/receive_item', [TransactionController::class, 'receiveItem']);

Route::post('/fine_balance', [BalanceController::class, 'fineBalance']);
Route::post('/touchwise_balance', [BalanceController::class, 'touchwiseBalance']);
Route::post('/ledger',[BalanceController::class, 'ledgerBalance']);
Route::post('/curret_stock',[BalanceController::class, 'currentStock']);

Route::post('/party_list', [PartyController::class, 'partyList']);
Route::post('/item_list',[ItemController::class, 'itemList']);

route::post('/delete',[TransactionController::class,'deleteTransaction']);
route::post('/edit',[TransactionController::class,'editTransaction']);

