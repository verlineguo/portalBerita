<?php

use App\Http\Controllers\admin\AdminMainController;
use App\Http\Controllers\Admin\AdvertisementController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Writer\PostController as WriterPostController;
use App\Http\Controllers\Writer\ProfileController as WriterProfileController;
use App\Http\Controllers\Visitor\NewsletterController as VisitorNewsletterController;
use App\Http\Controllers\Visitor\ContactController as VisitorContactController;
use App\Http\Controllers\Visitor\CategoryController as VisitorCategoryController;
use App\Http\Controllers\Visitor\PostController as VisitorPostController;
use App\Http\Controllers\Visitor\VisitorMainController;
use App\Http\Controllers\Writer\WriterMainController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminMainController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('admin.dashboard');
            Route::get('/settings', 'setting')->name('admin.settings');
        });

        Route::controller(AdvertisementController::class)->group(function () {
            Route::get('/advertisement/create', 'index')->name('admin.advertisement.create');
            Route::get('/advertisement/manage', 'manage')->name('admin.advertisement.manage');
            Route::post('/store/advertisement', 'store')->name('admin.advertisement.store');
            Route::get('/advertisement/{id}', 'show')->name('admin.advertisement.show');
            Route::put('/advertisement/update/{id}', 'update');
            Route::get('/advertisement/update/{id}', 'update')->name('admin.advertisement.update');
            Route::delete('/advertisement/delete/{id}', 'destroy')->name('admin.advertisement.delete');
        });

        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category/create', 'index')->name('admin.category.create');
            Route::get('/category/manage', 'manage')->name('admin.category.manage');
            Route::post('/store/category', 'store')->name('admin.category.store');
            Route::get('/category/{id}', 'show')->name('admin.category.show');
            Route::put('/category/update/{id}', 'update');
            Route::get('/category/update/{id}', 'update')->name('admin.category.update');
            Route::delete('/category/delete/{id}', 'destroy')->name('admin.category.delete');
        });

        Route::controller(PostController::class)->group(function () {
            Route::get('/post/create', 'index')->name('admin.post.create');
            Route::get('/post/manage', 'manage')->name('admin.post.manage');
            Route::post('/store/post', 'store')->name('admin.post.store');
            Route::get('/post/{id}', 'show')->name('admin.post.show');
            Route::put('/post/update/{id}', 'update');
            Route::get('/post/update/{id}', 'update')->name('admin.post.update');
            Route::delete('/post/delete/{id}', 'destroy')->name('admin.post.delete');
            Route::get('/tags/search', 'search')->name('admin.tags.search');
        });

        Route::controller(TagController::class)->group(function () {
            Route::get('/tag/create', 'index')->name('admin.tag.create');
            Route::get('/tag/manage', 'manage')->name('admin.tag.manage');
            Route::post('/store/tag', 'store')->name('admin.tag.store');
            Route::get('/tag/{id}', 'show')->name('admin.tag.show');
            Route::put('/tag/update/{id}', 'update');
            Route::get('/tag/update/{id}', 'update')->name('admin.tag.update');
            Route::delete('/tag/delete/{id}', 'destroy')->name('admin.tag.delete');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('/user/create', 'index')->name('admin.user.create');
            Route::get('/user/manage', 'manage')->name('admin.user.manage');
            Route::post('/store/user', 'store')->name('admin.user.store');
            Route::get('/user/{id}', 'show')->name('admin.user.show');
            Route::put('/user/update/{id}', 'update');
            Route::get('/user/update/{id}', 'update')->name('admin.user.update');
            Route::delete('/user/delete/{id}', 'destroy')->name('admin.user.delete');
        });
        Route::controller(ContactController::class)->group(function () {
            Route::get('/contact/manage', 'manage')->name('admin.contact.manage');
            Route::get('/contacts/{id}', 'show')->name('admin.contact.show');
            Route::delete('/contact/delete/{id}', 'destroy')->name('admin.contact.delete');
        });
        Route::controller(CommentController::class)->group(function () {
            Route::get('/comments/manage', 'index')->name('admin.comment.index');
            Route::get('/admin/comments/{post}', 'manage')->name('admin.comment.manage');
            Route::put('/admin/comments/toggle/{id}', 'toggle')->name('admin.comments.toggle');
            Route::delete('/admin/comments/destroy/{id}', 'destroy')->name('admin.comments.destroy');
        });
        Route::controller(NewsletterController::class)->group(function () {
            Route::get('/newsletter/manage', 'manage')->name('admin.newsletter.manage');
            Route::delete('/newsletter/delete/{id}', 'destroy')->name('admin.newsletter.delete');
        });

        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('/profile', 'index')->name('admin.profile');
            Route::put('/profile', 'update')->name('admin.profile.update');
            Route::put('/profile/password', 'updatePassword')->name('admin.profile.password.update');
        });
    });
});

