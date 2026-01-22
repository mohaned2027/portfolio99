<?php
if (!function_exists('apiResponce')) {
    function apiResponce($status, $message, $data = null)
    {
        $result = [
            'status' => $status,
            'message' => $message
        ];

        if ($data !== null) {
            $result['data'] = $data;
        }

        return response()->json($result, $status);
    }
}