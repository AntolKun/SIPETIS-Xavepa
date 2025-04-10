<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('nilai_siswa', function (Blueprint $table) {
            $columns = [
                'AGM',
                'PKN',
                'BI',
                'MTK',
                'IPA',
                'IPS',
                'BING',
                'SB',
                'PJS',
                'INF',
                'BLM',
                'BMN',
                'PAK'
            ];

            foreach ($columns as $col) {
                for ($i = 1; $i <= 3; $i++) {
                    $table->decimal("{$col}{$i}", 5, 2)->nullable()->change();
                }
                $table->decimal("{$col}_LUS", 5, 2)->nullable()->change();
            }
        });
    }

    public function down(): void
    {
        Schema::table('nilai_siswa', function (Blueprint $table) {
            $columns = [
                'AGM',
                'PKN',
                'BI',
                'MTK',
                'IPA',
                'IPS',
                'BING',
                'SB',
                'PJS',
                'INF',
                'BLM',
                'BMN',
                'PAK'
            ];

            foreach ($columns as $col) {
                for ($i = 1; $i <= 3; $i++) {
                    $table->integer("{$col}{$i}")->nullable()->change();
                }
                $table->integer("{$col}_LUS")->nullable()->change();
            }
        });
    }
};
