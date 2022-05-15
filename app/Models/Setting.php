<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['lib_name', 'lib_address', 'lib_contact_number', 'lib_total_book_issue_day', 'lib_one_day_fine', 'lib_issue_total_book_per_user', 'lib_currency', 'lib_timezone', 'status'];
}
