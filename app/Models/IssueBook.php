<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IssueBook extends Model
{
    use HasFactory;

    const CREATED_AT = null;
    const UPDATED_AT = null;
    
    protected $fillable = ['book_id', 'user_id', 'issue_date', 'expected_date', 'return_date', 'fines', 'status'];
}
