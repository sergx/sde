<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create()->each(function($user) {
            $user->orgs()->saveMany(factory(Modules\Org\Entities\Org::class, rand(1,2))->make());
        });
        $userIds = App\User::pluck('id')->toArray();
        $orgIds = Modules\Org\Entities\Org::pluck('id')->toArray();

        foreach($orgIds as $org_id){
            factory(Modules\Product\Entities\ProductCategory::class, rand(3,15))->create()->each(function($product_category) use ($org_id) {
                $product_category->org_id = $org_id;
                $product_category->save();
                $product_category->products()->saveMany(factory(Modules\Product\Entities\Product::class, rand(4,16))->make());
            });
        }

        // Contact, Order, User
        
        $productIds = Modules\Product\Entities\Product::pluck('id')->toArray();

        factory(App\User::class, 20)->create()->each(function($user) {
            $user->contacts()->saveMany(factory(Modules\Contact\Entities\Contact::class, 1)->make());
        });
        
        $usersWithContact =  Modules\Contact\Entities\Contact::select('id','user_id')->get()->toArray();

        foreach($usersWithContact as $contact){
            $products_price = 0;

            $base_product = Modules\Product\Entities\Product::with(['product_category', 'product_category.org'])->where('id', array_random($productIds))->first();
            $productCategoryId = $base_product->product_category->id;
            $orgId = $base_product->product_category->org->id;
            $productsFromSameCategory = Modules\Product\Entities\Product::where('product_category_id', $productCategoryId)->limit(rand(1,4))->inRandomOrder()->get();
            foreach($productsFromSameCategory as $product){
                $products_price += $product->action_price?: $product->price;
            }
            factory(Modules\Order\Entities\Order::class, 1)->create()->each(function($order) use ($contact, $products_price, $productsFromSameCategory, $orgId){
                $order->products_price = $products_price;
                foreach($productsFromSameCategory as $order_product){
                    $order->products()->attach($order_product->id, ['price' => $order_product->action_price?: $order_product->price, 'quantity' => 1]);
                }
                $order->user_id = $contact['user_id'];
                $order->contact_id = $contact['id'];
                $order->org_id = $orgId;
                $order->save();
            });
        }




        // $this->call(UsersTableSeeder::class);
    }
}
