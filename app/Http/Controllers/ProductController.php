<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductTags;
use App\Models\Tag;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        //
        DB::connection()->enableQueryLog();

        $product = product::with("tags")
            ->where('id', 1)
            ->get();
        //$tags = $product->tags;


        return response()->json(['success' => $product, 'DB' => DB::getQueryLog()], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //开启事务
        DB::beginTransaction();

        $mtag = ['cc', 'dd', 'ee'];

        try {
            $products = Product::create(['name' => 'japansen', 'detail' => 'japansens']);
        } catch (ValidationException $e) {
            //如果验证失败，回滚
            DB::rollback();
            return $e->getErrors();
        } catch (\Exception $e) {
            //如果异常，回滚
            DB::rollback();
            throw $e;
        }

        try {

            foreach ($mtag as $mtags) {
                $t = Tag::create([
                    'name' => $mtags,
                ]);
                $ProductTags = ProductTags::create(['product_id' => $products->id, 'tag_id' => $t->id]);
            }

        } catch (ValidationException $e) {
            DB::rollback();
            return $e->getErrors();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }


        //提交事务
        DB::commit();

        return $products;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $tagx
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        DB::connection()->enableQueryLog();
        $Product = Product::with('comments')->findOrFail(1);
        $comments = $Product->comments;
        return response()->json(['success' => $Product, 'DB' => DB::getQueryLog()], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product)
    {
        DB::connection()->enableQueryLog();

        //一对一的多态关联
        $product = Product::findOrFail(1);
        $image = $product->image;

        return response()->json(['success' => $image, 'DB' => DB::getQueryLog()], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
