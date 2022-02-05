<?php

namespace App\Http\Controllers\API;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\API\BaseController as BaseController;

use Illuminate\Http\Request;
use App\Transformers\SchoolTransformer;
use App\Models\School;

class SchoolController extends BaseController
{
   
    protected $schoolTransformer;
    
    
    function __construct(Request $request, SchoolTransformer $schoolTransformer)
    {       
        $this->schoolTransformer = $schoolTransformer;
    }

    public function index(Request $request)
    {
    	 
        
        $searchString = $request->search;

        if ( $request->limit ) {
                $this->setPagination($request->limit);
        }

        $list = School::where('status',1);
        if($searchString){
            $list->where('name', 'like', '%'.$searchString.'%');
        }
        $list->orderBy('id', 'DESC');
        $pagination = $list->paginate($this->getPagination());

 
        $schools =  $this->schoolTransformer->transformCollection(collect($pagination->items()));
        $paginationObj = [
            "current_page" => $pagination->currentpage(),
            "per_page" => $pagination->perpage(),
            "total_pages" => $pagination->total()
        ];

        return response()->json(array(
            'code'      =>  200,
            'message'   => 'Success',
            'data' => $schools,
            'pagination' => $paginationObj
        ), 200);

       
    }


    public function exam(Request $request)
    {
    	 
        $user =  $this->getAuthenticatedUser();
        if(!$user->exam_assgin)
        {
            return response()->json(array(
                'code'      =>  401,
                'message'   => 'You not assigned to this exam'
            ), 401);
        }

        return response()->json(array(
            'code'      =>  200,
            'message'   => 'You can start your Exam'
        ), 200);

       
    }


    
     

}
