<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timeline_id')->unsigned();
            $table->string('email', 250);
            $table->string('verification_code', 250);
            $table->boolean('email_verified');
            $table->string('remember_token', 250);
            $table->string('password', 250);
            $table->float('balance')->default(0);
            $table->date('birthday');
            $table->string('city', 100);
            $table->string('country', 100);
            $table->string('gender');
            $table->boolean('active')->default(1);
            $table->timestamp('last_logged')->nullable();
            $table->string('timezone');
            $table->integer('affiliate_id')->unsigned()->nullable();
            $table->string('language', 15)->nullable();
            //Stripe config begins
            $table->string('stripe_id')->nullable();
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable();
            $table->timestamp('trial_ends_at')->nullable();
            //Stripe config ends
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('subscriptions', function ($table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name');
            $table->string('stripe_id');
            $table->string('stripe_plan');
            $table->integer('quantity');
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('subscriptions');
        Schema::drop('users');
    }
}
