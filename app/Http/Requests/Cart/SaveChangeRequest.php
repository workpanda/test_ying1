<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Product, Offer, Delivery};
use App\Tools\Converter;

class SaveChangeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request
     *
     * @return array
     */
    public function rules()
    {
        return [
                // 'offer' => 'required',
                // 'delivery_method' => 'required'
            ];
    }

    /**
     * Add a new product in the cart session
     * @param Product $product
     *
     * @return Illuminate\Routing\Redirector
     */
    public function saveChange($product)
    {
        $products = session()->has('cart') ? session()->get('cart') : [];

        foreach ($products as &$productCart) {
            if ($productCart['product_id'] == $product) {
                $productCart['deliveryinfo'] = $this->deliveryinfo;
                $productCart['delivery_method_num'] =
                    $this->delivery_method_num;
                $productCart['paymthod'] = $this->paymethod;
                $productCart['quantity'] = $this->quantity;
                $productCart['total'] = Converter::currencyConverter(
                    $productCart['price'] +
                        $productCart['ships_price'][
                            $this->delivery_method_num + 1
                        ],
                    auth()->user()->currency,
                    $productCart['currency']
                );
                // $productCart->save();
                session()->forget('cart');
                session()->put('cart', $products);
            }
        }

        session()->flash('success', 'You have successfully saved changes!');
        return redirect()->route('cart');
    }
}