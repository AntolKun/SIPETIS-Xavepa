<?php

namespace App\Imports;

use App\Models\Siswa;
use App\Models\NilaiSiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Illuminate\Support\Facades\Log;

class NilaiSiswaImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    public function model(array $row)
    {
        $siswa = Siswa::whereHas('user', function ($query) use ($row) {
            $query->where('nisn', $row['nis']);
        })->first();

        if (!$siswa) {
            Log::warning('NIS tidak ditemukan saat import nilai: ' . ($row['nis'] ?? 'N/A'));
            return null;
        }

        return new NilaiSiswa([
            'siswa_id' => $siswa->id,

            'AGM1' => $row['agm1'] ?? null,
            'AGM2' => $row['agm2'] ?? null,
            'AGM3' => $row['agm3'] ?? null,
            'AGM_LUS' => $row['lus'] ?? null,

            'PKN1' => $row['pkn1'] ?? null,
            'PKN2' => $row['pkn2'] ?? null,
            'PKN3' => $row['pkn3'] ?? null,
            'PKN_LUS' => $row['lus_2'] ?? null,

            'BI1' => $row['bi1'] ?? null,
            'BI2' => $row['bi2'] ?? null,
            'BI3' => $row['bi3'] ?? null,
            'BI_LUS' => $row['lus_3'] ?? null,

            'MTK1' => $row['mtk1'] ?? null,
            'MTK2' => $row['mtk2'] ?? null,
            'MTK3' => $row['mtk3'] ?? null,
            'MTK_LUS' => $row['lus_4'] ?? null,

            'IPA1' => $row['ipa1'] ?? null,
            'IPA2' => $row['ipa2'] ?? null,
            'IPA3' => $row['ipa3'] ?? null,
            'IPA_LUS' => $row['lus_5'] ?? null,

            'IPS1' => $row['ips1'] ?? null,
            'IPS2' => $row['ips2'] ?? null,
            'IPS3' => $row['ips3'] ?? null,
            'IPS_LUS' => $row['lus_6'] ?? null,

            'BING1' => $row['bing1'] ?? null,
            'BING2' => $row['bing2'] ?? null,
            'BING3' => $row['bing3'] ?? null,
            'BING_LUS' => $row['lus_7'] ?? null,

            'SB1' => $row['sb1'] ?? null,
            'SB2' => $row['sb2'] ?? null,
            'SB3' => $row['sb3'] ?? null,
            'SB_LUS' => $row['lus_8'] ?? null,

            'PJS1' => $row['pjs1'] ?? null,
            'PJS2' => $row['pjs2'] ?? null,
            'PJS3' => $row['pjs3'] ?? null,
            'PJS_LUS' => $row['lus_9'] ?? null,

            'INF1' => $row['inf1'] ?? null,
            'INF2' => $row['inf2'] ?? null,
            'INF3' => $row['inf3'] ?? null,
            'INF_LUS' => $row['lus_10'] ?? null,

            'BLM1' => $row['blm1'] ?? null,
            'BLM2' => $row['blm2'] ?? null,
            'BLM3' => $row['blm3'] ?? null,
            'BLM_LUS' => $row['lus_11'] ?? null,

            'BMN1' => $row['bmn1'] ?? null,
            'BMN2' => $row['bmn2'] ?? null,
            'BMN3' => $row['bmn3'] ?? null,
            'BMN_LUS' => $row['lus_12'] ?? null,

            'PAK1' => $row['pak1'] ?? null,
            'PAK2' => $row['pak2'] ?? null,
            'PAK3' => $row['pak3'] ?? null,
            'PAK_LUS' => $row['lus_13'] ?? null,
        ]);
    }

    public function chunkSize(): int
    {
        return 100;
    }

    public function batchSize(): int
    {
        return 100;
    }
}
