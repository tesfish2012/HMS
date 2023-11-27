<?php

namespace App\Http\Controllers;
use App\Constants\MyModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ServicePlan;
use Illuminate\Support\Str;
use App\Services\FileService;

use App\Http\Controllers\Controller;
// use App\
class ServicePlanController extends Controller
{
    protected $_model = MyModel::SERVICE_PLAN;
    protected $_defaultOrder = "updated_at";

    public function __construct()
    {
    }
    public function index()
    {
        return response()->json(
            $this->_model::active()
                ->oldest()
                ->get(),
            Response::HTTP_OK
        );
    }

    public function all()
    {
        return response()->json(
            $this->_model::listAll()
                ->with('rooms')//fo practicing
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
            $this->_model::storeServicePlan($request),
            Response::HTTP_CREATED
        );
    }

    public function update($id, Request $request)
    {
        if (!$request->all())
            return response()->json('bad_request', Response::HTTP_NOT_FOUND);

        return response()->json(
            $this->_model::updateServicePlan($request, $id),
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




    //Trash and delete #done 100%
    public function trash($id)
    {
        $this->_model::trashRecord($id);
        return response()->json('trashed', Response::HTTP_OK);
    }

    public function restore($id)
    {
        $this->_model::withTrashed()->find($id)->restore();
         return response()->json('restored',Response::HTTP_OK);
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


    public function getImage(Request $request) {
        $uri='/hms/apis/v1/service_plan/photos/';
        $model=$this->_model::all();
            return response()->json((new FileService)->getFileUrl($model, $uri),
            Response::HTTP_CREATED
        );
     
   }

   public function downloadImage(Request $request) {
    $path='public/upload/';
    $model=$this->_model::all();
    foreach($model as $models){
        $fileName=$models->featured_photo;
         return response()->json((new FileService)->downloadFile($path,  $fileName),
        Response::HTTP_CREATED );
    }
    
   
 
}
}