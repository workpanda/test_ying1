<?php

namespace App\Http\Requests\User\Balance;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\Tools\Converter;
use App\Models\Transition;

class WithdrawRequest extends FormRequest
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
            'monero_wallet_address' => 'required',
            'value' => 'required|numeric|min:1',
            'pin' => 'required',
        ];
    }

    /**
     * Withdraw bitcoin
     *
     * @return Illuminate\Routing\Redirector
     */
    public function withdraw()
    {
        #Get auth user
        $user = auth()->user();
        \Monerod::validateAddress($this->monero_wallet_address);

        if (!Hash::check($this->pin, $user->pin)) {
            throw new \Exception('The PIN is incorrect!');
        }

        #Convert the value entered in USD to XMR
        $amount = Converter::moneroConverter($this->value);

        #Compare
        if ($amount > $user->balance()) {
            throw new \Exception(
                'Whoops! You cannot withdraw more than the current balance.'
            );
        }

        $walletReceiver = $this->monero_wallet_address;

        if ($walletReceiver == $user->monero_wallet) {
            throw new \Exception('You cannot send it to your self!');
        }

        \Monerod::transfer($amount, $walletReceiver, $user->id);

        #Create a transition record
        $transition = new Transition();
        $transition->user_id = $user->id;
        $transition->action = 'Monero withdrawal';
        $transition->amount = "-$amount";
        $transition->balance = $user->balance();
        $transition->save();

        session()->flash('success', 'Successfully Sent!');
        return redirect()->route('balance');
    }
}