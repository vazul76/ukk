<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus function jika sudah ada
        DB::unprepared('DROP FUNCTION IF EXISTS format_gender');

        // Buat function konversi gender (tetap sama)
        DB::unprepared("
            CREATE FUNCTION format_gender(kode CHAR(1))
            RETURNS VARCHAR(20)
            DETERMINISTIC
            BEGIN
                IF kode = 'L' THEN
                    RETURN 'Laki-laki';
                ELSEIF kode = 'P' THEN
                    RETURN 'Perempuan';
                ELSE
                    RETURN 'Tidak diketahui';
                END IF;
            END
        ");

        // Hapus trigger jika sudah ada
        DB::unprepared('DROP TRIGGER IF EXISTS after_insert_pkls');

        // Buat trigger baru dengan boolean
        DB::unprepared('
            CREATE TRIGGER after_pkl_insert
            AFTER INSERT ON pkls
            FOR EACH ROW
            BEGIN
                UPDATE siswas 
                SET status_lapor_pkl = TRUE 
                WHERE id = NEW.siswa_id;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER after_pkl_delete
            AFTER DELETE ON pkls
            FOR EACH ROW
            BEGIN
                UPDATE siswas 
                SET status_lapor_pkl = FALSE 
                WHERE id = OLD.siswa_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_insert_pkls');
        DB::unprepared('DROP FUNCTION IF EXISTS format_gender');
    }
};