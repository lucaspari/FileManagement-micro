<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class File extends Model
{
    use HasFactory;

    protected $table = "files";

    protected $fillable = ["id", "name", "format", "size",];

    public function fileType(): BelongsTo
    {
        return $this->belongsTo(FileType::class);
    }
}
