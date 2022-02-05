<?php

namespace App\Transformers;

use App\Transformers\BaseTransformer as Transformer;
use Illuminate\Support\Facades\DB;
use App\Models\School;

class SchoolTransformer extends Transformer
{
    /**
     * {@inheritdoc}
     */

    
    public function transform($school ) : array
    {    
        return [
            'id'                => (int) $school->id,
            'name'              => $school->name 
                   
        ];
    }

}









