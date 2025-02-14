<?php

use App\Models\Investigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/cases', function() {
    return Investigation::with(['investigator', 'people', 'witnesses'])->get();
});

// maak een route die specifiek één case ophaalt
Route::get('/cases/{case}', function($id) {
    return Investigation::with(['investigator', 'people', 'witnesses'])->find($id);
});
