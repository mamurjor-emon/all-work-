// Pages section
    Route::resource('pages',PagesController::class)->except('show','destroy');
    Route::group(['prefix'=>'pages'], function(){
        Route::post('pages/get-data', [PagesController::class, 'getData'])->name('pages.get-data');
        Route::post('pages/delete', [PagesController::class, 'delete'])->name('pages.delete');
    });