<?php

namespace App\Http\Controllers;

use App\Model\Catering;
use App\Model\Facility;
use App\Model\FungsiRuang;
use App\Model\PageTitle;
use App\Model\PriceUnit;
use Illuminate\Http\Request;

class DatabaseConfiguration extends Controller
{
    //


    public function getSelectList(Request $request)
    {
        $post = (object)$request->all();
        $response = getDefaultResponse();
        if ($request->is('api/*')) {

            if(isset($post->table)){
                switch($post->table){
                    case FungsiRuang::getTableName():
                        class_alias('App\Model\FungsiRuang','CurrentModel');

                        break;

                    case Facility::getTableName():
                        class_alias('App\Model\Facility','CurrentModel');

                        break;

                    case Catering::getTableName():
                        class_alias('App\Model\Catering','CurrentModel');

                        break;

                    case PriceUnit::getTableName():
                        class_alias('App\Model\PriceUnit','CurrentModel');

                        break;
                }

            }

//            return response()->json($post);
            if(isset($post->cmd) && $post->cmd == 'delete'){
//                $isSuccess = $this->deleteList($post->table,$post->id);
                $isSuccess = \CurrentModel::find($post->id)->delete();
                $response->message = $isSuccess ? "Select list deleted successfully" : "Cannot Delete Select list";
                $response->isSuccess = $isSuccess;
                return response()->json($response);
            }

            if(isset($post->cmd) && $post->cmd == 'add') {
                $tes = new \CurrentModel((array)$post);
                $tes->save();
                $response->message = "Data berhasil dimasukan";
                return response()->json($response);

            }


                $selectList = [
                [
                    "key" => "Fungsi Ruang",
                    "value" => FungsiRuang::all(),
                    'table' => FungsiRuang::getTableName(),
                ],[
                    "key" => "Fasilitas",
                    "value" => Facility::all(),
                    'table' => Facility::getTableName(),
                ],[
                    "key" => "Katering",
                    "value" => Catering::all(),
                    'table' => Catering::getTableName(),
                ],[
                    "key" => "Harga Satuan Ruang",
                    "value" => PriceUnit::all(),
                    'table' => PriceUnit::getTableName(),
                ],

            ];
            $response->data->selectList = $selectList;
            $response->message = "List selection fetched";
            return response()->json($response)->setStatusCode(200);
        }
    }

    private function deleteList($table,$id){


        $model = null;
        switch($table){
            case "fungsiRuang":
                FungsiRuang::find($id)->delete();
                return true;
            case "facility":
                Facility::find($id)->delete();

                return true;
            case "catering":
                Catering::find($id)->delete();
                return true;
            case "priceUnit":
                PriceUnit::find($id)->delete();
                return true;
        }


        return false;
    }

    public function anyPageTitle(Request $request){
        $post = (object) $request->all();
        $response = getDefaultResponse();

        if($request->is('api/*')) {

            //region editPageTitle
            if(isset($post->cmd) && $post->cmd='edit') {
                $pageTitle = PageTitle::find($post->id);

                if (!$pageTitle) {
                    $response->isSuccess = false;
                    $response->message = "Id not found";
                    return response()->json($response);
                }
                $pageTitle->update((array)$post);
                $response->message = "Title page updated";
                return response()->json($response);
            }
            //endregion




            $response->data->filter = (object)[];
            $response->data->filter->cmbSearchBy = [
              [
                  'key'=>"Page Name",
                  'value'=>"page",
              ]
            ];

            $pageTitle = PageTitle::where('id','!=' , -1);
            if(isset($post->cmbSearchBy) && $post->cmbSearchBy != ""){
                $pageTitle = $pageTitle->where($post->cmbSearchBy,'like',"%$post->searchValue%");
            }
            $pageTitle = $pageTitle->get();
            $response->data->page = $pageTitle;
            $response->message = "Page fetched";
            return response()->json($response);


        }

    }

}
