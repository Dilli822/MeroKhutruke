<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Expense extends Model
{
    use HasFactory;

    /**
     * Get all of the  for the Expense
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

     /**
      * Get all of the comments for the Expense
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasMany
      */
     public function ecategory(): HasMany
     {
         return $this->hasMany(Ecategory::class);
     }
}
