<?php

namespace App\Http\Controllers\Api\Todo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Todo\TodoUpdateCompletedRequest;
use App\Models\Todo;

class UpdateCompletedTodoController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\TodoUpdateCompletedRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(TodoUpdateCompletedRequest $request)
    {
        try {
            $items = Todo::whereIn('id', $request->ids)
                ->update([
                    'completed' => $request->completed
                ]);

            return response([
                'items'      => $items,
                'message'   => 'Successful! Updating the data.',
            ], 200);
        } catch (Exception $e) {
            $status = 400;

            if ($this->isHttpException($e)) $status = $e->getStatusCode();

            return response([
                'message'   => 'Something went wrong.'
            ], $status); 
        }
    }
}
