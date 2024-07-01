<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Spareparts;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Auth;

class LogSparepartsController extends Controller
{
    public function index(Request $request)
    {
        // Initialize the query with the necessary relationships
        $query = Activity::with('causer', 'subject');

        // Apply search filter if the search parameter is present
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%$search%")
                    ->orWhereHas('causer', function ($q) use ($search) {
                        $q->where('name', 'like', "%$search%");
                    });
            });
        }

        // Get the results
        $activity = $query->get();

        // Return the results as a JSON response
        return response()->json($activity);
    }
}
