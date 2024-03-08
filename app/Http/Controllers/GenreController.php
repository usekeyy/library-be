<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class GenreController extends Controller
{
    public function index(Request $request)
    {
        $columns = [
            'id'            => 'id', 
            'uuid'          => 'uuid', 
            'name'          => 'name', 
            'genre'         => 'genre',
            'created_at'    => 'created_at', 
            'updated_at'    => 'updated_at', 
        ];
        $query = Genre::get();
        $model = DataTables::of($query)
            ->addIndexColumn() 
            ->filter(function ($query) use ($request, $columns) {
                $this->filterColumn($columns, $request, $query);
            })
            ->order(function ($query) use ($request, $columns) {
                $this->orderColumn($columns, $request, $query);
            })
            ->escapeColumns([])
            ->make(true)->getData(true);
        $response = responseDatatableSuccess(__('messages.read-success'), $model);
        return response()->json($response, 200);
    }
}
