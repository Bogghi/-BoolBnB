<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Image;
use App\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users_id = Auth::id();
        $apartments = Apartment::where('user_id', $users_id)->get();
        return view('admin.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();

        return view('admin.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $services = Service::orderByDesc('id')->first();

        $request->validate([
            // 'images' => "image|unique:images",
            'services' => "required|array|min:1",
            'services.*' => "required|integer|min:1|max:" . $services->id,
            'address' => "required|max:255",
            'cover_image' => "required|unique:apartments|image",
            'bathrooms_number' => "required|integer",
            'beds_number' => "required|integer",
            'square_meters' => "required|integer",
            'description' => "required|min:150|max:500",
            'rooms_number' => "required|integer",
            'title' => "required|max:100",
            'visibility' => "boolean",
        ]);


        // Api call to get latitude and longitude from the passed address.
        $address = $data['address'];
        $geocode = file_get_contents('https://api.tomtom.com/search/2/geocode/' . $address . '.json?limit=1&key=sVorgm5GUAIyuOOj6t6WLNHniiKmKUSo');
        $output = json_decode($geocode);
        $latitude = $output->results[0]->position->lat;
        $longitude = $output->results[0]->position->lon;

        // Save cover_image in the storage with original name.
        $cover_image_name = $request->cover_image->getClientOriginalName();

        $new_apartment_id = Apartment::orderByDesc("id")->first()->id + 1;

        $path_cover_image = $request->cover_image->storeAs(
            "images/" . $new_apartment_id,
            $cover_image_name,
            "public"
        );

        // Creation of a new apartment and add it to apartment's table.
        $user_id = Auth::id();
        $apartment = new apartment;
        $apartment->user_id = $user_id;
        $apartment->longitude = $longitude;
        $apartment->latitude = $latitude;
        $apartment->cover_image = $path_cover_image;
        $apartment->bathrooms_number = $data['bathrooms_number'];
        $apartment->beds_number = $data['beds_number'];
        $apartment->square_meters = $data['square_meters'];
        $apartment->address = $data['address'];
        $apartment->description = $data['description'];
        $apartment->rooms_number = $data['rooms_number'];
        $apartment->title = $data['title'];

        
        if ($request->visibility != null) {
            $apartment->visibility = 0;
        } else {
            $apartment->visibility = 1;
        }

        $apartment->save();

        // Save other images in the images' table, if they are passed.
        if ($request->hasFile('images')) {

            $apartment_id = $apartment->id;

            $images = $request->file('images');

            foreach ($images as $image) {

                $name = $image->getClientOriginalName();

                $path = $image->storeAs(
                    "images/" . $apartment_id,
                    $name,
                    "public"
                );

                $newImage = new Image();
                $newImage->apartment_id = $apartment_id;
                $newImage->image_path = $path;
                $newImage->save();
            }
        }

        // Add checked services to the pivot table.
        if (isset($data['services'])) {
            $apartment->services()->sync($data['services']);
        }


        return redirect()->route('admin.apartment.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

        return view("admin.show", ["apartment" => $apartment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment = Apartment::find($id);

        $services = Service::all();
        $apartment_images = $apartment->images;
        // dd($apartment_images);

        return view('admin.edit', compact('apartment', 'services', 'apartment_images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $services = Service::orderByDesc('id')->first();

        $request->validate([
            // 'images' => "image|unique:images",
            'services' => "required|array|min:1",
            'services.*' => "required|integer|min:1|max:" . $services->id,
            'address' => "required|max:255",
            'cover_image' => "unique:apartments|image",
            'bathrooms_number' => "required|integer",
            'beds_number' => "required|integer",
            'square_meters' => "required|integer",
            'description' => "required|min:150|max:500",
            'rooms_number' => "required|integer",
            'title' => "required|max:100",
            'visibility' => "boolean",
        ]);

        $address = $data['address'];
        $geocode = file_get_contents('https://api.tomtom.com/search/2/geocode/' . $address . '.json?limit=1&key=sVorgm5GUAIyuOOj6t6WLNHniiKmKUSo');
        $output = json_decode($geocode);
        $latitude = $output->results[0]->position->lat;
        $longitude = $output->results[0]->position->lon;

        $apartment = Apartment::find($id);

        if ($request->cover_image != null) {

          Storage::disk('public')->delete($apartment->cover_image);

          // Save cover_image in the storage with original name.
          $cover_image_name = $request->cover_image->getClientOriginalName();

          $apartment_id = $apartment->id;

          $path_cover_image = $request->cover_image->storeAs(
              "images/" . $apartment_id,
              $cover_image_name,
              "public"
          );

          $apartment->cover_image = $path_cover_image;
        }



        $user_id = Auth::id();
        $apartment->user_id = $user_id;
        $apartment->longitude = $longitude;
        $apartment->latitude = $latitude;
        $apartment->bathrooms_number = $data['bathrooms_number'];
        $apartment->beds_number = $data['beds_number'];
        $apartment->square_meters = $data['square_meters'];
        $apartment->square_meters = $data['square_meters'];
        $apartment->address = $data['address'];
        $apartment->description = $data['description'];
        $apartment->rooms_number = $data['rooms_number'];
        $apartment->title = $data['title'];

        if ($request->visibility != null) {
          $apartment->visibility = 0;
        } else {
          $apartment->visibility = 1;
        }


        if ($request->hasFile('images')) {

            $images = $request->file('images');

            foreach ($images as $image) {

                $name = $image->getClientOriginalName();

                $path = $image->storeAs(
                    "images/" . $apartment_id,
                    $name,
                    "public"
                );

                $newImage = new Image();
                $newImage->apartment_id = $apartment_id;
                $newImage->image_path = $path;
                $newImage->save();
            }
        }


        if (isset($data['services'])) {
            $apartment->services()->sync($data['services']);
        } else {
            $apartment->services()->detach();
        }

        $apartment->update();


        return redirect()->route('admin.apartment.show', $apartment);
    }

    /**
     * Remove the specified Apartment from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::find($id);

        Storage::disk('public')->delete($apartment->cover_image);

        $images = Image::where('apartment_id', $id)->get();

        foreach ($images as $image) {

          Storage::disk('public')->delete($image->image_path);
        }

        $apartment->services()->detach();
        $apartment->delete();
        return redirect()->route('admin.apartment.index');
    }
}
