<?php
Auth::routes();

//Route::namespace ('Admin')->group(function () {
    Route::get("/", [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth']);
    //Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);
    Route::post("logout", [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');


    Route::group(['middleware' => ['auth','officeadmin']], function() {
        
        // TypeTerrain Routes
        Route::get('admin/typestade/{id}/delete',[App\Http\Controllers\TypeStadeController::class,'destroy']);
        Route::resource('typestade',App\Http\Controllers\TypeStadeController::class);

        // Room
        //Route::get('admin/stade/{id}/delete',[App\Http\Controllers\HomeController::class,'destroy']);
        //Route::resource('admin/stade',App\Http\Controllers\HomeController::class);

        // Reservation
        Route::get('admin/reservation/{id}/delete',[App\Http\Controllers\ReservationController::class,'destroy']);
        Route::get('admin/reservation/available-rooms/{checkin_date}',[App\Http\Controllers\ReservationController::class,'available_rooms']);
        Route::resource('reservation',App\Http\Controllers\ReservationController::class);
        Route::post('reservation/approve/', [App\Http\Controllers\ReservationController::class, 'processApprove']);
    });
//});