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
        // $package->commission_percentage = $package->price*0.60;

        // dd($request->all());
        $package =new Package();
        $package->name = $request->name;
        $package->price = $request->price;
        $package->number_of_courses = $request->number_of_courses;
        $package->commission_percentage = $request->commission_percentage;
        $package->save();
        return redirect()->route('package.index');
    }

    public function show(Package $package)
    {
        return view('package.show', compact('package'));
    }

    public function edit(Package $package)
    {
        return view('packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $package->update($request->all());
        return redirect()->route('package.index');
    }

    public function destroy(Package $package)
    {
        dd()
        $package->delete();
        
        return redirect()->route('package.index');
    }
}

