<?php

namespace App\Http\Controllers\API;
 
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Response;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;



class BaseController extends Controller
{

    use ValidatesRequests ;

    /**
     * The default pagination size.
     *
     * @var int The pagination size
     */
    protected $pagination = 10;
    /**
     * The maximum pagination size.
     *
     * @var int The pagination size
     */
    protected $maxLimit = 50;
    /**
     * The minimum pagination size.
     *
     * @var int The pagination size
     */
    protected $minLimit = 1;

    /**
     * Getter for the pagination.
     *
     * @return int The pagination size
     */
    public function getPagination()
    {
        return $this->pagination;
    }

    /**
     * Sets and checks the pagination.
     *
     * @param int $pagination The given pagination
     */
    public function setPagination($pagination)
    {
        $this->pagination = (int) $this->checkPagination($pagination);
    }

    /**
     * Checks the pagination.
     *
     * @param * $pagination The pagination
     *
     * @return int The corrected pagination
     */
    private function checkPagination($pagination)
    {
        // Pagination should be numeric
        if (!is_numeric($pagination)) {
            return $this->pagination;
        }
        // Pagination should not be less than the minimum limitation
        if ($pagination < $this->minLimit) {
            return $this->minLimit;
        }
        // Pagination should not be greater than the maximum limitation
        if ($pagination > $this->maxLimit) {
            return $this->maxLimit;
        }
        // If the pagination is between the min limit and the max limit, return the pagination
        if (!($pagination > $this->maxLimit) && !($pagination < $this->minLimit)) {
            return $pagination;
        }

        // If all fails, return the default pagination
        return $this->pagination;
    }



    public function getAuthenticatedUser()
    {
      try {

        if (! $user = JWTAuth::parseToken()->authenticate()) {
            
            return response()->json(['user_not_found'], 404);

        }

      } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

        $this->saveToLog('token_expired', $e->getStatusCode());
        return response()->json(['token_invalid'], $e->getStatusCode());


      } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        $this->saveToLog('token_invalid', $e->getStatusCode());
        return response()->json(['token_invalid'], $e->getStatusCode());

      } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

        $this->saveToLog('token_absent', $e->getStatusCode());
        return response()->json(['token_invalid'], $e->getStatusCode());


      }


      return $user;
    }
 

}
