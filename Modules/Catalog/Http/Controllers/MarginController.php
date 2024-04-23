<?php

namespace Modules\Catalog\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Catalog\Http\Requests\CreateMarginRequest;
use Modules\Catalog\Http\Requests\DeleteMarginRequest;
use Modules\Catalog\Http\Requests\UpdateMarginRequest;
use Modules\Catalog\Models\Margin;

class MarginController extends Controller
{
    public function list()
    {
        $margin = Margin::paginate(15);

        //dd($categories);

        return view('catalog::margin', ['margin' => $margin,]);
    }

    public function create(CreateMarginRequest $request)
    {
        $data = $request->all();
        //dd($data);

        $margin          = new Margin();
        $margin->name    = $data['name'];
        $margin->percent = $data['percent'];
        $margin->save();

        return redirect()->back()->with('success', 'Наценка добавлена!');
    }

    public function show(Margin $margin)
    {
        //
    }

    public function update(UpdateMarginRequest $request)
    {
        $data = $request->all();

        //dd($data);
        $margin = Margin::findOrFail($data['margin_id']);
        if (!$margin) {
            throw new \Exception('Not found');
        }

        if (isset($data['name'])) {
            $margin->name    = $data['name'];
            $margin->percent = $data['percent'];
            $margin->update();

            return redirect()->back()->with('success', 'Наценка обновлена!');
        } else {
            $margin->get()->toArray();

            return $margin;
        }
    }

    public function delete(DeleteMarginRequest $request)
    {
        $data = $request->all();

        $margin = Margin::findOrFail($data['margin_id']);
        $margin->delete();
        //return redirect()->back()->with('success', 'Бренд удален!');
    }
}
