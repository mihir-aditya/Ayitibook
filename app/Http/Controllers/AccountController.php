<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Address;
use App\Models\User;
use App\Models\Wishlist;

class AccountController extends Controller
{
    public function myAccount()
    {
        $user      = Auth::user();
        $addresses = Address::where('user_id', $user->id)->get();
        $wishlist  = Wishlist::where('user_id', $user->id)->with('product')->get();

        return view('pages.account', compact('user', 'addresses', 'wishlist'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name'       => 'required|string|max:255',
            'last_name'        => 'required|string|max:255',
            'email'            => 'required|email|unique:users,email,' . $user->id,
            'current_password' => 'nullable|string',
            'new_password'     => 'nullable|string|min:8',
        ]);

        $user->first_name = $request->input('first_name');
        $user->last_name  = $request->input('last_name');
        $user->email      = $request->input('email');

        if ($request->filled('current_password')) {
            if (!password_verify($request->current_password, $user->password)) {
                return response()->json(['success' => false, 'message' => 'Current password is incorrect.'], 400);
            }
            if ($request->filled('new_password')) {
                $user->password = bcrypt($request->new_password);
            } else {
                return response()->json(['success' => false, 'message' => 'Please enter a new password.'], 400);
            }
        }

        $user->save();

        return response()->json(['success' => true, 'message' => 'Profile updated successfully.']);
    }

    public function addAddress(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'first_name'         => 'required|string|max:255',
            'last_name'          => 'nullable|string|max:255',
            'phone'              => 'required|string|max:15',
            'alternate_phone'    => 'nullable|string|max:15',
            'address'            => 'required|string|max:500',
            'city'               => 'required|string|max:100',
            'state'              => 'required|string|max:100',
            'country'            => 'required|string|max:100',
            'postal_code'        => 'required|string|max:20',
            'address_type'       => 'required|string|max:50',
            'is_default'         => 'sometimes|boolean',
            'address_type_other' => 'nullable|string|max:50',
        ]);

        // If is_default, clear all existing defaults for this user
        if ($request->input('is_default')) {
            Address::where('user_id', $user->id)->update(['is_default' => false]);
        }

        // Handle "other" address type with custom label
        $addressType = $request->input('address_type');
        if ($addressType === 'other' && $request->filled('address_type_other')) {
            $addressType = $request->input('address_type_other');
        }

        // FIX: use Address::max('address_id') + 1 safely, and save state + country
        $address = new Address();
        $address->address_id             = (Address::max('address_id') ?? 0) + 1;
        $address->user_id                = $user->id;
        $address->first_name             = $request->input('first_name');
        $address->last_name              = $request->input('last_name');
        $address->phone                  = $request->input('phone');
        $address->alternate_phone_number = $request->input('alternate_phone');
        $address->address                = $request->input('address');
        $address->city                   = $request->input('city');
        $address->state                  = $request->input('state');    // FIX: was missing
        $address->country                = $request->input('country');  // FIX: was missing
        $address->pincode                = $request->input('postal_code');
        $address->address_type           = $addressType;
        $address->is_default             = $request->boolean('is_default');
        $address->save();

        // Return JSON for AJAX calls (fetch from checkout/address book pages)
        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Address added successfully.',
                'address' => $address,
            ]);
        }

        return redirect()->route('profile.page', ['page' => 'address'])
            ->with('success', 'Address added successfully.');
    }

    public function setDefaultAddress(Request $request, $id)
    {
        $user    = Auth::user();
        $address = Address::where('user_id', $user->id)->findOrFail($id);

        Address::where('user_id', $user->id)->update(['is_default' => false]);
        $address->is_default = true;
        $address->save();

        return redirect()->route('profile.page', ['page' => 'address'])
            ->with('success', 'Default address updated.');
    }

    public function deleteAddress(Request $request, $id)
    {
        $user    = Auth::user();
        $address = Address::where('user_id', $user->id)->findOrFail($id);
        $address->delete();

        return redirect()->route('profile.page', ['page' => 'address'])
            ->with('success', 'Address deleted successfully.');
    }
}