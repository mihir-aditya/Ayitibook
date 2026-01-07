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
        $user = Auth::user();
        $addresses = Address::where( 'user_id', $user->id )->get();
        $wishlist = Wishlist::where( 'user_id', $user->id )->with( 'product' )->get();
        
        return view( 'pages.account', compact( 'user', 'addresses', 'wishlist' ) );
    }

    public function updateProfile( Request $request )
 {
        // return $request;
        $user = Auth::user();

        // Validate input
        $request->validate( [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8',
        ] );

        // Update user details
        $user->first_name = $request->input( 'first_name' );
        $user->last_name = $request->input( 'last_name' );
        $user->email = $request->input( 'email' );
        // Handle password update only if current_password is filled
        if ( $request->filled( 'current_password' ) ) {
            
            if ( !password_verify( $request->current_password, $user->password ) ) {
                return response()->json( [
                    'success' => false,
                    'message' => 'Current password is incorrect.'
                ], 400 );
            }

            if ( $request->filled( 'new_password' ) ) {
                $user->password = bcrypt( $request->new_password );
            } else {
                return response()->json( [
                    'success' => false,
                    'message' => 'Please enter a new password to change your password.'
                ], 400 );
            }
        }

        $user->save();

        return response()->json( [ 'success' => true, 'message' => 'Profile updated successfully.' ] );
    }

    public function addAddress( Request $request )
 { 
        $user = Auth::user();

        // Validate input
        $request->validate( [
            'first_name' => 'required|string|max:255',
            'last_name' => '',
            'phone' => 'required|string|max:15',
            'alternate_phone' => 'nullable|string|max:15',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'address_type' => 'required|in:home,work,other',
            'is_default' => 'sometimes|boolean',
        ] );

        // If is_default is true, unset previous default addresses
        if ( $request->input( 'is_default' ) ) {
            Address::where( 'user_id', $user->id )->update( [ 'is_default' => false ] );
        }
        // Create new address
        $address = new Address();
        $address->user_id = $user->id;
        $address->first_name = $request->input( 'first_name' );
        $address->last_name = $request->input( 'last_name' );
        $address->mobile_number = $request->input( 'phone' );
        $address->alternate_mobile_number = $request->input( 'alternate_phone' );
        $address->address = $request->input( 'address' );
        $address->city = $request->input( 'city' );
        $address->postal_code = $request->input( 'postal_code' );
        $address->address_type = $request->input( 'address_type' );
        $address->is_default = $request->input( 'is_default', false );
        $address->save();

        return response()->json( [ 'success' => true, 'message' => 'Address added successfully.', 'address' => $address ] );
    }

    
}

