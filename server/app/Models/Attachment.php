<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'attachment_public_id',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public static function createAttachment($data)
    {
        return self::create($data);
    }

    public function deleteAttachment()
    {
        return $this->delete();
    }
}
