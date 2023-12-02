<?php

namespace App\Modules\Report\Core\Domain\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ReportClass
{
    
    /**
     * @param string $subject
     * @param string $description
     * @param int $user_id
     */
    public function __construct ( 
        public string $subject,
        public string $description,
        public int $user_id,
    ){}

}
