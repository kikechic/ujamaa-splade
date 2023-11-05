<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveTypeController;
use App\Http\Controllers\TimesheetController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ApprovalRequestController;
use App\Http\Controllers\TimesheetPeriodController;

Route::middleware(['splade'])->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/', HomeController::class)->name('home');

        Route::prefix('approvals')->group(function () {
            Route::get('/', [ApprovalController::class, 'index'])->name('approvals.index');
            Route::get('/{user}', [ApprovalController::class, 'show'])->name('approvals.show');
            Route::get('/{user}/edit', [ApprovalController::class, 'edit'])->name('approvals.edit');
            Route::put('/{user}/update', [ApprovalController::class, 'update'])->name('approvals.update');
            Route::delete('/{user}', [ApprovalController::class, 'destroy'])->name('approvals.destroy');
        });

        Route::resource('roles', RoleController::class);

        Route::resource('permissions', PermissionController::class);

        Route::put('/companies/switch', [CompanyController::class, 'switch'])->name('companies.switch');
        Route::resource('companies', CompanyController::class);

        Route::resource('departments', DepartmentController::class);
        Route::resource('designations', DesignationController::class);
        Route::resource('offices', OfficeController::class);
        Route::resource('donors', DonorController::class);
        Route::resource('employees', EmployeeController::class);

        Route::resource('leave-types', LeaveTypeController::class, [
            'parameters' => [
                'leave-types' => 'leaveType'
            ]
        ])->names('leaveTypes');

        Route::post('users/{user}/signature/destroy', [UserController::class, 'destroySignature'])->name('user-signature.destroy');
        Route::resource('users', UserController::class);

        Route::prefix('timesheets')->group(function () {
            Route::get('{timesheet}/approve', [TimesheetController::class, 'approveTimesheet'])->name('timesheets.approve');
            Route::post('{timesheet}/approve', [TimesheetController::class, 'approveTimesheetStore'])->name('timesheets.approve.store');
            Route::post('{timesheet}/post', [TimesheetController::class, 'postTimesheet'])->name('timesheets.post');
            Route::post('{timesheet}/post/print', [TimesheetController::class, 'postPrintTimesheet'])->name('timesheets.post.print');
            Route::get('/entry', [TimesheetController::class, 'entry'])->name('timesheets.entry');
            Route::post('/entry', [TimesheetController::class, 'entryStore'])->name('timesheets.entry.store');
            Route::get('/reports/missing/entry', [TimesheetController::class, 'missingReportEntry'])->name('timesheets.reports.missing.entry');
            Route::get('/reports/missing', [TimesheetController::class, 'missingReport'])->name('timesheets.reports.missing');
            Route::get('{timesheet}/print', [TimesheetController::class, 'print'])->name('timesheets.print');
        });
        Route::resource('timesheets', TimesheetController::class);

        Route::resource('timesheet-periods', TimesheetPeriodController::class, [
            'parameters' => [
                'timesheet-periods' => 'timesheetPeriod'
            ]
        ])->names('timesheetPeriods');

        Route::put('approval-requests/approve', [ApprovalRequestController::class, 'approve'])->name('approvalRequests.approve');
        Route::put('approval-requests/reject', [ApprovalRequestController::class, 'reject'])->name('approvalRequests.reject');
        Route::resource('approval-requests', ApprovalRequestController::class, [
            'parameters' => [
                'approval-requests' => 'approvalRequest'
            ]
        ])->names('approvalRequests');

        Route::prefix('notifications')->group(function () {
            Route::post('/mark-as-read', [NotificationController::class, 'markNotification'])->name('markNotification');
            Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
        });

        Route::get('notes', NoteController::class)->name('notes');
    });

    Auth::routes();

    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();
});
