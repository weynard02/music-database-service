<?php

namespace App\Http\Module\Artist\Domain\Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Artist {
    /**
     * @param string $name
     * @param string $description
     * @param bool $is_verified
     */

     public function __construct(
        public string $name,
        public string $description,
        public bool $is_verified,
     )
     {}
}
?>