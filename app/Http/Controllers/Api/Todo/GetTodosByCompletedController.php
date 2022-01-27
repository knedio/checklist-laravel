<?php

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;

class GetTodosByCompletedController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        try {
            $items = Todo::where('completed', $request->completed === 'true')
                ->get();
                
            return response([
                'message'   => 'Successful! Getting all the data by completed.',
                'items'     => $items,
            ]);
        } catch (Exception $e) {
            $status = 400;

            if ($this->isHttpException($e)) $status = $e->getStatusCode();

            return response([
                'message'   => 'Something went wrong.'
            ], $status); 
        }
    }
}
