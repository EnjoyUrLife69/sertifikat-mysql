<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $slider = Slider::OrderBy('id', 'asc')->get();
        return view('slider.index', compact('slider'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $slider = Slider::all();
        return view('slider.create', compact('slider'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slider = new Slider();
        $slider->judul = $request->judul;
        $slider->deskripsi = $request->deskripsi;
        $slider->status = false; // Default nonaktif

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $name = uniqid() . '_' . $img->getClientOriginalName();
            $path = $img->storeAs('images/slider', $name, 'public');
            $slider->image = $path;
        }

        $slider->save();
        toast('Data has been submited!', 'success')->position('top-end');
        return redirect()->route('slider.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->status = $request->status;
        $slider->save();

        return response()->json(['success' => true, 'message' => 'Status updated successfully.']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        $slider = Slider::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slider = Slider::findOrFail($id);
        $slider->judul = $request->judul;
        $slider->deskripsi = $request->deskripsi;
        $slider->status = $request->has('status') ? true : false;

        if ($request->hasFile('image')) {
            $img = $request->file('image');
            $name = uniqid() . '_' . $img->getClientOriginalName();
            $path = $img->storeAs('images/slider', $name, 'public');
            $slider->image = $path;
        }

        $slider->save();
        toast('Data has been updated!', 'success')->position('top-end');
        return redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();

        toast('Data has been deleted!', 'success')->position('top-end');
        return redirect()->route('slider.index');
    }
}
