<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Contracts\MenuInterface;
use App\Http\Requests\MenuRequest;
use App\Models\Menu;
use Illuminate\Support\Facades\Redirect;
class MenuController extends Controller
{

    public function __construct(protected MenuInterface $interface)
    {

    }

    public function index()
    {
        try {
            $Menu = $this->interface->get();
            return view('admin.pages.Menu.index', ['model' => $Menu]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }

    public function create()
    {
        return view('admin.pages.Menu.form');
    }

    public function store(MenuRequest $request)
    {
        // dd($request);
        try {

            $this->interface->store($request);
            return redirect()->action([MenuController::class, 'index']);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function show(Menu $data)
    {
        $lang = config('app.locale');
        return view('admin.pages.Menu.form', ['model' => $data, 'lang' => $lang]);
    }
    public function update(MenuRequest $request, Menu $model)
    {
        try {
            $this->interface->update($request, $model);
            return Redirect::back()->with(["message" => "Data is updated successfully! "]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
    public function destroy(Menu $model)
    {
        try {
            $this->interface->destroy($model);
            return Redirect::back()->with(["message" => "Data is deleted successfully! "]);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    }
}