Route::middleware(['auth', 'verified', 'rolemanager:writer'])->group(function () {
    Route::prefix('writer')->group(function () {
        Route::controller(WriterMainController::class)->group(function () {
            Route::get('/dashboard', 'index')->name('writer.dashboard');
            Route::get('/settings', 'setting')->name('writer.settings');
            Route::get('/comment/history', 'comment_history')->name('admin.comment.history');
        });

        Route::controller(WriterPostController::class)->group(function () {
            Route::get('/post/create', 'index')->name('writer.post.create');
            Route::get('/post/manage', 'manage')->name('writer.post.manage');
            Route::post('/store/post', 'store')->name('writer.post.store');
            Route::get('/post/{id}', 'show')->name('writer.post.show');
            Route::put('/post/update/{id}', 'update');
            Route::get('/post/preview/{id}', 'preview')->name('writer.post.preview');
            Route::get('/post/update/{id}', 'update')->name('writer.post.update');
            Route::get('/post/view/{id}', 'preview')->name('writer.post.view');
            Route::delete('/post/delete/{id}', 'destroy')->name('writer.post.delete');
            Route::get('/tags/search', 'search')->name('writer.tags.search');
        });

        Route::controller(CommentController::class)->group(function () {
            Route::get('/comments/manage', 'index')->name('writer.comments');
            Route::get('/writer/comments/{post}', 'manage')->name('writer.comment.manage');
            Route::put('/writer/comments/toggle/{id}', 'toggle')->name('writer.comments.toggle');
            Route::delete('/writer/comments/destroy/{id}', 'destroy')->name('writer.comments.destroy');
        });

        Route::controller(WriterProfileController::class)->group(function () {
            Route::get('/profile', 'index')->name('writer.profile');
            Route::put('/profile', 'update')->name('writer.profile.update');
            Route::put('/profile/password', 'updatePassword')->name('writer.profile.password.update');
        });
    });
});

Route::prefix('visitor')->group(function () {
    Route::controller(VisitorMainController::class)->group(function () {
        Route::get('/page', 'index')->name('visitor.page');
        Route::get('/post/{slug}', 'show')->name('visitor.post.details');
        Route::post('/post/{slug}/comment', 'storeComment')->name('visitor.post.comment')->middleware('auth');
        Route::get('/latestnews', 'index')->name('visitor.latest_news');
        Route::get('/settings', 'setting')->name('visitor.settings');
        Route::get('/comment/history', 'comment_history')->middleware('auth')->name('visitor.comment.history');
        Route::get('/about', 'about')->name('visitor.about');
        Route::get('/tag/{name}', 'tagPosts')->name('tag.posts');

    });
    Route::controller(VisitorNewsletterController::class)->group(function () {
        Route::post('/newsletter', 'store')->name('visitor.newsletter.store');
    });
    Route::controller(VisitorCategoryController::class)->group(function () {
        Route::get('/category', 'index')->name('visitor.category');
        Route::get('/category/{slug}', 'show')->name('visitor.category.show');
    });
    Route::controller(VisitorContactController::class)->group(function () {
        Route::get('/contact', 'index')->name('visitor.contact');
        Route::post('/contact', 'store')->name('visitor.contact.store');
    });

    Route::controller(VisitorPostController::class)->group(function () {
        Route::get('/latestnews', 'index')->name('visitor.latest_news');
    });
});

require __DIR__ . '/auth.php';
