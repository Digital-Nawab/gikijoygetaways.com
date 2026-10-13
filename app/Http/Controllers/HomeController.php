<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetaPage;
use App\Models\Slider;
use App\Models\Offer;
use App\Models\State;
use App\Models\Blog;
use App\Models\Package;
use App\Models\TouristPlace;
use App\Models\PackageGallery;
use App\Models\City;
use App\Models\SubPackage;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        $offers = Offer::latest()->get();
        $state = State::where('status', 1)->latest()->get();
        $blogs = Blog::latest()->get();
        $packages = Package::with(['country', 'state', 'city'])
            ->where('status', 1)
            ->orderBy('name', 'asc') 
            ->get();
        $places = TouristPlace::latest()->get();

        // $meta = MetaPage::where('page_url', 'home')->first();
        // return $meta; 
        $filterStates = State::where('status', 1)
            ->withCount('packages')
            ->orderBy('state_name')
            ->get();

        $filterCities = City::whereHas('packages')
            ->with('state')
            ->withCount('packages')
            ->orderBy('name')
            ->get();

        return view('frontend.pages.index', compact(
            'sliders',
            'offers',
            'state',
            'blogs',
            'packages',
            'places',
            'filterStates',
            'filterCities'
            //   'meta'
        ));
    }

   public function Packages(Request $request, $slug = null)
    {
        // slug se state nikaalo aur usi ko state_id bana do — taaki neeche ka pura code waisa hi chale
        $slugState = null;
        if ($slug) {
            $slugState = \App\Models\State::where('slug', $slug)->first();
            if ($slugState) {
                $request->merge(['state_id' => $slugState->id]);
            }
        }

        $countries = \App\Models\Country::with(['states' => function ($q) {
            $q->where('status', 1)
                ->orderBy('state_name')
                ->withCount('packages');
        }])->whereHas('states', function ($q) {
            $q->where('status', 1);
        })->orderBy('name')->get();

        // ✅ Selected state with cities
        $selectedState = null;
        if ($request->filled('state_id')) {
            $selectedState = \App\Models\State::with(['cities' => function ($q) {
                $q->where('status', 1)
                    ->orderBy('name')
                    ->withCount('packages');
            }])->find($request->state_id);
        }

        $query = Package::with(['country', 'state', 'city']);

        if ($request->filled('state_id')) {
            $query->where('state_id', $request->state_id);
        }

        // ✅ City filter
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        if ($request->filled('min_price')) {
            $query->where('total_price', '>=', $request->min_price);
        }
        if ($request->filled('max_price')) {
            $query->where('total_price', '<=', $request->max_price);
        }

        match ($request->sort) {
            'price_high' => $query->orderBy('total_price', 'desc'),
            'price_low'  => $query->orderBy('total_price', 'asc'),
            default      => $query->latest(),
        };

        $packages = $query->paginate(6)->withQueryString();

        return view('frontend.pages.travelpackage', compact('packages', 'countries', 'selectedState'));
    }
    public function packageDetail($package_url)
    {
        $package = Package::with(['detail', 'city', 'country', 'state'])
            ->where('slug', $package_url)
            ->firstOrFail();

        // ── Sub Packages ──────────────────────────────────────────
        $subPackages = SubPackage::where('package_id', $package->id)
            ->orderBy('sort_order')
            ->get()
            ->map(function ($sp) {
                $sp->features = is_array($sp->features)
                    ? $sp->features
                    : (json_decode($sp->features ?? '[]', true) ?? []);
                return $sp;
            });

        $reviews = Review::where('package_id', $package->id)
        ->where('status', 1)          
        ->orderBy('sort_order')
        ->get();
        // ── Gallery ───────────────────────────────────────────────
        $galleries = PackageGallery::where('package_id', $package->id)->get();

        // ── Related Packages ──────────────────────────────────────
        $packagesQuery = Package::where('id', '!=', $package->id);

        if ($package->city_id) {
            $cityPackages = (clone $packagesQuery)
                ->where('city_id', $package->city_id)
                ->latest()->take(6)->get();

            $packages = $cityPackages->count() >= 3
                ? $cityPackages
                : (clone $packagesQuery)
                    ->where('state_id', $package->state_id)
                    ->latest()->take(6)->get();
        } elseif ($package->state_id) {
            $packages = (clone $packagesQuery)
                ->where('state_id', $package->state_id)
                ->latest()->take(6)->get();
        } else {
            $packages = collect();
        }

        return view('frontend.pages.travelpackagedetail', compact(
            'package',
            'packages',
            'galleries',
            'subPackages',
             'reviews' 
        ));
    }

    public function blogList()
    {
        $blogs = Blog::latest()->paginate(6);
        return view('frontend.pages.blog-list', compact('blogs'));
    }
    public function blogDetail($id)
    {
        $blog = Blog::where('status', 1)->findOrFail($id);

        // Recent posts sidebar ke liye (latest 4, current blog exclude)
        $recentBlogs = Blog::where('status', 1)
            ->where('id', '!=', $id)
            ->latest()
            ->take(4)
            ->get();

        // Related blogs (same location ya latest 5)
        $relatedBlogs = Blog::where('status', 1)
            ->where('id', '!=', $id)
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.pages.blog-detail', compact('blog', 'recentBlogs', 'relatedBlogs'));
    }
    // ✅ GET - Contact page
    public function contact()
    {
        $packages = \App\Models\Package::select('id', 'name')->latest()->get();
        return view('frontend.pages.contact', compact('packages'));
    }
}
