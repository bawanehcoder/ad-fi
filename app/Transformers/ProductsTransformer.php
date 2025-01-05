<?php

namespace App\Transformers;

use App\Models\Category;
use App\Models\Item;
use Flugg\Responder\Transformers\Transformer;

class ProductsTransformer extends Transformer
{
    protected $relations = [];
    protected $load = [];
    public function transform(Item $item)
    {
        return [
            'id' => $item->id,
            'CatID' => $item->CatID,
            'Name' => $item->Name,
            'NameEN' => $item->NameEN,
            'Description' => $item->Description,
            'DescriptionEN' => $item->DescriptionEN,
            'Available' => $item->Available,
            'Price' => (string)$item->price(),
            'NewPrice' => $item->NewPrice,
            'Views' => $item->Views,
            'Rating' => $item->getAvarg(),
            'Stock' => $item->stock,
            'RatingCount' => $item->getRateCount(),
            'optionDetil' => $this->optionDetil($item),
            'isFavorited' => $item->isFavorite(),
            'Special' => $item->Special,
            'main_image' => [
                'large' => asset($item->getFirstMediaUrl('products', 'large')),
                'medium' => asset($item->getFirstMediaUrl('products', 'medium')),
                'small' => asset($item->getFirstMediaUrl('products', 'small')),
            ],
            'other_image' => [
                'large' => asset($item->getFirstMediaUrl('attached_products', 'large')),
                'medium' => asset($item->getFirstMediaUrl('attached_products', 'medium')),
                'small' => asset($item->getFirstMediaUrl('attached_products', 'small')),
            ],
        ];
    }
    public function optionDetil(Item $entity)
    {

        $options = $entity->optionDetil->groupBy('POptID');
        $data = [];
        foreach ($options ?? [] as $optin) {

            $data[$optin[0]->id] =
                [
                    'id' => $optin[0]->id,
                    'title_ar' => $optin[0]->subOption->itemOption->Name,
                    'title_en' => $optin[0]->subOption->itemOption->NameEN
                ];
            foreach ($optin as $i => $item) {
                $data[$optin[0]->id]['optin'][$i] =
                    [
                        'id' => $item->subOption->id,
                        'title_ar' => $item->subOption->Name,
                        'title_en' => $item->subOption->NameEN,
                        'AdditionalValue' => $item->AdditionalValue
                    ];
            }
        }
        return $data;
        return responder()->success(['options' => $data])->respond();
    }
}
