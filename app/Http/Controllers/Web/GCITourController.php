<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\GCITour;
use App\Models\GCITourCity;
use App\Models\Province;

use App\Http\Requests\GCITour\CreateGCITourRequest;
use App\Http\Requests\GCITour\UpdateGCITourRequest;


use DataTables;

class GCITourController extends Controller
{
    public function list(Request $request) {
        $data = GCITour::latest()->with('tour_province')->get();
        if($request->ajax()) {
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('province', function($row) {
                        return optional($row->tour_province)->name;
                    })
                    ->addColumn('actions', function($row) {
                        $btn = '<a href="/admin/gci_tour/edit/' . $row->id . '" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                <button id="' . $row->id . '" class="btn btn-danger remove-btn"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['province', 'actions'])
                    ->make(true);
        }

        return view('admin-page.gci_tours.list');
    }

    public function create(Request $request) {
        $provinces = Province::get();
        return view('admin-page.gci_tours.create', compact('provinces'));
    }

    public function store(CreateGCITourRequest $request) {
        $data = $request->validated();

        $tour = GCITour::create(array_merge($data, [
            'inclusions' => $request->has('inclusions') ? json_encode($request->inclusions) : null,
            'is_featured' => $request->has('is_featured')
        ]));

        if(count($request->tour_cities) > 0) {
            foreach ($request->tour_cities as $key => $city) {
                $background_image = $city['background_image'];
                $city_background_name = Str::snake(Str::lower($city['city'])) . '.' . $background_image->getClientOriginalExtension();
                $save_file = $background_image->move(public_path() . '/app-assets/images/gci_tour_cities_backgrounds', $city_background_name);

                $create_tour_city = GCITourCity::create([
                    'main_id' => $tour->id,
                    'city' => $city['city'],
                    'description' => $city['description'],
                    'background_image' => $city_background_name
                ]);
            }
        }

        return redirect()->route('admin.gci_tours')->withSuccess('Tour Created Successfully');
    }

    public function edit(Request $request) {
        $provinces = Province::get();
        $tour = GCITour::where('id', $request->id)->with('tour_province', 'tour_cities')->firstOrFail();
        return view('admin-page.gci_tours.edit', compact('tour', 'provinces'));
    }

    public function update(UpdateGCITourRequest $request) {
        $data = $request->validated();
        $tour = GCITour::where('id', $request->id)->first();

        $tour_backgrounds = json_decode($request->current_tour_backgrounds);

        if($request->has('tour_backgrounds')) {
            foreach ($request->tour_backgrounds as $key => $tour_background) {
                $file_name = Str::snake(Str::lower($request->tour_name)) . '_' . $key . '.' . $tour_background->getClientOriginalExtension();
                $save_file = $tour_background->move(public_path() . '/app-assets/images/tour_backgrounds', $file_name);

                if(is_array($tour_backgrounds)) {
                    array_push($tour_backgrounds, $file_name);
                }
            }
        }

        $tour_cover_name = $request->current_tour_cover;

        if($request->hasFile('tour_cover')) {
            $tour_cover = $request->file('tour_cover');
            $tour_cover_name = Str::snake(Str::lower($request->tour_name)) . '.' . $tour_cover->getClientOriginalExtension();
            $save_file = $tour_cover->move(public_path() . '/app-assets/images/tour_covers', $tour_cover_name);
        }


        $update = $tour->update(array_merge($data, [
            'inclusions' => $request->has('inclusions') ? json_encode($request->inclusions) : null,
            'is_featured' => $request->has('is_featured'),
            'tour_backgrounds' => json_encode($tour_backgrounds),
            'tour_cover' => $tour_cover_name
        ]));

        if(count($request->tour_cities) > 0) {
            foreach ($request->tour_cities as $key => $city) {
                $city_background_name = $city['old_background_city_image'];

                if(isset($city['background_image'])) {
                    $background_image = $city['background_image'];
                    $city_background_name = Str::snake(Str::lower($city['city'])) . '.' . $background_image->getClientOriginalExtension();
                    $save_file = $background_image->move(public_path() . '/app-assets/images/gci_tour_cities_backgrounds', $city_background_name);
                }

                $update_tour_city = GCITourCity::where('id', $city['city_id'])->update([
                    'main_id' => $tour->id,
                    'city' => $city['city'],
                    'description' => $city['description'],
                    'background_image' => $city_background_name
                ]);
            }
        }
        return back()->withSuccess('Tour Updated Successfully');
    }
}
