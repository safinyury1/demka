<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
	use HasFactory;
    protected $guarded=[];

	public function status():BelongsTo{
		return $this->belongsTo(Status::class);
	}

	public function user():BelongsTo{
		return $this->belongsTo(User::class);
	}
}
