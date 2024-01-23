<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class  PermissionSeeder extends Seeder
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
        $factor_delete = Permission::create(['name' => 'factor_delete']);
        $user_seller_accept = Permission::create(['name' => 'user_seller_accept']);
        $user_seller_reject = Permission::create(['name' => 'user_seller_reject']);
        $index_roles = Permission::create(['name' => 'index_roles']);
        $create_roles = Permission::create(['name' => 'create_roles']);
        $update_roles = Permission::create(['name' => 'update_roles']);


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
            $factor_delete,
            $user_seller_accept,
            $user_seller_reject,
            $index_roles,
            $create_roles,
            $update_roles
        ]);
        User::create([
            'user_name' => 'moti',
            'email' => 'mmoein.motamed@gmail.com',
            'password' => Hash::make(123),
            'role' => 'admin'
        ]);
//------------------------------------------------//
        $customer_order_index = Permission::create(['name' => 'customer_order_index']);
        $customer_order_show = Permission::create(['name' => 'customer_order_show']);
        $customer_order_store = Permission::create(['name' => 'customer_order_store']);
        $customer_factor_index = Permission::create(['name' => 'customer_factor_index']);
        $customer_factor_store = Permission::create(['name' => 'customer_factor_store']);
        $customer_factor_destroy = Permission::create(['name' => 'customer_factor_destroy']);
        $customer_factor_status = Permission::create(['name' => 'customer_factor_status']);
        $customer_orders_update = Permission::create(['name' => 'customer_orders_update']);
        $customer_orders_create = Permission::create(['name' => 'customer_orders_create']);

        $customer_role = Role::create(['name' => 'customer']);
        $customer_role->givePermissionTo([
            $customer_order_index,
            $customer_order_show,
            $customer_order_store,
            $customer_factor_index,
            $customer_factor_store,
            $customer_factor_destroy,
            $customer_factor_status,
            $customer_orders_update,
            $customer_orders_create
        ]);
        User::create([
            'user_name' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make(123),
            'role' => 'customer'
        ]);
//---------------------------------------------//
        $seller_product_index = Permission::create(['name' => 'seller_product_index']);
        $seller_product_store = Permission::create(['name' => 'seller_product_store']);
        $seller_product_update = Permission::create(['name' => 'seller_product_update']);
        $seller_product_destroy = Permission::create(['name' => 'seller_product_destroy']);
        $seller_factor_index = Permission::create(['name' => 'seller_factor_index']);

        $seller_role = Role::create(['name' => 'seller']);
        $seller_role->givePermissionTo([
            $seller_product_index,
            $seller_product_store,
            $seller_product_update,
            $seller_product_destroy,
            $seller_factor_index
        ]);
        User::create([
            'user_name' => 'seller',
            'email' => 'seller@gmail.com',
            'password' => Hash::make(123),
            'role' => 'seller'
        ]);
    }
}
