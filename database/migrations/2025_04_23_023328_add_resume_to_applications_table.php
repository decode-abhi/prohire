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
        Schema::table('applications', function (Blueprint $table) {
            $table->string('resume')->nullable()->after('cover_letter');
            $table->string('email')->nullable()->after('resume');
            $table->string('status')->nullable()->after('email');
            $table->string('applicant_name')->nullable()->before('cover_letter');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            $table->dropColumn('resume');
        });
    }
};
