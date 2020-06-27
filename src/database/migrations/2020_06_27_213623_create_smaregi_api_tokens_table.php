<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmaregiApiTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('smaregi_api_tokens', function (Blueprint $table) {
            $table->string('id');
            $table->string('contract_id')->comment('スマレジ契約ID');
            $table->string('token')->comment('アプリアクセストークン');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['contract_id', 'token']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('smaregi_api_tokens');
    }
}
