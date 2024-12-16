<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Endroid\QrCode\Builder\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class ClassController extends Controller
{
    public function index()
    {
        $classes = ClassModel::all();
        return view('classes.index', compact('classes'));
    }

    public function create()
    {
        return view('classes/create');
    }

    public function store(Request $request)
    {
        // get params
        $class_name = $request->class_name;
        $latitude = doubleval($request->latitude);
        $longitude = doubleval($request->longitude);

        $class = ClassModel::create([
            'class_name' => $class_name,
            'latitude' => $latitude,
            'longitude' => $longitude
        ]);

        // failed user add
        if (!$class) return redirect()->route('class.create')->with('msg', 'class insert failed!');

        // Redirect dengan pesan sukses
        return redirect()->route('class.index')->with('msg', 'Class created successfully!');
    }

    public function show($id)
    {
        $class = ClassModel::find($id);
        $qrCode = QrCode::size(200)->generate(url("users/absences/$class->class_name"));

        return view('classes.show', compact('class', 'qrCode'));
    }

    public function edit($id)
    {
        $class = ClassModel::findOrFail($id);
        return view('classes.edit', compact('class'));
    }

    public function update(Request $request, $id)
    {
        // get params
        $class_name = $request->class_name;
        $latitude = doubleval($request->latitude);
        $longitude = doubleval($request->longitude);

        $class = ClassModel::findOrFail($id);

        // Check if the class exists
        if (!$class) {
            return redirect()->route('class.index')->with('msg', 'Class not found!');
        }

        // Update the class with new data
        $updateClass = $class->update([
            'class_name' => $class_name,
            'latitude' => $latitude,
            'longitude' => $longitude
        ]);

        if (!$updateClass) return redirect()->route('class.edit', $id)->with('msg', 'class update failed!');

        return redirect()->route('class.index')->with('msg', 'Class updated successfully.');
    }

    public function destroy($id)
    {
        $class = ClassModel::findOrFail($id);
        $deleteClass = $class->delete();

        if (!$deleteClass) return redirect()->route('class.index')->with('msg', 'Class delete failed!');

        return redirect()->route('class.index')->with('msg', 'Class deleted successfully.');
    }

    // public function downloadQrCode($className)
    // {
    //     // Generate QR Code
    //     $fileName = "qrcode-{$className}.png";
    //     $filePath = storage_path("app/public/$fileName");

    //     // Generate and save QR Code as an image
    //     QrCode::size(200)
    //         ->format('png')
    //         ->writer(new PngWriter())
    //         ->generate(url("users/absences/$className"), $filePath);

    //     // Return file as download response
    //     return response()->download($filePath)->deleteFileAfterSend(true);
    // }

    public function downloadQrCode($className)
    {
        // Path untuk menyimpan file QR Code
        $fileName = "qrcode-{$className}.png";
        $filePath = storage_path("app/public/$fileName");

        // Generate QR Code
        $qrCode = Builder::create()
            ->writer(new PngWriter())
            ->data(url("users/absences/$className"))
            ->size(500)
            ->build();

        // Simpan QR Code sebagai file
        file_put_contents($filePath, $qrCode->getString());

        // Return file sebagai response download
        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
