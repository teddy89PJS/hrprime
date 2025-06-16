<?php

//New Routes
use App\Http\Controllers\layouts\ImportPayroll;
use App\Http\Controllers\layouts\SummaryofLates;
use App\Http\Controllers\layouts\Payroll;
use App\Http\Controllers\layouts\Tax;
use App\Http\Controllers\layouts\Deductions;
use App\Http\Controllers\layouts\LeaveCredits;
use App\Http\Controllers\layouts\Reports;
use App\Http\Controllers\layouts\FundSource;

use App\Http\Controllers\pas\FundSourceController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\hrplanning\ListofEmployeeController;
use App\Http\Controllers\hrplanning\RegistrationFormController;
use App\Http\Controllers\hrplanning\ListofPositionController;
use App\Http\Controllers\hrplanning\OfficeLocationController;
use App\Http\Controllers\hrplanning\DivisionController;
use App\Http\Controllers\hrplanning\SectionController;
use App\Http\Controllers\hrplanning\EmploymentStatusController;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\RiIcons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\learning\LearningDev;
use App\Http\Controllers\learning\Trainings;
use App\Http\Controllers\learning\CourseController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\learning\CalendarController;
use App\Http\Controllers\learning\EventsController;
use App\Http\Controllers\learning\ScholarshipController;


// Redirect root URL to login page
Route::get('/', function () {
  return redirect()->route('auth-login-basic');
});
// Login Page
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');

// Dashboard (you can protect this later with auth middleware)
Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');

// Route::get('/', [LoginBasic::class, 'index'])->name('auth-login-basic');
// layout HRPLANNING
Route::get('/hrplanning/list-of-employee', [ListofEmployeeController::class, 'index'])->name('layouts-list-of-employee');
Route::get('/hrplanning/registration-form', [RegistrationFormController::class, 'index'])->name('layouts-registration-form');
Route::get('/hrplanning/list-of-position', [ListofPositionController::class, 'index'])->name('layouts-list-of-position');
Route::get('/hrplanning/office-location', [OfficeLocationController::class, 'index'])->name('layouts-office-location');
Route::get('/hrplanning/division', [DivisionController::class, 'index'])->name('layouts-division');
Route::get('/hrplanning/section', [SectionController::class, 'index'])->name('layouts-section');
Route::get('/hrplanning/employment-status', [EmploymentStatusController::class, 'index'])->name('layouts-employment-status');


// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name('pages-account-settings-account');
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name('pages-account-settings-notifications');
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name('pages-account-settings-connections');
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name('pages-misc-under-maintenance');

// authentication
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
Route::get('/auth/forgot-password-basic', [ForgotPasswordBasic::class, 'index'])->name('auth-forgot-password-basic');
Route::post('/auth/register-basic', [RegisterBasic::class, 'store'])->name('register.store');
Route::get('/auth/login-basic', [LoginBasic::class, 'index'])->name('auth-login-basic');
Route::post('/auth/login-basic', [LoginBasic::class, 'store'])->name('login.store');
Route::get('/auth/otp', [LoginBasic::class, 'showOtpForm'])->name('otp.form');
Route::post('/auth/otp', [LoginBasic::class, 'verifyOtp'])->name('otp.verify');


// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth'])->group(function () {
  Route::get('/dashboard', [Analytics::class, 'index'])->name('dashboard-analytics');
});




// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/icons-ri', [RiIcons::class, 'index'])->name('icons-ri');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// learnings
Route::get('/learning/listofTrainings', [LearningDev::class, 'index'])->name('listofTrainings');
Route::get('/learning/trainings', [Trainings::class, 'index'])->name('trainings');
Route::get('/learning/calendar', [CalendarController::class, 'index'])->name('calendar'); // for calendar view
Route::get('/learning/scholarship', [ScholarshipController::class, 'index'])->name('scholarship.index');
Route::post('/learning/scholarship', [ScholarshipController::class, 'store'])->name('scholarships.store');
Route::post('/scholarships/{id}/status', [ScholarshipController::class, 'updateStatus'])->name('scholarships.status');
Route::get('/learning/events', [EventsController::class, 'index'])->name('events');       // for events list page
Route::get('/calendar/events', [CalendarController::class, 'getEvents'])->name('calendar.events'); // JSON for FullCalendar
Route::get('/calendar/events', [CalendarController::class, 'getEvents'])->name('learning.calendar.events');

Route::post('/events', [EventsController::class, 'store'])->name('events.store'); // For form submission
Route::post('/events/store', [EventsController::class, 'store'])->name('events.store');
Route::post('/events/{id}/status', [EventsController::class, 'updateStatus'])->name('events.updateStatus');
Route::get('/learning/trainings', [CourseController::class, 'index']);
Route::post('/courses/store', [CourseController::class, 'store'])->name('courses.store');
Route::put('/courses/{course}', [CourseController::class, 'update']);
