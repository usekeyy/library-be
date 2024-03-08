<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function isValidUuid($uuid)
    {
        if (!is_string($uuid) || (preg_match('/^[a-f\d]{8}(-[a-f\d]{4}){4}[a-f\d]{8}$/i', $uuid) !== 1)) {
            $response = responseFail(__('messages.uuid-fail'));
            $return = response()->json($response, 400, [], JSON_PRETTY_PRINT);
            $return->throwResponse();
        }
    }

    public function searchColumn($key, $value, $request, $query)
    {
        if ($request->get($value)) {

            if ($value === 'created_at' || $value === 'updated_at' || strpos($value, 'date') !== false || strpos($value, 'tanggal') !== false || strpos($value, 'timestamp') !== false || $value === 'year') {
                $arr = explode(';', $request->get($value));
                if (count($arr) == 1) {
                    if (strlen($request->get($value)) <= 4) {
                        $query->where($key, 'ilike', "%{$request->get($value)}%");
                    } else {
                        $query->where(DB::raw("to_char({$key}, 'YYYY-MM-DD' )"), 'ilike', "%{$request->get($value)}%");
                    }
                } else {
                    $query->whereBetween(DB::raw("to_char({$key}, 'YYYY-MM-DD' )"), [$arr[0], $arr[1]]);
                }
            } elseif ($value === 'status') {
                $listStatus = explode(';', $request->get($value));
                $query->whereIn($key, $listStatus);
            } elseif (strpos($request->get($value), ';') !== false && $value != "total_value" && $value != "nilai" && $value != "valuation_price") {
                $values = explode(';', $request->get($value));
                if ($this->isValidRangeDate($values)) {
                    $query->whereBetween($key, $values);
                } else {
                    $query->whereIn($key, $values);
                }
            } elseif (($value == "total_value" || $value == "nilai" || $value == "valuation_price") && (strpos($request->get("total_value"), ';') !== false || strpos($request->get("nilai"), ';') !== false || strpos($request->get("valuation_price"), ';') !== false)) {
                $arr = explode(';', $request->get($value));
                $query->whereBetween($key, [$arr[0], $arr[1]]);
            } else {
                $query->where($key, 'ilike', "%{$request->get($value)}%");
            }
        }
    }
    
    public function filterColumn($columns, $request, $query)
    {
        foreach ($columns as $key => $value) {
            if ($request->has($value)) {
                $this->searchColumn($key, $value, $request, $query);
            }
        }
    }

    public function orderColumn($columns, $request, $query)
    {
        $order = $request->get('dir');
        $field = $request->get('column');
        if ($order == "" || ($order != "desc" && $order != "asc")) {
            $direction = 'asc';
        } else {
            $direction = $order;
        }
        $field = !$field ? @array_values($columns)[0] : $field;
        foreach ($columns as $key => $value) {
            if ($field == $value) {
                $query->orderBy($key, $direction);
            }
        }
    }
}
