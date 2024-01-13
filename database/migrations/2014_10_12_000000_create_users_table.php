<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('age')->nullable();
            $table->enum('gender',['male','female','other','do_not_want_to_say'])->nullable();
            $table->string('email')->unique();
            $table->bigInteger('phone_number')->nullable();
            $table->string('password');
            $table->string('address')->nullable();
            $table->integer('post_code')->nullable();
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->enum('role',['admin' , 'customer' , 'seller'])->nullable();
            $table->enum('status',['رد شده','در انتظار تایید','تایید شده'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
