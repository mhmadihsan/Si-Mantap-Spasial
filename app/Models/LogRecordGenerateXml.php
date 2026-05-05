<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogRecordGenerateXml extends Model
{
    protected $table = 'record_of_generate_xml';

    protected $fillable = [
        'master_opd_id',
        'file_name',
        'file_path',
    ];

    /**
     * Get the opd that owns the LogRecordGenerateXml
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function opd(): BelongsTo
    {
        return $this->belongsTo(MasterOpd::class, 'master_opd_id', 'id');
    }
}
