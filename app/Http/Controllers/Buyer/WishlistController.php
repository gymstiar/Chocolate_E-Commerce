<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with(['product.primaryImage', 'product.category'])
            ->where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('buyer.wishlist', compact('wishlists'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            $message = 'Product removed from wishlist.';
            $added = false;
        } else {
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
            ]);
            $message = 'Product added to wishlist!';
            $added = true;
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'added' => $added, 'message' => $message]);
        }

        return back()->with('success', $message);
    }

    public function remove($id)
    {
        Wishlist::where('user_id', auth()->id())
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Item removed from wishlist.');
    }
}
