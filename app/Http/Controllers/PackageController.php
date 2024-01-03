<?php

// app/Http/Controllers/PackageController.php

namespace App\Http\Controllers;


use App\Models\Tree;
use App\Models\User;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // dd($package);
        $package->delete();
        
        return redirect()->route('package.index');
    }
    public function card(){
        $packages = Package::all();
        return view('packages.card', compact('packages'));
    }
    public function buy(Request $req)
    {
        $package = Package::findOrFail($req->package_id);
        $package_id = $package->id;
    
          
          return redirect()->route('make.payment', [
            'packageId' => $package_id,
            'accountTitle' => 'Digital Ocean',
            'accountNumber' => '458-9658-5874', // Replace with actual account number
        ]);
            


    }

    public function link(){
        return view('referlink');
    }
}

