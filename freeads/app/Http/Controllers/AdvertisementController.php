<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\User;

class AdvertisementController extends Controller
{
    const FORM_VALIDATION_RULES = [
        'description' => 'required|min:10|max:1000',
        'price' => 'required|numeric|between:0,99999.99',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'category_id' => 'required|exists:categories,id',
        'product_name'=>'required|min:03|max:100',
        'pinCode'=>'required|numeric|between:0,99999.99',
    ];

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show', 'adsByCategory']]);
    }

    public function index()
    {
        $ads = Advertisement::paginate(8);

        return view('advertisement.index', ['ads' => $ads, 'categories' => Category::all()]);
    }

    public function adsByCategory($id)
    {
        $category = Category::paginate(8);
        $category = Category::find($id);

        if (!$category) {
            abort(404);
        }

        $ads = Advertisement::where('category_id', $category->id)->paginate(8);

        return view('advertisement.index', ['ads' => $ads, 'categories' => Category::all(), 'category' => $category]);
    }

    public function create()
    {
        return view('advertisement.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        $request->validate(self::FORM_VALIDATION_RULES);

        $ad = Advertisement::create($request->all());
        $ad->updateImage($request->image);

        return redirect(route('advertisement.show', [$ad->id]))
            ->with('message_type', 'success')
            ->with('message', 'You have successfully posted advertisement.');
    }

    public function show($id)
    {
        $ad = Advertisement::find($id);
        $user = User::find($ad->user_id);

        if (!$ad) {
            abort(404);
        }
        return view('advertisement.show', ['ad' => $ad, 'user' => $user]);
    }

    public function edit($id)
    {
        $ad = Advertisement::find($id);

        if (!$ad) {
            abort(404);
        }

        if (Auth::id() !== $ad->user_id) {
            abort(403);
        }

        return view('advertisement.edit', ['ad' => $ad, 'categories' => Category::all()]);
    }

    public function update(Request $request, $id)
    {
        $ad = Advertisement::find($id);

        if (Auth::id() !== $ad->user_id) {
            abort(403);
        }

        $request->validate(self::FORM_VALIDATION_RULES);

        $ad->update($request->all());
        $ad->updateImage($request->image);

        return redirect(route('advertisement.show', [$ad->id]))
            ->with('message_type', 'success')
            ->with('message', 'You have successfully updated advertisement.');
    }

    public function destroy($id)
    {
        $ad = Advertisement::paginate(8);
        $ad = Advertisement::find($id);

        if (!$ad) {
            return redirect(route('advertisement.admin'));
        }

        if (Auth::id() !== $ad->user_id) {
            abort(403);
        }

        $ad->delete();

        return redirect(route('advertisement.admin'))
            ->with('message_type', 'success')
            ->with('message', 'You have successfully deleted advertisement.');
    }

    public function admin()
    {
        $ads = Advertisement::paginate(8);
        $ads = Advertisement::where('user_id', Auth::id())->get();

        return view('advertisement.admin', ['ads' => $ads]);
    } 
    
    public function search(Request $request)
    {
        $ads = Advertisement::paginate(8);
        $ads = Advertisement::latest()->get();

        $found = [];

        foreach($ads as $ad)
        {
            if(str_contains(strtoupper($ad->product_name), strtoupper($request->search)))
            {
                array_push($found, $ad);
                //echo "OK";
            }
        }

        if(count($found) == 0)
        {
            return view("advertisement.notfound");
        }

        return view("advertisement.showFound", compact("found"));
    }
    
}
