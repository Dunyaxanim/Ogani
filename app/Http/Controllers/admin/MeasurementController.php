<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Contracts\MeasurementInterface;
use App\Http\Requests\MeasurementRequest;
use App\Models\Measurement;
use Illuminate\Support\Facades\Redirect;

class MeasurementController extends Controller
{
    public function __construct(protected MeasurementInterface $interface)
    {
    }

    public function index()
    {
        try {
            $Measurement = $this->interface->get();
            return view('admin.pages.Measurement.index', ['model' => $Measurement]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function create()
    {
        return view('admin.pages.Measurement.form');
    }

    public function store(MeasurementRequest $request)
    {
        try {
            $this->interface->store($request);
            return redirect()->action([MeasurementController::class, 'index']);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function show(Measurement $data)
    {
        $lang = config('app.locale');
        return view('admin.pages.Measurement.form', ['model' => $data, 'lang' => $lang]);
    }
    public function update(MeasurementRequest $request, Measurement $model)
    {
        try {
            $this->interface->update($request, $model);
            return Redirect::back()->with(["message" => "Data is updated successfully! "]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(Measurement $data)
    {
        try {
            $this->interface->destroy($data);
            return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}
