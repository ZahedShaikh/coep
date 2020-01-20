<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class scholarship_grants extends Model
{
    protected $fillable = [
        'scholarshipGranted', 
        # 'scholarshipName', 'yearOfScholarshipGrant',
    ];
}
