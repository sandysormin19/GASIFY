<?php

use App\Http\Controllers\MidtransController;

Route::post('/midtrans/notification', [MidtransController::class, 'notification']);
