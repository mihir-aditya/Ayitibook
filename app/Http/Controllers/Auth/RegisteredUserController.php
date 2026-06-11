<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\CustomerProfile;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the multi-step registration view.
     */
    public function create(): View
    {
        return view('pages.register', [
            'paymentOptions'    => CustomerProfile::paymentOptions(),
            'deliveryOptions'   => CustomerProfile::deliveryOptions(),
            'frequencyOptions'  => CustomerProfile::frequencyOptions(),
            'orderValueOptions' => CustomerProfile::orderValueOptions(),
            'monthlyOptions'    => CustomerProfile::monthlyEstimateOptions(),
            'interestOptions'   => CustomerProfile::interestOptions(),
            'idTypeOptions'     => CustomerProfile::idTypeOptions(),
        ]);
    }

    /**
     * Handle the registration + profile creation in one request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            /* ── Step 1: Account — matches original fields exactly ── */
            'name'                  => ['required', 'string', 'max:255'],
            'username'              => ['required', 'string', 'max:50', 'unique:' . User::class],
            'email'                 => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone'                 => ['required', 'string', 'max:15', 'unique:' . User::class],
            'password'              => ['required', 'confirmed', Rules\Password::defaults()],

            /* ── Step 2: Address ── */
            'address'               => ['required', 'string', 'max:500'],
            'zone'                  => ['required', 'string', 'max:255'],
            'city'                  => ['required', 'string', 'max:255'],
            'state'                 => ['nullable', 'string', 'max:255'],
            'postal_code'           => ['nullable', 'string', 'max:20'],
            'country'               => ['required', 'string', 'max:100'],

            /* ── Step 3: Preferences ── */
            'preferred_payment'     => ['required', 'in:cod,card,wallet'],
            'delivery_preference'   => ['required', 'in:standard,fast'],
            'purchase_frequency'    => ['required', 'in:daily,weekly,monthly,rarely'],
            'avg_order_value'       => ['required', 'in:<50,50-200,200-500,500+'],
            'buyer_type'            => ['required', 'in:personal,business'],
            'monthly_estimate'      => ['required', 'in:<100,100-500,500-2000,2000+'],
            'interest_categories'   => ['nullable', 'array'],
            'interest_categories.*' => ['string'],

            /* ── Verification ── */
            'id_type'               => ['required', 'in:national_id,passport,drivers_license'],
            'id_document'           => ['required', 'mimes:jpeg,png,jpg,webp,pdf', 'max:4096'],
        ]);

        /* ── Create user — same fields as original controller ── */
        $user = User::create([
            'name'           => $request->name,
            'username'       => $request->username,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'password'       => Hash::make($request->password),
            'status'         => 1,
            'wallet_balance' => 0,
        ]);

        /* ── Upload ID document ── */
        $idPath = null;
        if ($request->hasFile('id_document')) {
            $file     = $request->file('id_document');
            $filename = 'id_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destDir  = public_path('storage/id_documents');

            if (!file_exists($destDir)) {
                mkdir($destDir, 0755, true);
            }

            $file->move($destDir, $filename);
            $idPath = 'id_documents/' . $filename;
        }

        /* ── Create customer profile ── */
        CustomerProfile::create([
            'user_id'             => $user->id,
            'address'             => $request->address,
            'zone'                => $request->zone,
            'city'                => $request->city,
            'state'               => $request->state,
            'postal_code'         => $request->postal_code,
            'country'             => $request->country,
            'preferred_payment'   => $request->preferred_payment,
            'delivery_preference' => $request->delivery_preference,
            'purchase_frequency'  => $request->purchase_frequency,
            'avg_order_value'     => $request->avg_order_value,
            'buyer_type'          => $request->buyer_type,
            'monthly_estimate'    => $request->monthly_estimate,
            'interest_categories' => $request->interest_categories ?? [],
            'id_type'             => $request->id_type,
            'id_document'         => $idPath,
            'verification_status' => 'pending',
            'is_complete'         => true,
        ]);

        event(new Registered($user));

        Auth::login($user);

        /* ── Same redirect as original controller ── */
        return redirect(route('dashboard', absolute: false));
    }
}