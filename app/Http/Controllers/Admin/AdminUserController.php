<?php

namespace App\Http\Controllers\Admin;

use Abbasudo\Purity\Tests\Models\Post;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;


class AdminUserController extends Controller
{
    public function filter(Request $request)
    {
        $filter = User::query();
        $email = $request->input('email');
        $user_name = $request->input('user_name');
        $phone_number = $request->input('phone_number');
        if ($email) {
            $filter->where('email', $email);
        }
        if ($user_name) {
            $filter->where('user_name', $user_name);
        }
        if ($phone_number) {
            $filter->where('phone_number', $phone_number);
        }


        $filteredUsers = $filter->get();
        return response()->json([
            'filteredUsers' => $filteredUsers,
        ]);
    }

    public function index()
    {
        $users = User::all();
        return response()->json([
            'users' => $users,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $user = User::create([
                'role' => $request->role,
                'user_name' => $request->user_name,
                'password' => $request->password,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'gender' => $request->gender,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'address' => $request->address,
                'post_code' => $request->post_code,
                'country' => $request->country,
                'province' => $request->province,
                'city' => $request->city,
            ]);
            $user->addMediaFromRequest('image')->toMediaCollection();
            return response()->json([
                'status' => true,
                'message' => 'information is correct',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {

        try {
            $user = User::find($id)
                ->updateOrFail([
                    'user_name' => $request->user_name,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'age' => $request->age,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'address' => $request->address,
                    'post_code' => $request->postal_code,
                    'country' => $request->country,
                    'province' => $request->province,
                    'city' => $request->city,
                ]);
            $user = User::find($id);
            $user->addMediaFromRequest('image')->toMediaCollection();
            return response()->json(['user' => $user]);
        } catch (\Exception $e) {
            return \response()->json([
                'status' => false,
                'message' => "{$e->getMessage()}"
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            $user->delete();

            return response()->json([
                'status' => true,
                'message' => 'User deleted successfully',
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'User not found',
            ], 404);

        } catch (\Throwable $th) {
            Log::error($th->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'User deletion process failed',
            ], 500);
        }
    }

    public function accept(Request $request)
    {
        User::where('user_name', $request->user_name)->update([
            'status' => 'تایید شده'
        ]);
        return response()->json([
            'status' => true,
            'message' => 'User status has been successfully verified'
        ], 200);
    }

    public function reject(Request $request)
    {
        $user = User::where('user_name', $request->user_name)->first();

        if ($user && $user->status == 'تایید شده') {
            return response()->json([
                'status' => false,
                'message' => 'You cannot reject a user that has been verified'
            ], 405);
        } else {
            if ($user) {
                $user->update([
                    'status' => 'رد شده'
                ]);
            }
            return response()->json([
                'status' => true,
                'message' => 'User status successfully rejected'
            ], 200);
        }
    }
}
