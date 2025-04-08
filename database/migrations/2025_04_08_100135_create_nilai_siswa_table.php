<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('nilai_siswa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');

            // Contoh untuk Agama
            $table->integer('AGM1')->nullable();
            $table->integer('AGM2')->nullable();
            $table->integer('AGM3')->nullable();
            $table->integer('AGM_LUS')->nullable();

            // PKN
            $table->integer('PKN1')->nullable();
            $table->integer('PKN2')->nullable();
            $table->integer('PKN3')->nullable();
            $table->integer('PKN_LUS')->nullable();

            // BI
            $table->integer('BI1')->nullable();
            $table->integer('BI2')->nullable();
            $table->integer('BI3')->nullable();
            $table->integer('BI_LUS')->nullable();

            // Lanjut terus sesuai mapel...
            $table->integer('MTK1')->nullable();
            $table->integer('MTK2')->nullable();
            $table->integer('MTK3')->nullable();
            $table->integer('MTK_LUS')->nullable();

            $table->integer('IPA1')->nullable();
            $table->integer('IPA2')->nullable();
            $table->integer('IPA3')->nullable();
            $table->integer('IPA_LUS')->nullable();

            $table->integer('IPS1')->nullable();
            $table->integer('IPS2')->nullable();
            $table->integer('IPS3')->nullable();
            $table->integer('IPS_LUS')->nullable();

            $table->integer('BING1')->nullable();
            $table->integer('BING2')->nullable();
            $table->integer('BING3')->nullable();
            $table->integer('BING_LUS')->nullable();

            $table->integer('SB1')->nullable();
            $table->integer('SB2')->nullable();
            $table->integer('SB3')->nullable();
            $table->integer('SB_LUS')->nullable();

            $table->integer('PJS1')->nullable();
            $table->integer('PJS2')->nullable();
            $table->integer('PJS3')->nullable();
            $table->integer('PJS_LUS')->nullable();

            $table->integer('INF1')->nullable();
            $table->integer('INF2')->nullable();
            $table->integer('INF3')->nullable();
            $table->integer('INF_LUS')->nullable();

            $table->integer('BLM1')->nullable();
            $table->integer('BLM2')->nullable();
            $table->integer('BLM3')->nullable();
            $table->integer('BLM_LUS')->nullable();

            $table->integer('BMN1')->nullable();
            $table->integer('BMN2')->nullable();
            $table->integer('BMN3')->nullable();
            $table->integer('BMN_LUS')->nullable();

            $table->integer('PAK1')->nullable();
            $table->integer('PAK2')->nullable();
            $table->integer('PAK3')->nullable();
            $table->integer('PAK_LUS')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilai_siswa');
    }
};
