<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApprovalRequest;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('home', [
            'requestsToApprove' => ApprovalRequest::query()
                ->where('approver_id', auth()->id())
                ->where('status', 'pending')
                ->count(),
            'unreadNotifications' => auth()->user()->unreadNotifications->count(),
        ]);
    }
}
