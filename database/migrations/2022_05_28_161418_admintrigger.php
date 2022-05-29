<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER admintrigger AFTER INSERT ON `checkout` FOR EACH ROW
            BEGIN
                INSERT INTO adminnotifications (`id_checkout_review`, `jenis`, `read`, `pesan`)
                VALUES (NEW.id, "transaksi", "belum", null);
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `admintrigger`');
    }
};