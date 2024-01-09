<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;


class AdminUserController extends Controller
{
    public function filter() {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                AllowedFilter::callback('AgeMin', function($query, $value){
                    $query->where('age', '>=', (int)$value);
                })->ignore(null),
                AllowedFilter::callback('AgeMax', function($query, $value){
                    $query->where('age', '<=', (int)$value);
                })->ignore(null),
                AllowedFilter::exact('email')->ignore(null),
                AllowedFilter::exact('user_name')->ignore(null),
                AllowedFilter::exact('first_name')->ignore(null),
                AllowedFilter::exact('last_name')->ignore(null),
                AllowedFilter::exact('gender')->ignore(null),
                AllowedFilter::exact('phone_number')->ignore(null),
                AllowedFilter::exact('post_code')->ignore(null),
            ])
            ->get();
        return response()->json($users);

    }
    public function index() {
        $users = User::all();
        return response()->json([
            'users' => $users,
        ]);
    }

    public function store(Request $request) {
        try {
            User::create([
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
            return response()->json([
                'status' => true,
                'message' => 'information is correct',
            ]);
        }catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id) {
        try {
            $user =  User::find($id)
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
            return response()->json(['user' => $user]);
        }catch (\Exception $e) {
            return \response()->json([
                'status' => false,
                'message' => "{$e->getMessage()}"
            ]);
        }
    }

    public function destroy($id) {
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
}
