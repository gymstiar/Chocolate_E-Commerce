<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'primaryImage']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(15);
        $categories = Category::all();

        return view('seller.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('seller.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'weight' => 'nullable|integer|min:0',
            'cocoa_percentage' => 'nullable|integer|min:0|max:100',
            'chocolate_type' => 'required|in:dark,milk,white,ruby,mixed',
            'origin' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'cocoa_percentage' => $request->cocoa_percentage,
            'chocolate_type' => $request->chocolate_type,
            'origin' => $request->origin,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ]);

        // Upload images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path,
                    'is_primary' => $index === 0,
                    'sort_order' => $index,
                ]);
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Product created successfully!');
    }

    public function show(Product $product)
    {
        $product->load(['category', 'images', 'orderItems']);
        return view('seller.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        $product->load('images');
        return view('seller.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'weight' => 'nullable|integer|min:0',
            'cocoa_percentage' => 'nullable|integer|min:0|max:100',
            'chocolate_type' => 'required|in:dark,milk,white,ruby,mixed',
            'origin' => 'nullable|string|max:100',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ]);

        $product->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'short_description' => $request->short_description,
            'price' => $request->price,
            'sale_price' => $request->sale_price,
            'stock' => $request->stock,
            'weight' => $request->weight,
            'cocoa_percentage' => $request->cocoa_percentage,
            'chocolate_type' => $request->chocolate_type,
            'origin' => $request->origin,
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('seller.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Delete images from storage
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $product->delete();

        return redirect()->route('seller.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    public function uploadImages(Request $request, Product $product)
    {
        $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // Check if adding new images would exceed the limit of 5
        $currentCount = $product->images()->count();
        $newCount = count($request->file('images'));
        
        if ($currentCount + $newCount > 5) {
            $remaining = 5 - $currentCount;
            return back()->with('error', "Maximum 5 images allowed. You can only add {$remaining} more image(s).");
        }

        $maxOrder = $product->images()->max('sort_order') ?? -1;

        foreach ($request->file('images') as $image) {
            $path = $image->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $path,
                'is_primary' => false,
                'sort_order' => ++$maxOrder,
            ]);
        }

        return back()->with('success', 'Images uploaded successfully!');
    }

    public function deleteImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Image deleted successfully!');
    }

    public function uploadVideo(Request $request, Product $product)
    {
        $request->validate([
            'video' => 'required|mimes:mp4,webm,mov|max:51200', // 50MB max
        ]);

        // Delete existing video if any
        if ($product->video) {
            Storage::disk('public')->delete($product->video);
        }

        $path = $request->file('video')->store('products/videos', 'public');
        $product->update(['video' => $path]);

        return back()->with('success', 'Video uploaded successfully!');
    }

    public function deleteVideo(Product $product)
    {
        if ($product->video) {
            Storage::disk('public')->delete($product->video);
            $product->update(['video' => null]);
        }

        return back()->with('success', 'Video deleted successfully!');
    }
}
