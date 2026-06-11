<?php
// app/Http/Controllers/Admin/AffiliateClickController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AffiliateClick;
use Illuminate\Http\Request;

class AffiliateClickController extends Controller
{
    /**
     * Display a listing of affiliate clicks.
     */
    public function index(Request $request)
    {
        $query = AffiliateClick::with(['affiliate.user', 'affiliateLink.product', 'customer']);

        // Filter by affiliate
        if ($request->has('affiliate_id') && !empty($request->affiliate_id)) {
            $query->where('affiliate_id', $request->affiliate_id);
        }

        // Filter by status
        if ($request->has('status') && !empty($request->status)) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->has('from_date') && !empty($request->from_date)) {
            $query->whereDate('click_timestamp', '>=', $request->from_date);
        }
        if ($request->has('to_date') && !empty($request->to_date)) {
            $query->whereDate('click_timestamp', '<=', $request->to_date);
        }

        $clicks = $query->orderBy('click_timestamp', 'desc')->paginate(20);

        return view('admin.affiliate-clicks.index', compact('clicks'));
    }

    /**
     * Display the specified click.
     */
    public function show(AffiliateClick $affiliateClick)
    {
        $affiliateClick->load(['affiliate.user', 'affiliateLink.product', 'customer']);

        return view('admin.affiliate-clicks.show', compact('affiliateClick'));
    }
}