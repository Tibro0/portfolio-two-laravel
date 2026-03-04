<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Portfolio;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $portfolios = Portfolio::with('category')->get();
        return view('admin.portfolio.portfolio.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.portfolio.portfolio.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thumb_image' => ['required', 'image', 'mimes:png'],
            'category' => ['required', 'integer'],
            'frontend_title' => ['required', 'max:255'],
            'frontend_description' => ['required', 'max:255'],
            'preview_title' => ['required', 'max:255'],
            'preview_description' => ['required', 'max:255'],
            'live_link' => ['required', 'url', 'max:255'],
            'github_link' => ['url', 'nullable', 'max:255'],
        ]);

        if ($request->file('thumb_image')) {
            $image = $request->file('thumb_image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(1024, 683);
            $img->toPng()->save(base_path('public/uploads/portfolio/' . $name_gen));
            $save_url = 'uploads/portfolio/' . $name_gen;

            $portfolio = new Portfolio();
            $portfolio->thumb_image = $save_url;
            $portfolio->category_id = $request->category;
            $portfolio->frontend_title = $request->frontend_title;
            $portfolio->frontend_description = $request->frontend_description;
            $portfolio->preview_title = $request->preview_title;
            $portfolio->preview_description = $request->preview_description;
            $portfolio->live_link = $request->live_link;
            $portfolio->github_link = $request->github_link;
            $portfolio->save();

            return redirect()->route('admin.portfolio.index')->with('toast', [
                'type' => 'success',
                'message' => 'Created Successfully!'
            ]);
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
        $portfolio = Portfolio::findOrFail($id);
        $categories = Category::all();
        return view('admin.portfolio.portfolio.edit', compact('portfolio', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'thumb_image' => ['nullable', 'image', 'mimes:png'],
            'category' => ['required', 'integer'],
            'frontend_title' => ['required', 'max:255'],
            'frontend_description' => ['required', 'max:255'],
            'preview_title' => ['required', 'max:255'],
            'preview_description' => ['required', 'max:255'],
            'live_link' => ['required', 'url', 'max:255'],
            'github_link' => ['url', 'nullable', 'max:255'],
        ]);

        $oldImage = $request->old_thumb_image;
        if ($request->file('thumb_image')) {
            $image = $request->file('thumb_image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img = $img->resize(1024, 683);
            $img->toPng()->save(base_path('public/uploads/portfolio/' . $name_gen));
            $save_url = 'uploads/portfolio/' . $name_gen;

            $portfolio = Portfolio::findOrFail($id);
            $portfolio->thumb_image = $save_url;
            $portfolio->category_id = $request->category;
            $portfolio->frontend_title = $request->frontend_title;
            $portfolio->frontend_description = $request->frontend_description;
            $portfolio->preview_title = $request->preview_title;
            $portfolio->preview_description = $request->preview_description;
            $portfolio->live_link = $request->live_link;
            $portfolio->github_link = $request->github_link;
            $portfolio->save();

            $defaultImages = [
                'frontend/assets/img/portfolio/portfolio-1.png',
                'frontend/assets/img/portfolio/portfolio-2.png',
                'frontend/assets/img/portfolio/portfolio-3.png',
                'frontend/assets/img/portfolio/portfolio-4.png',
                'frontend/assets/img/portfolio/portfolio-5.png',
                'frontend/assets/img/portfolio/portfolio-6.png',
            ];

            if ($oldImage && !in_array($oldImage, $defaultImages) && file_exists($oldImage)) {
                unlink($oldImage);
            }

            return redirect()->route('admin.portfolio.index')->with('toast', [
                'type' => 'success',
                'message' => 'Updated Successfully!'
            ]);
        } else {
            $portfolio = Portfolio::findOrFail($id);
            $portfolio->category_id = $request->category;
            $portfolio->frontend_title = $request->frontend_title;
            $portfolio->frontend_description = $request->frontend_description;
            $portfolio->preview_title = $request->preview_title;
            $portfolio->preview_description = $request->preview_description;
            $portfolio->live_link = $request->live_link;
            $portfolio->github_link = $request->github_link;
            $portfolio->save();

            return redirect()->route('admin.portfolio.index')->with('toast', [
                'type' => 'success',
                'message' => 'Updated Successfully!'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio = Portfolio::findOrFail($id);

        $defaultImages = [
            'frontend/assets/img/portfolio/portfolio-1.png',
            'frontend/assets/img/portfolio/portfolio-2.png',
            'frontend/assets/img/portfolio/portfolio-3.png',
            'frontend/assets/img/portfolio/portfolio-4.png',
            'frontend/assets/img/portfolio/portfolio-5.png',
            'frontend/assets/img/portfolio/portfolio-6.png',
        ];

        if ($portfolio->thumb_image && !in_array($portfolio->thumb_image, $defaultImages) && file_exists($portfolio->thumb_image)) {
            unlink($portfolio->thumb_image);
        }

        $portfolio->delete();
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
