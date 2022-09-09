<?php

namespace App\Http\Requests\Cart;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\{Product, Offer, Delivery};
use App\Tools\Converter;
class AddToCartRequest extends FormRequest
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
    public function add(Product $product)
    {
        #Get auth user
        $user = auth()->user();

        if ($user->id == $product->seller->id) {
            throw new \Exception('This product belongs to you!');
        }

        #Get offer
        // $offer = Offer::find($this->offer);

        #Check if an offer is for the product that will be added to the cart
        // if (
        //     is_null($offer) or
        //     $offer->product_id !== $product->id or
        //     $offer->deleted == true
        // ) {
        //     throw new \Exception('The chosen offer is invalid!');
        // }

        #Get delivery method
        // $delivery = Delivery::find($this->delivery_method);

        #Check if an delivery method is for the product that will be added to the cart
        // if (
        //     is_null($delivery) or
        //     $delivery->product_id !== $product->id or
        //     $delivery->deleted == true
        // ) {
        //     throw new \Exception('The chosen delivery method is invalid!');
        // }

        #Get all products from the cart or return an empty array
        $products = session()->has('cart') ? session()->get('cart') : [];

        #Checks if the product already exists in the cart and if it does, just update it
        foreach ($products as $index => $productCart) {
            if ($productCart['product_id'] == $product->id) {
                unset($products[$index]);
            }
        }

        #Update the session
        session()->put('cart', $products);

        $ships_with = json_decode($product->ships_with, true);
        $ships_time = json_decode($product->ships_time, true);
        $ships_price = json_decode($product->ships_price, true);
        if ($ships_with[3] != null) {
            $delivery_method = [
                $ships_with[1] .
                ' - Price ' .
                Converter::currencyConverter(
                    $ships_price[1],
                    $user->currency,
                    $product->currency
                ) .
                $user->currency .
                ' - ' .
                $ships_time[1] .
                ' Days Average',
                $ships_with[2] .
                ' - Price ' .
                Converter::currencyConverter(
                    $ships_price[2],
                    $user->currency,
                    $product->currency
                ) .
                $user->currency .
                ' - ' .
                $ships_time[2] .
                ' Days Average',
                $ships_with[3] .
                ' - Price ' .
                Converter::currencyConverter(
                    $ships_price[3],
                    $user->currency,
                    $product->currency
                ) .
                $user->currency .
                ' - ' .
                $ships_time[3] .
                ' Days Average',
            ];
        } elseif ($ships_with[2] != null) {
            $delivery_method = [
                $ships_with[1] .
                ' - Price ' .
                Converter::currencyConverter(
                    $ships_price[1],
                    $user->currency,
                    $product->currency
                ) .
                $user->currency .
                ' - ' .
                $ships_time[1] .
                ' Days Average',
                $ships_with[2] .
                ' - Price ' .
                Converter::currencyConverter(
                    $ships_price[2],
                    $user->currency,
                    $product->currency
                ) .
                $user->currency .
                ' - ' .
                $ships_time[2] .
                ' Days Average',
            ];
        } elseif ($ships_with[1] != null) {
            $delivery_method = [
                $ships_with[1] .
                ' - Price ' .
                Converter::currencyConverter(
                    $ships_price[1],
                    $user->currency,
                    $product->currency
                ) .
                $user->currency .
                ' - ' .
                $ships_time[1] .
                ' Days Average',
            ];
        }
        #Add to session cart
        session()->push('cart', [
            'product_id' => $product->id,
            'product_name' => $product->name,
            'seller_id' => $product->seller->id,
            'seller' => $product->seller->username,
            'quantity' => $product->quantity . ' ' . $product->mesure,
            'price' => $product->price,
            'currency' => $product->currency,
            'image' => $product->image,
            'paytype' => $product->paytype,
            'type' => $product->type,
            'autofilled' => $product->autofilled,
            'deliveryinfo' => $product->deliveryinfo,
            'paymethod' => $product->paymethod,
            'ships_price' => $ships_price,
            'ships_with' => $ships_with,
            'ships_time' => $ships_time,
            'delivery_method_num' => 0,
            'delivery_method' => $delivery_method,
            // 'delivery_price' => $delivery->price,
            // 'delivery_method' =>
            //     $delivery->name . ' - ' . $delivery->days . ' day(s)',
            // 'total' => $delivery->price + $product->price,
            'total' => Converter::currencyConverter(
                $product->price + $ships_price[1],
                $user->currency,
                $product->currency
            ),
        ]);
        return redirect()->route('cart');
    }
}