<?php

// app/Http/Controllers/PackageController.php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public function index()
    {
        $packages = Package::all();
        return view('packages.index', compact('packages'));
    }

    public function create()
    {
        return view('packages.add');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $package =new Package();
        $package->name = $request->name();
        $package->price = $request->price();
        $package->number_of_courses = $request->number_of_courses();
        $packge->commission_percentage = $package->price*0.60;
        $p
        $package = Package::create($request->all());
        return redirect()->back();
        // return redirect()->route('packages.index');
    }

    public function show(Package $package)
    {
        return view('packages.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $package->update($request->all());
        return redirect()->route('packages.index');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('packages.index');
    }
}

