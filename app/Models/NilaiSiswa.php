<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiSiswa extends Model
{
  use HasFactory;

  protected $table = 'nilai_siswa';

  protected $fillable = [
    'siswa_id',

    'AGM1',
    'AGM2',
    'AGM3',
    'AGM_LUS',
    'PKN1',
    'PKN2',
    'PKN3',
    'PKN_LUS',
    'BI1',
    'BI2',
    'BI3',
    'BI_LUS',
    'MTK1',
    'MTK2',
    'MTK3',
    'MTK_LUS',
    'IPA1',
    'IPA2',
    'IPA3',
    'IPA_LUS',
    'IPS1',
    'IPS2',
    'IPS3',
    'IPS_LUS',
    'BING1',
    'BING2',
    'BING3',
    'BING_LUS',
    'SB1',
    'SB2',
    'SB3',
    'SB_LUS',
    'PJS1',
    'PJS2',
    'PJS3',
    'PJS_LUS',
    'INF1',
    'INF2',
    'INF3',
    'INF_LUS',
    'BLM1',
    'BLM2',
    'BLM3',
    'BLM_LUS',
    'BMN1',
    'BMN2',
    'BMN3',
    'BMN_LUS',
    'PAK1',
    'PAK2',
    'PAK3',
    'PAK_LUS',
  ];

  public function siswa()
  {
    return $this->belongsTo(Siswa::class);
  }
}
