<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'orders', function ( Blueprint $table ) {
            $table->id();

            $table->string( 'full_name' );
            $table->string( 'email' );
            $table->float( 'amount' );
            $table->string( 'status' )->nullable();
            $table->string( 'payment_method' )->nullable();
            $table->string( 'sender_number' )->nullable();
            $table->string( 'transaction_id' )->nullable();
            $table->string( 'invoice_id' )->nullable();

            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'orders' );
    }
};
