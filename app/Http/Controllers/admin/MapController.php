<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Map;
use App\Contracts\MapInterface;
use App\Http\Requests\MapRequest;
use Illuminate\Support\Facades\Redirect;

class MapController extends Controller
{

    public function __construct(protected MapInterface $interface)
    {
    }

    public function index()
    {
        try {
            $map = $this->interface->get();
            return view('admin.pages.Map.index', ['model' => $map]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function create()
    {
        return view('admin.pages.Map.form');
    }

    public function store(MapRequest $request)
    {
        // dd($request);
        try {
            $this->interface->store($request);
            return redirect()->route('admin.map-index');
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function show(Map $data)
    {
        $lang = config('app.locale');
        return view('admin.pages.Map.form', ['model' => $data, 'lang' => $lang]);
    }
    public function update(MapRequest $request, Map $model)
    {
        try {
            $this->interface->update($request, $model);
            return Redirect::back()->with(["message" => "Data is updated successfully! "]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(Map $model)
    {
        try {
            $this->interface->destroy($model);
            return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}
