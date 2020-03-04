<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePostTableAuthorId2UserId extends Migration
{
    /**
     * Run the migrations.
     * 
     * In this migration, author_id column is renamed to user_id column.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function($table){
            $table->renameColumn('author_id', 'user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table('posts', function($table){
            $table->renameColumn('user_id', 'author_id');
        });
    }
}
