<?php

namespace App\Transformers;

use App\Transformers\BaseTransformer as Transformer;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ProfileTransformer extends Transformer
{
    /**
     * {@inheritdoc}
     */

    
    public function transform($user ) : array
    {    
        return [
            'id'                => (int) $user->id,
            'name'              => $user->name,
            'username'           => $user->username,
            'school'             => $user->school,
            'order'            => $user->order,             
            'status'            => $user->status              
        ];
    }

}









