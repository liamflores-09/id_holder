<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $user = Auth::user();

        $documents = Document::where('user_id', $user->id)
            ->active()
            ->with('category')
            ->latest()
            ->get();

        $favoriteDocuments = Document::where('user_id', $user->id)
            ->active()
            ->favorite()
            ->with('category')
            ->latest()
            ->get();

        $recentDocuments = Document::where('user_id', $user->id)
            ->active()
            ->with('category')
            ->latest()
            ->take(5)
            ->get();

        $expiringDocuments = Document::where('user_id', $user->id)
            ->active()
            ->expiringSoon(30)
            ->with('category')
            ->orderBy('expiration_date')
            ->get();

        $expiredDocuments = Document::where('user_id', $user->id)
            ->active()
            ->expired()
            ->with('category')
            ->get();

        $categories = Category::where('user_id', $user->id)
            ->withCount('documents')
            ->orderBy('sort_order')
            ->get();

        $stats = [
            'total' => $documents->count(),
            'favorites' => $favoriteDocuments->count(),
            'expiring_soon' => $expiringDocuments->count(),
            'expired' => $expiredDocuments->count(),
            'categories' => $categories->count(),
        ];

        return view('dashboard', compact(
            'documents',
            'favoriteDocuments',
            'recentDocuments',
            'expiringDocuments',
            'expiredDocuments',
            'categories',
            'stats'
        ));
    }
}