<?php
use Illuminate\Support\Str;
namespace App\Http\Controllers;
use App\Constants\MyModel;
use App\Models\ServicePlan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileUploadController extends Controller
{
    public function  uploadImageEEE(Request $request) {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/public/upload');
           return response()->json(['data'=>"image is uploaded"]);
        }
     }       
      
public function  uploadImage(Request $request) {
        if ($request->hasFile('featured_photo')) {
            $image = $request->file('featured_photo');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = storage_path('/public/upload');
            $image->move($destinationPath, $name);

            
            $model=new ServicePlan;
            $model->id= Str::uuid()->toString();
            $model->service_id=$request->input('service_id') ; 
            $model->name=$request->input('name') ; 
            $model->code=$request->input('code') ; 
            $model->price=$request->input('price') ; 
            $model->description=$request->input('description') ; 
            $model->featured_photo=$name ; 
            $model->save();
      return response()->json($model,Response::HTTP_CREATED  );
        }

        }
    public function update($id){
        $users = AdminLogin::find($id);
        if(Input::hasFile('image_file')){
        $usersImage = public_path("uploads/images/{$users->image_file}"); // get previous image from folder

        if (File::exists($usersImage)) { // unlink or remove previous image from folder
            unlink($usersImage);
        }
        $file = Input::file('image_file');
        $name = time() . '-' . $file->getClientOriginalName();
        $file = $file->move(('uploads/images'), $name);
        $users->image_file= $name;
    }
    $users->save();
    return response()->json($users);
    }
}
