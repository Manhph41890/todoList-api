<?php

use App\Models\titletask;
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
        Schema::table('todolists', function (Blueprint $table) {
            $table->foreignId('titletask_id')->nullable()->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('todolists', function (Blueprint $table) {
            $table->dropForeign(['titletask_id']);
            $table->dropColumn('titletask_id');
        });
    }
};
