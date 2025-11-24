<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'two_factor')) {
                $table->string('two_factor')->default('off');
            }
            if (!Schema::hasColumn('users', 'notify_email')) {
                $table->boolean('notify_email')->default(true);
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'two_factor')) {
                $table->dropColumn('two_factor');
            }
            if (Schema::hasColumn('users', 'notify_email')) {
                $table->dropColumn('notify_email');
            }
        });
    }
};
