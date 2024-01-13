<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user_index = Permission::create(['name' => 'user_index']);
        $user_filter = Permission::create(['name' => 'user_filter']);
        $user_store = Permission::create(['name' => 'user_store']);
        $user_update = Permission::create(['name' => 'user_update']);
        $user_destroy = Permission::create(['name' => 'user_destroy']);
        $product_index = Permission::create(['name' => 'product_index']);
        $product_filter = Permission::create(['name' => 'product_filter']);
        $product_store = Permission::create(['name' => 'product_store']);
        $product_update = Permission::create(['name' => 'product_update']);
        $product_destroy = Permission::create(['name' => 'product_destroy']);
        $order_index = Permission::create(['name' => 'order_index']);
        $order_filter = Permission::create(['name' => 'order_filter']);
        $order_store = Permission::create(['name' => 'order_store']);
        $order_update = Permission::create(['name' => 'order_update']);
        $order_destroy = Permission::create(['name' => 'order_destroy']);
        $factor_index = Permission::create(['name' => 'factor_index']);
        $factor_store = Permission::create(['name' => 'factor_store']);

        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo([
            $user_destroy,
            $user_store,
            $user_update,
            $user_filter,
            $user_index,
            $product_index,
            $product_filter,
            $product_store,
            $product_update,
            $product_destroy,
            $order_index,
            $order_filter,
            $order_store,
            $order_update,
            $order_destroy,
            $factor_index,
            $factor_store,
        ]);

        $admin = User::create([
            'user_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        $admin->assignRole($admin_role);
//------------------------------------------------//
        $cus_order_index = Permission::create(['name' => 'cus_order_index']);
        $cus_order_show = Permission::create(['name' => 'cus_order_show']);
        $cus_order_store = Permission::create(['name' => 'cus_order_store']);
        $cus_factor_index = Permission::create(['name' => 'cus_factor_index']);
        $cus_factor_store = Permission::create(['name' => 'cus_factor_store']);
        $cus_factor_destroy = Permission::create(['name' => 'cus_factor_destroy']);
        $cus_factor_status = Permission::create(['name' => 'cus_factor_status']);
        $customer = User::create([
            'user_name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'customer'
        ]);

        $customer_role = Role::create(['name' => 'customer']);
        $customer->assignRole($customer_role);
        $customer->givePermissionTo([
            $cus_order_index,
            $cus_order_show,
            $cus_order_store,
            $cus_factor_index,
            $cus_factor_store,
            $cus_factor_destroy,
            $cus_factor_status
        ]);
//---------------------------------------------//
        $seller = User::create([
            'user_name' => 'Seller',
            'email' => 'seller@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'seller'
        ]);
    }
}
