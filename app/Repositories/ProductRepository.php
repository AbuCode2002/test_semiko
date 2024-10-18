<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository
{
    /**
     * @return void
     */
    protected function setModel(): void
    {
        $this->model = Product::class;
    }

    public function index($term)
    {
        try {
            return Product::query()
                ->when($term, function ($query, $term) {
                    $query->where('name', 'LIKE', '%' . $term . '%')
                        ->orWhere('count', 'LIKE', '%' . $term . '%')
                        ->orWhere('price', 'LIKE', '%' . $term . '%');
                })
                ->latest()
                ->paginate(15);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function store($validatedData)
    {
        try {
            Product::create($validatedData);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function show(int $id)
    {
        try {
            return Product::findOrFail($id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function edit($id)
    {
        try {
            return Product::findOrFail($id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            Product::where('id', $id)->update($request->all());
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            Product::destroy($id);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function deleteMultiple($userIds)
    {
        try {
            Product::whereIn('id', $userIds)->delete();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
