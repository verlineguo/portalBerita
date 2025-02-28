<?php

use App\Http\Controllers\admin\AdminMainController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Editor\EditorMainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Visitor\VisitorMainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function() {
        Route::controller(AdminMainController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('admin.dashboard');
            Route::get('/settings', 'setting')->name('admin.settings');
            Route::get('/comment/history', 'comment_history')->name('admin.comment.history');
            Route::get('/contact/history', 'contact_history')->name('admin.contact.history');
            Route::get('/newsletter/history', 'newsletter_history')->name('admin.newsletter.history');
        });

        Route::controller(AdvertisementController::class)->group(function() {
            Route::get('/advertisement/create', 'index')->name('admin.advertisement.create');
            Route::get('/advertisement/manage', 'manage')->name('admin.advertisement.manage');
        });
      
        Route::controller(CategoryController::class)->group(function() {            
            Route::get('/category/create', 'index')->name('admin.category.create');
            Route::get('/category/manage', 'manage')->name('admin.category.manage');
            Route::post('/store/category', 'store')->name('admin.category.store');
            Route::get('/category/{id}', 'show')->name('admin.category.show');
            Route::put('/category/update/{id}', 'update');
            Route::get('/category/update/{id}', 'update')->name('admin.category.update');
            Route::delete('/category/delete/{id}', 'destroy')->name('admin.category.delete');

        });

        Route::controller(PostController::class)->group(function() {
            Route::get('/post/create', 'index')->name('admin.post.create');
            Route::get('/post/manage', 'manage')->name('admin.post.manage');
            Route::post('/store/post', 'store')->name('admin.post.store');
            Route::get('/post/{id}', 'show')->name('admin.post.show');
            Route::put('/post/update/{id}', 'update');
            Route::get('/post/update/{id}', 'update')->name('admin.post.update');
            Route::delete('/post/delete/{id}', 'destroy')->name('admin.post.delete');
        });
        
        Route::controller(TagController::class)->group(function() {
            Route::get('/tag/create', 'index')->name('admin.tag.create');
            Route::get('/tag/manage', 'manage')->name('admin.tag.manage');
        });
       
    });
        
        
});

Route::middleware(['auth', 'verified', 'rolemanager:editor'])->group(function () {
    Route::prefix('editor')->group(function() {
        Route::controller(EditorMainController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('editor.dashboard');
            Route::get('/settings', 'setting')->name('editor.settings');
            Route::get('/comment/history', 'comment_history')->name('admin.comment.history');
        });

        Route::controller(PostController::class)->group(function() {
            Route::get('/post/create', 'index')->name('admin.post.create');
            Route::get('/post/manage', 'manage')->name('admin.post.manage');
        });
        
        
       
    });
        
        
});


Route::middleware(['auth', 'verified', 'rolemanager:visitor'])->group(function () {
    Route::prefix('visitor')->group(function() {
        Route::controller(VisitorMainController::class)->group(function() {
            Route::get('/dashboard', 'index')->name('visitor.dashboard');
            Route::get('/settings', 'setting')->name('visitor.settings');
            Route::get('/comment/history', 'comment_history')->name('visitor.comment.history');
        });

   
    });
        
        
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
