<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminAuth\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\AdminquesController1;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\TheoryController;
use App\Http\Controllers\StripePaymentController;











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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [HomeController::class, 'index'])->name("login");
Route::get('/', [HomeController::class, 'home'])->name("home");
Route::get('/courses', [HomeController::class, 'courses'])->name("courses");
Route::get('/topic_exams', [HomeController::class, 'topic_exams'])->name("topic_exams");
Route::get('/theory_booklets', [HomeController::class, 'theory_booklets'])->name("theory_booklets");
Route::get('/about_us', [HomeController::class, 'about_us'])->name("about_us");
Route::get('/privacy', [HomeController::class, 'privacy'])->name("privacy");

Route::get('/terms', [HomeController::class, 'terms'])->name("terms");
Route::get('/register', [HomeController::class, 'register'])->name("register");
Route::post('/submit_registration', [HomeController::class, 'submit_registration'])->name("submit_registration");
Route::get('stripe', [StripePaymentController::class, 'stripe'])->name("stripe");
Route::post('stripe', [StripePaymentController::class, 'stripePost'])->name('stripe.post');
Route::get('/register1', [HomeController::class, 'register1'])->name("register1");
Route::post('/submit_registration1', [HomeController::class, 'submit_registration1'])->name("submit_registration1");
Route::post('/submit_login', [HomeController::class, 'submit_login'])->name("submit_login");
Route::get('/stripe', [StripePaymentController::class, 'stripe'])->name("stripe");
Route::post('/stripe', [StripePaymentController::class, 'stripePost'])->name("stripe.post");
Route::get('/mathify_works', [HomeController::class, 'mathify_works'])->name("mathify_works");
Route::group(['prefix' => 'user', 'middleware' => 'user_auth:customer'], function () {
	Route::get('/courses_list', [HomeController::class, 'user_dashboard'])->name("courses_list");
	Route::get('/course_view/{id}', [UserController::class, 'course_view1'])->name("course_view");
	Route::get('/course_views/{id}', [UserController::class, 'course_view1'])->name("course_view1");
	Route::get('/theory/{id}', [UserController::class, 'theory'])->name("theory");
	Route::post('/read_theory', [UserController::class, 'read_theory'])->name("read_theory");
	Route::get('/start_quiz/{course_id}/{topic_id}/{st_id}', [UserController::class, 'start_quiz'])->name("start_quiz");
	Route::get('/start_quiz/{reference_id}', [UserController::class, 'start_quiz_exam'])->name("start_quiz_exam");
	Route::get('/quiz/{course_id}/{topic_id}/{st_id}', [UserController::class, 'quiz'])->name("quiz");
	Route::get('/quiz/{reference_id}', [UserController::class, 'quiz'])->name("exam_quiz");
	Route::post('/submit_quiz', [UserController::class, 'submit_quiz'])->name("submit_quiz");
	Route::post('/submit_question_answer', [UserController::class, 'submit_question_answer'])->name("submit_question_answer");
	Route::post('/save_timer', [UserController::class, 'save_timer'])->name("save_timer");
	Route::get('/session_analysis/{course_id}/{topic_id}/{st_id}', [UserController::class, 'session_analysis'])->name("session_analysis");
	Route::get('/session_analysis/{reference_id}', [UserController::class, 'session_analysis'])->name("session_analysis_exam");
	Route::get('/session_analysis_view/{course_id}/{topic_id}/{st_id}', [UserController::class, 'session_analysis_view'])->name("session_analysis");
	Route::get('/session_history/', [UserController::class, 'session_history'])->name("session_history");
	Route::get('/exam_builder', [UserController::class, 'exam_builder'])->name("exam_builder");
	Route::get('/exam_builder_view/{course_id}', [UserController::class, 'exam_builder_view'])->name("exam_builder_view");
	Route::post('/submit_exam_builder', [UserController::class, 'submit_exam_builder'])->name("submit_exam_builder");
	Route::get('/dashboard', [UserController::class, 'user_status'])->name("user_dashboard");
	Route::get('/settings', [UserController::class, 'settings'])->name("settings");
	Route::get('/change_password', [HomeController::class, 'change_password'])->name("change_password");
	Route::post('/postuser_ChangePassword', [HomeController::class, 'postuser_ChangePassword'])->name("postuser_ChangePassword");
	Route::get('/pricing', [HomeController::class, 'pricing_page'])->name("pricing");
	Route::get('/logout', [HomeController::class, 'user_logout'])->name("user_logout");
});

