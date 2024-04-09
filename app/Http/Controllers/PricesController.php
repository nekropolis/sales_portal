<?php

namespace App\Http\Controllers;

use App\Models\Prices;
use App\Models\PricesUploaded;
use App\Models\Sellers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Shuchkin\SimpleXLSX;

class PricesController extends Controller
{
    public function listPrices()
    {
        $collection = PricesUploaded::query()
            ->with('seller')
            ->get();

        $result = $collection->map(function ($room) {
            $data                 = $room->makeHidden('seller')->toArray();
            $data ['seller_name'] = $room->seller->name;

            return $data;
        });

        $sellers = Sellers::all();

        return view('pages.upload_prices', [
            'prices'  => $result,
            'sellers' => $sellers,
        ]);
    }

    public function updateUploadPrice(Request $request)
    {
        $data = $request->all();

        //dd($data);

        $price = PricesUploaded::find($data['price_id']);
        if (!$price) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $price->name               = $data['name'];
            $price->sheet_name         = $data['sheet_name'];
            $price->numeration_started = $data['numeration_started'];
            $price->model_name         = $data['model_name'];
            $price->price_name         = $data['price_name'];
            $price->qty_name           = $data['qty_name'];
            $price->additional         = $data['additional'];
            $price->save();

            return redirect()->back();
        } else {
            $price->get()->toArray();

            return $price;
        }
    }

    public function deleteUploadPrice(Request $request)
    {
        $data = $request->all();

        PricesUploaded::where('id', $data['price_id'])->delete();

        return response()->json(["success" => "Прайс удален!"]);
    }

    public function fileUpload(Request $request)
    {
        /*        $req->validate([
                    'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
                ]);*/
        $fileModel = new PricesUploaded();
        if ($request->file()) {
            $fileName             = $request->file->getClientOriginalName();
            $filePath             = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->seller_id = $request->seller_name;
            $fileModel->orig_name = $fileName;
            $fileModel->name      = $request->name;
            $fileModel->file_path = '/storage/'.$filePath;
            $fileModel->save();

            return back()
                ->with('success', 'File has been uploaded.')
                ->with('file', $fileName);
        }
    }

    public function fileUpdateUpload(Request $request)
    {
        /*        $req->validate([
                    'file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048'
                ]);*/
        //dd($request['price_id'], $request->file());

        $priceUpload = PricesUploaded::find($request['price_id']);
        $timestamp   = now();

        if ($priceUpload) {
            if ($request->file()) {
                $fileName                = $request->file->getClientOriginalName();
                $filePath                = $request->file('file')->storeAs('uploads', $fileName, 'public');
                $priceUpload->file_path  = '/storage/'.$filePath;
                $priceUpload->updated_at = $timestamp;
                $priceUpload->update();

                return back()
                    ->with('success', 'File has been update.')
                    ->with('file', $fileName);
            }
        }
    }

    public function parsePrice(Request $request)
    {
        $data = $request->all();

        //dd($data['price_id']);

        $id                 = $data['price_id'];
        $orig_name          = PricesUploaded::where("id", $data['price_id'])->value("orig_name");
        $model_name         = PricesUploaded::where("id", $data['price_id'])->value("model_name");
        $price_name         = PricesUploaded::where("id", $data['price_id'])->value("price_name");
        $qty_name           = PricesUploaded::where("id", $data['price_id'])->value("qty_name");
        $additional         = PricesUploaded::where("id", $data['price_id'])->value("additional");
        $numeration_started = PricesUploaded::where("id", $data['price_id'])->value("numeration_started");
        $data               = Storage::disk('local')->get('public/uploads/'.$orig_name);


        $xlsx = SimpleXLSX::parseData($data);

        //print_r( $xlsx->rows() );

        $header_values = $rows = [];
        if ($xlsx->success()) {
            $validate_model_name = false;
            $validate_price_name = false;
            $validate_qty_name   = false;
            $validate_additional = false;

            foreach (array_slice($xlsx->rows(), $numeration_started - 1) as $r) {
                if (in_array($model_name, $r)) {
                    $validate_model_name = true;
                }
                if (in_array($price_name, $r)) {
                    $validate_price_name = true;
                }
                if (in_array($qty_name, $r)) {
                    $validate_qty_name = true;
                }
                if (in_array($additional, $r)) {
                    $validate_additional = true;
                }
            }

            if ($validate_model_name && $validate_price_name && $validate_qty_name && $validate_additional) {
                foreach (array_slice($xlsx->rows(), $numeration_started - 1) as $k => $r) {
                    if ($k === 0) {
                        $header_values = $r;
                        continue;
                    }
                    $rows[] = array_combine($header_values, $r);
                }
            }
        }

        $existingNames = [];

        foreach ($rows as $item) {
            //dd($rows, $item);
            $existingNames[] = $item[$model_name];
            Prices::query()->updateOrCreate([
                'model'             => $item[$model_name],
                'price_uploaded_id' => $id,
            ],
                [
                    'price'      => $item[$price_name],
                    'quantity'   => $item[$qty_name],
                    'additional' => $item[$additional],
                ]);
        }

        Prices::where(['price_uploaded_id' => $id])->whereNotIn('model', $existingNames)->update(['quantity' => 0]);
    }

    public function getPrice($id)
    {
        //dd($id);

        $price     = Prices::where('price_uploaded_id', $id)->get()->toArray();

        $collection = PricesUploaded::where('id', $id)
            ->with('seller')
            ->get();

        $price_uploaded = $collection->map(function ($price_upload) {
            $data['id']              = $price_upload['id'];
            $data['price_name']      = $price_upload['name'];
            $data['orig_price_name'] = $price_upload['orig_name'];
            $data['status']          = $price_upload['status'];
            $data['seller_name']     = $price_upload->seller->name;

            return $data;
        });

        return view('pages.price', [
            'price'          => $price,
            'price_uploaded' => $price_uploaded[0],
        ]);
    }
}