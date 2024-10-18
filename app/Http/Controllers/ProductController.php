<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use App\Models\User;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProductController extends Controller
{

    public function __construct(
        private ProductRepository $productRepository = new ProductRepository(),
    )
    {
        //
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $term = $request->input('term');

        $products = $this->productRepository->index($term);

        return Inertia::render('Products/Index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Products/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $validatedData = $request->validated();

        $this->productRepository->store($validatedData);

        return redirect()->route('products.index')->with('success', 'Продукт успешно добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $getProduct = $this->productRepository->show($id);

        return Inertia::render('Products/Show', compact('getProduct'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productRepository->edit($id);

        return Inertia::render('Products/Edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->productRepository->update($request, $id);

        return redirect('/products')->with('success', 'Продукт успешно отредактирован!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productRepository->destroy($id);

        return back()->with('delete', 'Продукт успешно удален!');
    }

    public function deleteMultiple(Request $request)
    {
        $userIds = $request->input('ids');

        $this->productRepository->deleteMultiple($userIds);

        return redirect()->route('products.index')->with('success', 'Операция прошла успешно!');
    }
}
