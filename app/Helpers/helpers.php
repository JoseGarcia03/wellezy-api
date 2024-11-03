<?php

use Illuminate\Http\Response;

function jsonResponse($data = [], $status = Response::HTTP_OK, $message = 'OK', $errors = [])
{
  return response()->json(compact('data', 'status', 'message', 'errors'), $status);
}
