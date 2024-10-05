<?php

if (!function_exists('retRes')) {
    // Helper method for consistent response formatting
    function retRes($message, $result = null, $status = 2000)
    {
        return response()->json([
            'message' => $message,
            'result' => $result,
            'status' => $status
        ]);
    }
}
