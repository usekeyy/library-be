<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ["name", "description", "permission_id", "url", "order_no", "icon", "parent_id", "status", "created_by", "updated_by"];

}
