<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Models\Product;
use App\Http\Requests\UpdateRequest;

class LinkController extends Controller
{
    public function storeItem(StoreRequest $request)
    {
        $product = Product::create($request->validated());
        return redirect()->route('index');
    }
    public function updateItem(UpdateRequest $request, Product $itemId) 
    {
        $itemId->update($request->validated());
        return redirect()->route('index');
    }
    public function deleteItem(Product $itemId) {
        $itemId->delete();
        return redirect()->route('index');
    }

}
