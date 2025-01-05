<?php

namespace App\Console\Commands;
ini_set('max_execution_time', 0); // 3600 //60 minutes

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemOption;
use App\Models\SubOption;
use App\Services\MediaService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class SyncCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:categories-data';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync Categories from API to local database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // dd($this->getToken()); 
        $this->syncCategories();
        // $this->syncProducts();
        // $this->syncProducts(3);
    }

    public function syncCategories(): void
    {
        try {
            $this->info('Sync Categories from API to local database');
            $token = $this->getToken();

            $params = ['JEZID' => '3'];
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get(config('app.cake_api_url') . '/api/POSIntegration/GetCategories', $params);

            $count = 0;
            if ($response->successful()) {
                $data = $response->json();
                $collectionData = collect($data['R_Data']);

                if (is_array($data)) {
                    foreach ($data['R_Data'] as $item) {
                        if (isset($item['KAT_ID']) && $item['ParentKATID'] == null) {
                            if ($item['KAT_KGRID'] == '2') {
                                $exists = $collectionData->contains(function ($cat) use ($item) {
                                    return $cat['ParentKATID'] == $item['KAT_ID'];
                                });

                                $this->info('exists: ' . $exists . "   KAT_ID: " . $item['KAT_ID']);
                            } else {
                                $exists = true;
                            }


                            if ($exists) {
                                $data = [
                                    'CategoryID' => $item['KAT_ID'],
                                    'CatID' => "0",
                                    'blob' => 'main-categories',
                                    'Name' => $item['KAT_Name'],
                                    'NameEN' => $item['KAN_Name2'] ?? $item['KAT_Name'],
                                    'ShortcutName' => $item['KAT_Shortcut'] ?? $item['KAT_Name'],
                                    'ShortcutNameEN' => $item['KAT_Shortcut'] ?? $item['KAT_Name'],
                                ];

                                Category::query()->upsert($data, 'CategoryID', ['Name', 'NameEN', 'ShortcutName', 'ShortcutNameEN']);

                                $cat = Category::where('CategoryID', $item['KAT_ID'])->first();
                                if ($cat) {
                                    MediaService::addMediaFromUrl($cat, $item['ImageURL'], 'categories');
                                }
                                $count++;
                            }
                        }
                        if (isset($item['ParentKATID']) && !empty($item['ParentKATID'])) {
                            $category = Category::where('CategoryID', $item['ParentKATID'])->first();
                            if ($category) {
                                $data = [
                                    'CategoryID' => $item['KAT_ID'],
                                    'CatID' => $category->id,
                                    'blob' => 'sub-categories',
                                    'Name' => $item['KAT_Name'],
                                    'NameEN' => $item['KAN_Name2'] ?? $item['KAT_Name'],
                                    'ShortcutName' => $item['KAT_Shortcut'] ?? $item['KAT_Name'],
                                    'ShortcutNameEN' => $item['KAT_Shortcut'] ?? $item['KAT_Name'],
                                ];
                                Category::query()->upsert($data, 'CategoryID', ['Name', 'NameEN', 'ShortcutName', 'ShortcutNameEN', 'CatID']);
                                MediaService::addMediaFromUrl($category, $item['ImageURL'], 'categories');
                                $count++;
                            }
                        }
                    }
                    $this->info($count . ' records synced successfully!');
                } else {
                    $this->error('API response is not an array: ' . $response->body());
                }
            } else {
                $this->error('API request failed with status code: ' . $response->status());
            }
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }


    public function syncProducts($langId = 2): void
    {
        try {
            $this->info('Sync Products from API to local database');
            $token = $this->getToken();
            $params = ['P_LanguageID' => $langId];
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get(config('app.cake_api_url') . '/api/POSIntegration/GetItems', $params);

            if ($response->successful()) {
                $data = $response->json();
                if (is_array($data)) {
                    foreach ($data['R_Data'] as $item) {
                        if (isset($item['R_CategoryID'])) {
                            $category = Category::where('CategoryID', $item['R_CategoryID'])->first();
                            if ($category) {
                                $this->syncItems($item['R_ItemList'], $category, $langId);
                            }
                        }
                    }
                } else {
                    $this->error('API response is not an array: ' . $response->body());
                }
            } else {
                $this->error('API request failed with status code: ' . $response->status());
            }
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }

    public function syncItems($data, $category, $langId = 2): void
    {
        try {
            $count = 0;
            foreach ($data as $item) {
                if (isset($item['R_ItemID'])) {
                    $data = [
                        'ItemID' => $item['R_ItemID'],
                        'CatID' => $category->id,
                        'blob' => 'products',
                        'Name' => $item['R_ItemName'] ?? $item['R_ItemName'],
                        'NameEN' => $item['R_ItemName2'] ?? $item['R_ItemName'],
                        'ItemType' => $item['R_ItemType'],
                        'Description' => $item['R_ItemDescription2'] ?? '',
                        'DescriptionEN' => $item['R_ItemDescription'] ?? '',
                        'Price' => $item['R_ItemBasicPrice'],
                        'stock' => $item['R_ItemIsSoled'] ?? 0,
                        'operator' => "",
                        'Special' => $item['R_ItemType'] ?? 0,
                        'Date' => now(),
                    ];
                    if ($langId == 2) {
                        $category->product()->upsert($data, 'ItemID', ['Name', 'NameEN', 'Description', 'DescriptionEN', 'Price', 'stock', 'operator', 'Special']);
                    } else {
                        $category->product()->upsert($data, 'ItemID', ['NameEN', 'DescriptionEN']);
                    }

                    $product = Item::where('ItemID', $item['R_ItemID'])->first();

                    // if ($product) {
                    //     $product->clearMediaCollection('products');
                    //     $product->clearMediaCollection('attached_products');
                    //     MediaService::addMediaFromUrl($product, $item['R_ItemImageURL1'], 'products');
                    //     MediaService::addMultipleMediaFromRequest($product, $item['R_ItemImageURL2'], 'attached_products');
                    // }

                    if ($item['R_ItemID'] == '200014') {
                        // dd($item['R_DishsetList']);
                    }
                    $this->syncDishSet($item['R_DishsetList'], $product, $langId);
                    $count++;
                }
            }
            $this->info($count . ' product records synced successfully!' . " ---- with Language: $langId");
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }

    public function syncDishSet($data, $product, $langId = 2): void
    {
        try {
            $count = 0;
            // dd($data);
            foreach ($data as $dishSet) {
                $data = [
                    'DishsetID' => $dishSet['R_DishsetID'],
                    'blob' => 'product-options',
                    'Name' => $dishSet['R_DishsetName'] ?? $dishSet['R_DishsetName'],
                    'NameEN' => $dishSet['R_DishsetName2'] ?? $dishSet['R_DishsetName'],
                    'Type' => 0,
                ];
                // if($dishSet['R_ModifierItemBaseID'] == '200014'){
                //     dd('aaaa');
                // }
                if ($langId == 2) {
                } else {
                    ItemOption::upsert($data, 'DishsetID', ['Name', 'NameEN']);
                    // ItemOption::upsert($data, 'DishsetID', ['NameEN']);
                }
                $option = ItemOption::where('DishsetID', $dishSet['R_DishsetID'])->first();
                if ($option) {
                    $this->syncModifierList($dishSet, $option, $product, $langId);
                }
                $count++;
            }
            $this->info($count . ' basic options records synced successfully!' . " ---- with Language: $langId");
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }

    public function syncModifierList($dishSet, $option, $product, $langId = 2): void
    {
        try {
            $count = 0;
            foreach ($dishSet['R_ModifierList'] as $modifier) {
                if ($langId == 2) {
                } else {
                    $subOptionItem = $option->subOption()->where('Name', $modifier['R_ModifierName'])->first();
                    // $subOptionItem = $option->subOption()->first();
                    if($modifier['R_ModifierItemBaseID'] == '200014'){
// dd($option);

                        // dd($subOptionItem);
                    }
                }
                if (!$subOptionItem) {
                    $data = [
                        'OptID' => $option->id,
                        'ModifierID' => $modifier['R_ModifierID'],
                        'blob' => 'product-sub-options',
                        'Name' => $modifier['R_ModifierName'] ?? $modifier['R_ModifierName'],
                        'NameEN' => $modifier['R_ModifierName2'] ?? $modifier['R_ModifierName']
                    ];
                    // if($modifier['R_ModifierItemBaseID'] == '200014'){
                    //     dd('aaaa');
                    // }
                    if ($langId == 2) {
                    } else {
                        $option->subOption()->upsert($data, 'ModifierID', ['Name', 'NameEN']);
                        // $option->subOption()->upsert($data, 'ModifierID', ['NameEN']);
                    }

                    $subOption = SubOption::where('ModifierID', $modifier['R_ModifierID'])->first();
                    if ($subOption) {
                        $subOption->clearMediaCollection('product_sub_options');
                        $subOption->clearMediaCollection('attached_product_sub_options');
                        MediaService::addMediaFromUrl($subOption, $modifier['R_ModifierImageURL1'], 'product_sub_options');
                        MediaService::addMultipleMediaFromRequest($subOption, $modifier['R_ModifierImageURL1'], 'attached_product_sub_options');

                        $this->syncProductOptions($product, $option->id, $subOption->id, $modifier['R_PriceInCombo']);
                    }
                    $count++;
                }
            }
            $this->info($count . ' sub-options records synced successfully!' . " ---- with Language: $langId");
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }


    public function syncProductOptions($item, $optionId, $subOptionId, $AdditionalValue): void
    {
        try {
            $data = [
                'ItemID' => $item->id,
                'OptID' => $subOptionId,
                'blob' => 'products-options',
                'POptID' => $optionId,
                'AdditionalValue' => $AdditionalValue,
            ];

            $item->optionDetil()->upsert($data, ['POptID', 'OptID', 'ItemID', 'AdditionalValue']);
            $this->info('Added new option for item ' . $item->id);
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }

    protected function getToken()
    {
        try {
            $url = config('app.cake_api_url') . '/token';
            $response = Http::asForm()->post($url, [
                'username' => config('app.username'),
                'password' => config('app.password'),
                'grant_type' => config('app.grant_type'),
            ]);
            return $response->json()['access_token'];
        } catch (\Exception $e) {
            $this->error('An error occurred: ' . $e->getMessage());
        }
    }
}
