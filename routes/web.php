<?php

use App\Http\Controllers\admin\AdminsController;
use App\Http\Controllers\Admin\CatController as AdminCatController;
use App\Http\Controllers\Admin\ExamController as AdminExamController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\MessagesController;
use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\admin\StudentController;
use App\Http\Controllers\web\CatController;
use App\Http\Controllers\web\ContactController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
use App\Http\Controllers\web\ProfileController;
use App\Http\Controllers\web\SkillController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('lang')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/categories/show/{id}', [CatController::class, 'show']);
    Route::get('/skills/show/{id}', [SkillController::class, 'show']);
    Route::get('/exam/show/{id}', [ExamController::class, 'show']);
    Route::get('/exam/questions/{id}', [ExamController::class, 'questions'])->middleware(['auth', 'verified', 'student']);
    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact/message/send', [ContactController::class, 'send']);
    Route::get('/profile', [ProfileController::class, 'index'])->middleware(['auth', 'verified', 'student']);
});

Route::post('/exams/start/{id}', [ExamController::class, 'start'])->middleware(['auth', 'verified', 'student', 'can-enter-exam']);
Route::post('/exams/submit/{id}', [ExamController::class, 'submit'])->middleware(['auth', 'verified', 'student']);

Route::get('/lang/set/{lang}', [LangController::class, 'set']);


Route::prefix('dashboard')->middleware(['auth', 'verified', 'can-enter-dashboard'])->group(function () {
    Route::get('/', [AdminHomeController::class, 'index']);

    //cat Routes
    Route::get('/categories', [AdminCatController::class, 'index']);
    Route::post('/categories/store', [AdminCatController::class, 'store']);
    Route::post('/categories/update', [AdminCatController::class, 'update']);
    Route::get('/categories/delete/{cat}', [AdminCatController::class, 'delete']);
    Route::get('/categories/toggle/{cat}', [AdminCatController::class, 'toggle']);

    // skills Routes
    Route::get('/skills', [AdminSkillController::class, 'index']);
    Route::post('/skills/store', [AdminSkillController::class, 'store']);
    Route::post('/skills/update', [AdminSkillController::class, 'update']);
    Route::get('/skills/delete/{skill}', [AdminSkillController::class, 'delete']);
    Route::get('/skills/toggle/{skill}', [AdminSkillController::class, 'toggle']);

    // exams Routes
    Route::get('/exams', [AdminExamController::class, 'index']);
    Route::get('/exams/show/{exam}', [AdminExamController::class, 'show']);
    Route::get('/exams/show-questions/{exam}', [AdminExamController::class, 'showQuestions']);
    Route::get('/exams/create-questions/{exam}', [AdminExamController::class, 'createQuestions']);
    Route::post('/exams/store-questions/{exam}', [AdminExamController::class, 'storeQuestions']);
    Route::get('/exams/create', [AdminExamController::class, 'create']);
    Route::post('/exams/store', [AdminExamController::class, 'store']);
    Route::get('/exams/edit/{exam}', [AdminExamController::class, 'edit']);
    Route::post('/exams/update/{exam}', [AdminExamController::class, 'update']);
    Route::get('/exams/edit-questions/{exam}/{questions}', [AdminExamController::class, 'editQuestions']);
    Route::post('/exams/update-questions/{exam}/{questions}', [AdminExamController::class, 'updateQuestions']);
    Route::get('/exams/toggle/{exam}', [AdminExamController::class, 'toggle']);
    Route::get('/exams/delete/{exam}', [AdminExamController::class, 'delete']);

    // students Routes
    Route::get('/students', [StudentController::class, 'index']);
    Route::get('/students/show-scores/{id}', [StudentController::class, 'showScores']);
    Route::get('/students/open-exam/{studentId}/{examId}', [StudentController::class, 'openExam']);
    Route::get('/students/closed-exam/{studentId}/{examId}', [StudentController::class, 'closedExam']);


    // admins Routes
    Route::middleware('superadmin')->group(function () {
        Route::get('/admins', [AdminsController::class, 'index']);
        Route::get('/admins/create', [AdminsController::class, 'create']);
        Route::post('/admins/store', [AdminsController::class, 'store']);
        Route::get('/admins/promote/{id}', [AdminsController::class, 'promote']);
        Route::get('/admins/demote/{id}', [AdminsController::class, 'demote']);
    });

    Route::get('/messages', [MessagesController::class, 'index']);
    Route::get('/messages/show/{messages}', [MessagesController::class, 'show']);
    Route::post('/messages/response/{messages}', [MessagesController::class, 'response']);
});


