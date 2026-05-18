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
        Schema::table('doctors', function (Blueprint $table) {
            $table->foreignId('specialization_id')
                ->nullable()
                ->after('photo')
                ->constrained()
                ->nullOnDelete();

            $table->foreignId('polyclinic_id')
                ->nullable()
                ->after('specialization_id')
                ->constrained()
                ->nullOnDelete();
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn([
                'specialist',
                'clinic',
                'registration_number',
                'practice_license_number',
                'phone',
                'bio',
                'is_active',
                'sort_order',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->string('specialist')->after('slug');
            $table->string('clinic')->nullable()->after('specialist');
            $table->string('registration_number')->nullable()->after('photo');
            $table->string('practice_license_number')->nullable()->after('registration_number');
            $table->string('phone')->nullable()->after('practice_license_number');
            $table->text('bio')->nullable()->after('phone');
            $table->boolean('is_active')->default(true)->after('bio');
            $table->unsignedInteger('sort_order')->default(0)->after('is_active');
        });

        Schema::table('doctors', function (Blueprint $table) {
            $table->dropConstrainedForeignId('specialization_id');
            $table->dropConstrainedForeignId('polyclinic_id');
        });
    }
};
