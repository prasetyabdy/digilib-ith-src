<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Literatur extends Model
{
    use HasFactory, Searchable;
    protected $guarded = ['id'];
    public $with = ['user', 'kontributor'];

    public $table = 'literatur';
    public function user() // author
    {
        return $this->belongsTo(User::class);
    }

    public function kontributor()
    {
        return $this->hasMany(LiteraturKontributor::class);
    }
    public function jenis()
    {
        return $this->belongsTo(Jenis::class);
    }

    public function file()
    {
        return $this->hasOne(FileLiteratur::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'judul' => '',
            'abstrak' => '',
            'jenis_id' => '',
        ];
    }

    public function shouldBeSearchable(): bool
    {
        return $this->status === 'diterima';
    }
}