Route::get('/admin/add_questions', [AdminquesController1::class, 'index'])->name('add_questions');
Route::post('/admin/post_questions', [AdminquesController1::class, 'post_questions'])->name('post_questions');
Route::get('/admin/add_questions_bank/{chapter_id?}', [AdminquesController1::class, 'add_questions_bank'])->name('add_questions_bank');
Route::post('/admin/post_questions_bank', [AdminquesController1::class, 'post_questions_bank'])->name('post_questions_bank');
Route::post('question/img', [AdminquesController1::class, 'uploadMedia'])->name('admin.question.uploadMedia');
Route::post('/admin/fetch-subtopics', [AdminquesController1::class, 'fetch_subtopics'])->name('fetch-subtopics');
Route::get('/admin/show_questions/{chapter_id}', [AdminquesController1::class, 'show_questions'])->name('show_questions');
Route::get('/admin/exam_builder_management', [AdminquesController1::class, 'show_questions'])->name('exam_builder_management');
Route::get('/admin', [AuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [Authcontroller::class, 'login'])->name("login.admin");
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name("admin.dashboard");
Route::get('/admin/logout', [AuthController::class, 'logout'])->name("admin.logout");
Route::get('/admin/change_password', [AdminController::class, 'showPasswordForm'])->name("admin.showPasswordForm");
Route::post('/admin/change_password', [AdminController::class, 'updatepassword'])->name("admin.updatepassword");

// Student Management 
Route::get('/admin/studentlist', [StudentController::class, 'student_list'])->name("student.list");
Route::get('/admin/student-view/{id}', [StudentController::class, 'student_view'])->name("student.view");
Route::get('/admin/student-form/{id}', [StudentController::class, 'student_form'])->name("student.edit");
Route::get('/admin/student-form', [StudentController::class, 'student_form'])->name("student.edit");
Route::post('/admin/student_action', [StudentController::class, 'student_action'])->name("student.action");

Route::get('/admin/payment_details', [AdminController::class, 'show_payment'])->name("show_payment");


Route::get('/admin/student_delete/{id}', [StudentController::class, 'student_delete'])->name("student.delete");

// Course Management
Route::get('/admin/courselist', [CoursesController::class, 'course_list'])->name("course.list");
Route::get('/admin/course-form', [CoursesController::class, 'course_form'])->name("course.form");
Route::post('/admin/course_action', [CoursesController::class, 'course_action'])->name("course.action");
Route::get('/admin/course-view/{id}', [CoursesController::class, 'course_view'])->name("course.view");
Route::get('/admin/course-form/{id}', [CoursesController::class, 'course_form'])->name("course.edit");
Route::get('/admin/course-delete/{id}', [CoursesController::class, 'course_delete'])->name("course.delete");
Route::post('/admin/course_status', [CoursesController::class, 'course_status'])->name("course.status");
Route::post('/student/student_status', [StudentController::class, 'student_status'])->name("student.status");
Route::post('/admin/fetch-topics', [CoursesController::class, 'fetch_topics'])->name("fetch.topics");
Route::post('/admin/update-order', [CoursesController::class, 'update_order'])->name("update.order");
Route::post('/admin/update_chapterorder', [TopicController::class, 'update_chapterorder'])->name("update.chapter.order");
Route::post('/admin/update-questionorder', [AdminquesController1::class, 'update_questionorder'])->name("update.questionorder");






// Topic Management

Route::get('/admin/topiclist', [TopicController::class, 'topic_list'])->name("topic.list");
Route::get('/admin/topic-form', [TopicController::class, 'topic_form'])->name("topic.form");
Route::post('/admin/topic_action', [TopicController::class, 'topic_action'])->name("topic.action");
Route::get('/admin/topic-form/{id}', [TopicController::class, 'topic_form'])->name("topic.edit");
Route::get('/admin/topic-delete/{id}', [TopicController::class, 'topic_delete'])->name("topic.delete");
Route::post('/admin/topic_status', [TopicController::class, 'topic_status'])->name("topic.status");

Route::post('/admin/update_topicrorder', [TopicController::class, 'update_topicrorder'])->name("update.topic.order");

// Sub - Topic Management 


Route::get('/admin/subtopiclist1/{course_id}/{topic_id}', [TopicController::class, 'subtopic_list1'])->name("subtopic.list");
Route::get('/admin/subtopiclist/', [TopicController::class, 'subtopic_list'])->name("subtopic.list1");
Route::post('/admin/subtopic_action', [TopicController::class, 'subtopic_action'])->name("subtopic.action");
Route::get('/admin/subtopic-form', [TopicController::class, 'subtopic_form'])->name("subtopic.form");
Route::get('/admin/subtopic-form1/{course_id}/{topic_id}', [TopicController::class, 'subtopic_form1'])->name("subtopic.form");
Route::get('/admin/subtopic-form1/{id}', [TopicController::class, 'subtopic_form1'])->name("subtopic.edit");
Route::get('/admin/subtopic-delete/{id}/{topic_id}', [TopicController::class, 'subtopic_delete'])->name("subtopic.delete");
Route::get('/admin/subtopic_status', [TopicController::class, 'subtopic_status'])->name("subtopic.status");


// Theory management
Route::get('/admin/theorylist', [TheoryController::class, 'theory_list'])->name("theory.list");
Route::get('/admin/theory-form', [TheoryController::class, 'theory_form'])->name("theory.form");
Route::post('/admin/fetch-chapters', [TheoryController::class, 'fetch_chapters'])->name("fetch.chapters");
Route::post('/admin/theory_action', [TheoryController::class, 'theory_action'])->name("theory.action");
Route::get('/admin/theory-form/{id}', [TheoryController::class, 'theory_form'])->name("theory.edit");
Route::get('/admin/theory-delete/{id}', [TheoryController::class, 'theory_delete'])->name("theory.delete");
Route::post('/admin/theory_status', [TheoryController::class, 'theory_status'])->name("theory.status");
Route::get('/user/course_view/{id}', [UserController::class, 'course_view'])->name("course_view_dashboard");

Route::post('/user/profile_action', [UserController::class, 'profile_action'])->name("profile_action");

Route::get('/user/change_password', [UserController::class, 'showPasswordForm'])->name("user.showPasswordForm");

Route::post('/user/change_password', [UserController::class, 'change_password'])->name("user.change_password");
  // Question Management 
    Route::get('/admin/show_questions', [AdminquesController1::class, 'show_questions'])->name('show_questions');
    Route::get('/admin/question_delete/{id}', [AdminquesController1::class, 'question_delete'])->name("question.delete");
    Route::post('/admin/question_status', [AdminquesController1::class, 'question_status'])->name("question.status");

    Route::get('/admin/question-form/{id}/{chapter_id?}', [AdminquesController1::class, 'edit_questions_bank'])->name("question.edit");

    Route::post('/admin/post_questions_bank_edit', [AdminquesController1::class, 'post_questions_bank_edit'])->name('post_questions_bank_edit');

   




 


























