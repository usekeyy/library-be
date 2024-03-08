<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $columns = [
            'id'          => 'id', 
            'uuid'          => 'uuid', 
            'name'          => 'name', 
            'genre_name'    => 'genre_name',
            'tahun'         => 'tahun', 
            'penerbit'      => 'penerbit', 
            'deskripsi'     => 'deskripsi', 
            'created_at'    => 'created_at', 
            'updated_at'    => 'updated_at', 
        ];
        $query = Book::Datatable();
        $model = Datatables::of($query)
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

    public function show($uuid)
    {
        $this->isValidUuid($uuid);

        $model = Book::whereUuid($uuid)->firstOrFail();
        
        return response()->json(
            responseSuccess(__("messages.read-success"), $model)
        );
    }

    public function store(Request $request)
    {
        $rules = [
            "name" => "required|unique:books",
            "penerbit" => "required",
            "tahun" => "required|digits:4",
            "deskripsi" => "required",
            "genre_id"  => "required"
        ];

        $this->validate($request, $rules);
        $params = $request->only("name", "penerbit", "tahun", "deskripsi","genre_id");

        try {
            $model = Book::create($params);
        }
        catch(Exception $e) {
            return response()->json(
                responseFail(
                    __("messages.create-fail"),
                    $e->getMessage(),
                    $params
                ),
                500
            );
        }

        return response()->json(
            responseSuccess(__("messages.create-success"), $model), 201
        );
    }

    public function update(Request $request, $uuid)
    {
        $this->isValidUuid($uuid);
        
        $rules = [
            "name" => "required",
            "penerbit" => "required",
            "tahun" => "required|digits:4",
            "deskripsi" => "required",
        ];

        $this->validate($request, $rules);
        $params = $request->only("name", "penerbit", "tahun", "deskripsi");

        $model = Book::whereUuid($uuid)->firstOrFail();

        try {
            $model->fill($params);
            $model->save();
        }
        catch(Exception $e) {
            return response()->json(
                responseFail(
                    __("messages.update-fail"),
                    $e->getMessage(),
                    $params
                ),
                500
            );
        }

        return response()->json(
            responseSuccess(__("messages.update-success"), $model)
        );
    }

    public function destroy($uuid)
    {
        $this->isValidUuid($uuid);
        try {
            $model = Book::whereUuid($uuid)->firstOrFail();
            $model->delete();
        }
        catch(Exception $e) {
            return response()->json(
                responseFail(
                    __("messages.delete-fail"),
                    $e->getMessage(),
                ),
                500
            );
        }

        return response()->json(
            responseSuccess(__("messages.delete-success"), $model)
        );
    }

    public function generateDokumen()
    {
        $book = $query = Book::Datatable()->get();
        
        $data = $book;
        
        return Pdf::loadView("download.book_pdf", compact("data"))->setPaper('A4', 'landscape')->stream("Book PDF.pdf");
    }
}
