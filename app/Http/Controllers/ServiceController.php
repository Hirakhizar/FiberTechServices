<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddServiceRequest;
use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceDetail;
use App\Models\ServiceKeyPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $services=Service::with(['details','key_points'])->get();
        $services=Service::with(['category'])->where('status','active')->get();
        // dd($services);
        return view('services.index',compact('services'));
    }


    public function serviceForm()
    {
        $categories=Category::get();
        return view('services.form',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddServiceRequest $request)
    {
        $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
        DB::beginTransaction();
        try{
        $service = new Service();
        $service->title = $request->input('name');
        $service->thumbnail = $thumbnailPath;
        $service->category_id = $request->input('category_id');
        $service->save();
        if ($request->has('section_contents')) {
            foreach ($request->input('section_contents') as $index => $content) {
                $details = new ServiceDetail();
                if ($request->hasFile('section_images.' . $index)) {
                    $sectionImagePath = $request->file('section_images.' . $index)->store('section_images', 'public');
                    $details->image = $sectionImagePath;
                }
                $details->service_description = $content;
                $details->service_id = $service->id;
                $details->save();
            }
        }

        if ($request->has('data')) {
            foreach ($request->input('data') as $data) {
                $textDetails=$data;
                $keyPoints= new ServiceKeyPoint();
                $keyPoints->key_points=$textDetails;
                $keyPoints->service_id = $service->id;
                $keyPoints->save();
             }
        }
DB::commit();
 return redirect()->route('showServices');
    }catch(\Exception $e){
     DB::rollBack();
     return $e->getMessage();
    //  \Log::error('Error storing service: ' . $e->getMessage());
    //  return redirect()->back()->with('error', 'Failed to add service. Please try again.');
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service=Service::where('id',$id)->with(['category','details','keyPoints'])->first();
        $categories=Category::get();
        // dd($service);
        return view('services.editForm',compact(['service','categories']));

    }



    /**
     * Update the specified resource in storage.
     */
      // Update the specified service
      public function update(Request $request, $id)
      {
          $request->validate([
              'name' => 'required|string|max:255',
              'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              'category_id' => 'required|exists:categories,id',
              'section_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
              'section_contents.*' => 'required|string',
              'data.*' => 'required|string',
          ]);

          $service = Service::findOrFail($id);

          // Update service details
          $service->title = $request->input('name');
          $service->category_id = $request->input('category_id');

          // Handle thumbnail upload
          if ($request->hasFile('thumbnail')) {
              // Delete old thumbnail if exists
              if ($service->thumbnail) {
                  Storage::disk('public')->delete($service->thumbnail);
              }
              $service->thumbnail = $request->file('thumbnail')->store('thumbnails', 'public');
          }
          $service->save();

          // Handle service details (sections)
          if ($request->has('section_contents')) {
              foreach ($request->section_ids as $index => $sectionId) {
                  $section = ServiceDetail::findOrFail($sectionId);
                  $section->service_description = $request->section_contents[$index];
                  if ($request->hasFile('section_images.' . $index)) {
                      if ($section->image) {
                          Storage::disk('public')->delete($section->image);
                      }
                      $section->image = $request->file('section_images.' . $index)->store('section_images', 'public');
                  }

                  $section->save();
              }
          }

          // Handle key points (data)
          if ($request->has('data')) {
              foreach ($request->data as $index => $keyPointContent) {
                  $keyPoint = ServiceKeyPoint::findOrFail($request->key_point_ids[$index]);
                  $keyPoint->key_points = $keyPointContent;
                  $keyPoint->save();
              }
          }

          return redirect()->route('showServices')->with('success', 'Service updated successfully!');
      }

      public function delete($id){
        $service=Service::find($id);
        $service->status='inactive';
        $service->save();
        return redirect()->back();
      }
}


