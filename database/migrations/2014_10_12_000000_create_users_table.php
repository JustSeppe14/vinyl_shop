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
            $table->string('name');
            $table->string('email')->unique();
            $table->boolean('active')->default(true);
            $table->boolean('admin')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        //Insert some users
        DB::table('users')->insert(
            [
                [
                    'name'=>'Seppe Van Campfort',
                    'email'=>'r0929446@student.thomasmore.be',
                    'admin'=>true,
                    'password'=>Hash::make('admin1234'),
                    'created_at'=>now(),
                    'email_verified_at'=>now()
                ],
                [
                    'name'=>'Jane Doe',
                    'email'=>'jane.doe@example.com',
                    'admin'=>false,
                    'password'=>Hash::make('user1234'),
                    'created_at'=>now(),
                    'email_verified_at'=>now()
                ]
            ]
        );

        for ($i = 0; $i <=40; $i++){
            $active = ($i +1)%6!==0;
            DB::table('users')->insert(
                [
                    'name'=>"ITF User $i",
                    'email'=>"itf_user_$i@mailinator.com",
                    'password'=>Hash::make("itfuser$i"),
                    'active'=>$active,
                    'created_at'=>now(),
                    'email_verified_at'=>now()
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
