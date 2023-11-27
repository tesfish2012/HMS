<?php

namespace App\Http\Controllers;

use App\Constants\MyModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;

class RoomController extends Controller
{
    protected $_model = MyModel::ROOM;
    protected $_defaultOrder = "updated_at";

    public function __construct()
    {
    }

    public function index()
    {
        return response()->json(
            $this->_model::active()
                ->oldest('name')
                ->get(),
            Response::HTTP_OK
        );
    }

    public function all()
    {
        return response()->json(
            $this->_model::listAll()
                ->with('category')
                ->latest('state')
                ->latest($this->_defaultOrder)
                ->get(),
            Response::HTTP_OK

        );
    }

    public function show($id)
    {
        return response()->json(
            $this->_model::active()
                ->findOrFail($id),
            Response::HTTP_OK
        );
    }

    public function query($att, $val)
    {
        return response()->json(
            $this->_model::active()
                ->where($att, $val)
                ->get(),
            Response::HTTP_OK
        );
    }

    public function store(Request $request)
    {
        if (!$request->all())
            return response()->json('bad_request', Response::HTTP_NOT_FOUND);

        return response()->json(
            $this->_model::storeRoom($request),
            Response::HTTP_CREATED
        );
    }

    public function update($id, Request $request)
    {
        if (!$request->all())
            return response()->json('bad_request', Response::HTTP_NOT_FOUND);

        return response()->json(
            $this->_model::updateRoom($request, $id),
            Response::HTTP_OK
        );
    }

    public function toggleStatus($id)
    {
        return response()->json(
            $this->_model::toggleStatus($id),
            Response::HTTP_OK
        );
    }

    //Trash and delete
    public function trash($id)
    {
        $this->_model::trashRecord($id);
        return response()->json('trashed', Response::HTTP_OK);
    }

    public function restore($id)
    {
        $this->_model::restoreRecord($id);
        return response()->json(
            $this->_model::active()->findOrFail($id),
            Response::HTTP_OK
        );
    }

    public function delete($id)
    {
        $this->_model::listAll()
            ->findOrFail($id)
            ->delete();
        return response()->json('deleted', Response::HTTP_OK);
    }

    public function emptyTrash()
    {
        $this->_model::onlyTrashed()->delete();
        return response()->json('trash_emptied', Response::HTTP_OK);
    }
}