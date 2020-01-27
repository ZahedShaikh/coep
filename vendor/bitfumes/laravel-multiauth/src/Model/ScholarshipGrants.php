<?php

namespace Bitfumes\Multiauth\Model;

use Illuminate\Notifications\Notifiable;

class ScholarshipGrants extends Model {

    use Notifiable;

    protected $fillable = [
        'scholarshipGranted', '	scholarshipName', 'yearOfScholarshipGrant',
    ];

}
