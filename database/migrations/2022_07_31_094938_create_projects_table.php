<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('code')->nullable(false);
            $table->string('date')->nullable(false);
            $table->string('client')->nullable(false);
            $table->text('description')->nullable(true);
            $table->string('stage')->nullable(false);  // new, design services, material and furniture proposal, tax invoice, inventory list, scope of works
            $table->string('status')->nullable(false);  // Done, Running
            $table->foreignId('project_type');
            $table->string('created_by')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
