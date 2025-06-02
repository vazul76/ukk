<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared(
            'DROP FUNCTION IF EXISTS format_gender'
        );
        DB::unprepared('
            CREATE TRIGGER after_pkl_created
            AFTER INSERT ON pkls
            FOR EACH ROW
            BEGIN
                UPDATE siswas
                SET status_pkl = "Aktif"
                WHERE id = NEW.siswa_id;
            END
        ');

        DB::unprepared('
            CREATE FUNCTION format_gender(gender CHAR)
            RETURNS VARCHAR(20)
            DETERMINISTIC
            BEGIN
                IF gender = "L" THEN
                    RETURN "Laki-Laki";
                ELSE
                    RETURN "Perempuan";
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop trigger and function
        DB::unprepared('DROP TRIGGER IF EXISTS after_pkl_created');
        DB::unprepared('DROP FUNCTION IF EXISTS format_gender');
    }
};