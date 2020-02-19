<?php

use Illuminate\Database\Seeder;
//use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
/*
TRUNCATE `category_types`;
TRUNCATE `contacts`;
TRUNCATE `orders`;
TRUNCATE `order_product`;
TRUNCATE `orgs`;
TRUNCATE `password_resets`;
TRUNCATE `products`;
TRUNCATE `product_categories`;
TRUNCATE `users`;
*/
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // создать аккаунт админа с фиксированным паролем
        $users_to_create = [
            [
                'name' => 'Сергей',
                'email' => 'serg_x@bk.ru',
                'password' => '123456789',
            ]
        ];
        foreach($users_to_create as $user){
            App\User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),
            ])->each(function($user) {
                $user->orgs()->saveMany(factory(Modules\Org\Entities\Org::class, rand(1,2))->make());
            });
        }

        // Создаем Юзеров-партнеров и к ним Организации
        factory(App\User::class, 5)->create()->each(function($user) {
            $user->orgs()->saveMany(factory(Modules\Org\Entities\Org::class, rand(1,2))->make());
        });
        //$userIds = App\User::pluck('id')->toArray();
        $orgIds = Modules\Org\Entities\Org::pluck('id')->toArray();

        // Создать типы категорий (еды)
        $categoryTypes = [
            'sushi' => 'Суши',
            'pizza' => 'Пицца',
            'burger' => 'Бургеры',
            'fasfood' => 'Фастфуд',
            'shashlik' => 'Шашлыки',
            'asia' => 'Азиатская',
            'pirogi' => 'Пироги',
            'dessert' => 'Десерты',
            'healthy' => 'Здоровая еда',
            'meat' => 'Мясо и рыба',
            'obedy' => 'Обеды',
            'russian' => 'Русская',
        ];
        $categoryTypes_counter = 1;
        foreach($categoryTypes as $alias => $name){
            $categoryType = new Modules\Product\Entities\CategoryType;
            $categoryType->name = $name;
            $categoryType->alias = $alias;
            $categoryType->image_icon = "storage/type_image/noimage.png";
            $categoryType->sort_order = $categoryTypes_counter;
            $categoryType->save();
            $categoryTypes_counter++;
        }


        foreach($orgIds as $org_id){
            // Создаем категорию товаров
            $categoryTypes_ids = range(1, 12);
            shuffle($categoryTypes_ids);
            $categoryTypes_ids = array_slice($categoryTypes_ids, 0 , rand(3,9));
            $category_types = Modules\Product\Entities\CategoryType::all();
            foreach($categoryTypes_ids as $type_id){
                
                $category_type = $category_types->find($type_id);
                factory(Modules\Product\Entities\ProductCategory::class, 1)->create()->each(function($product_category) use ($org_id, $category_type) {
                    $product_category->name = $category_type->name;
                    $product_category->sort_order = $category_type->sort_order;
                    $product_category->org_id = $org_id;
                    $product_category->category_type_id = $category_type->id;
                    $product_category->save();
                    // и товары в ней
                    $product_category->products()->saveMany(factory(Modules\Product\Entities\Product::class, rand(4,16))->make());
                });
            }
        }

        // Contact, Order, User
        
        $productIds = Modules\Product\Entities\Product::pluck('id')->toArray();

        // Создаем Юзеров-покупателей и к ним контакты
        factory(App\User::class, 20)->create()->each(function($user) {
            $user->contacts()->saveMany(factory(Modules\Contact\Entities\Contact::class, 1)->make());
        });
        
        $usersWithContact =  Modules\Contact\Entities\Contact::select('id','user_id')->get()->toArray();

        foreach($usersWithContact as $contact){
            $products_price = 0;

            // Выбираем товар, из которого нам нужна категория и организация
            $base_product = Modules\Product\Entities\Product::with(['product_category', 'product_category.org'])->where('id', array_random($productIds))->first();
            $productCategoryId = $base_product->product_category->id;
            $orgId = $base_product->product_category->org->id;

            // Выбираем товары из одной категории
            $productsFromSameCategory = Modules\Product\Entities\Product::where('product_category_id', $productCategoryId)->limit(rand(1,4))->inRandomOrder()->get();
            foreach($productsFromSameCategory as $product){
                $products_price += $product->action_price?: $product->price;
            }
            // Создаем заказ
            factory(Modules\Order\Entities\Order::class, 1)->create()->each(function($order) use ($contact, $products_price, $productsFromSameCategory, $orgId){
                $order->products_price = $products_price;
                foreach($productsFromSameCategory as $order_product){
                    // Прицепляем к заказу товары
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
