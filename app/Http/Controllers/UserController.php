<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Gate, Crypt};
use App\Http\Requests\User\Settings\{
    ChangeAvatarRequest,
    ChangePasswordRequest,
    ChangePINRequest,
    ChangeBackupWalletRequest,
    ChangePGPKeyRequest,
    ChangeDescriptionRequest
};
use App\Http\Requests\User\Balance\{TransferRequest, WithdrawRequest};
use App\Http\Requests\User\Conversation\{
    NewConversationRequest,
    NewConversationMessageRequest,
    OpenConversationMessagesRequest
};
use App\Models\{
    Conversation,
    Product,
    Favorite,
    Order,
    Transition,
    Livefeeds,
    User
};

class UserController extends Controller
{
    /**
     * Show user online status.
     */
    public function userOnlineStatus()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Cache::has('user-is-online-' . $user->id)) {
                echo $user->name .
                    ' is online. Last seen: ' .
                    Carbon::parse($user->last_seen)->diffForHumans() .
                    ' <br>';
            } else {
                echo $user->name .
                    ' is offline. Last seen: ' .
                    Carbon::parse($user->last_seen)->diffForHumans() .
                    ' <br>';
            }
        }
    }
    /**
     * Redirects the authenticated user who does not have a PGP Key defined for this view
     *
     * @return Illuminate\Support\Facades\View
     */

    public function viewPGP()
    {
        return view('user.pgp');
    }

    public function viewWelcome()
    {
        return view('welcome');
    }

    public function viewSetPGPKey()
    {
        #Get auth user
        $user = auth()->user();

        if (is_null($user->pgp_key)) {
            return view('setpgpkey');
        }

        return abort(404);
    }

    /**
     * Create a request to set the PGP key
     *
     * @return App\Http\Requests\User\Settings\ChangePGPKeyRequest
     */
    public function postSetPGPKey(ChangePGPKeyRequest $request)
    {
        try {
            return $request->createRequisition();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Confirm the verification code and set the PGP key entered
     *
     * @return App\Http\Requests\User\Settings\ChangePGPKeyRequest
     */
    public function putSetPGPKey(ChangePGPKeyRequest $request)
    {
        try {
            return $request->change();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Cancel PGP key HTTP request
     *
     * @return Illuminate\Routing\Redirector
     */
    public function cancelSetPGPKey()
    {
        if (
            session()->has('verification_name') and
            session()->get('verification_name') === 'confirm_new_pgp_key'
        ) {
            #Destroy verification sessions
            session()->forget([
                'pgp_key',
                'verification_name',
                'encrypted_message',
                'verification_code',
            ]);
        }

        return redirect()->back();
    }

    /**
     * Statistics view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewStatistics()
    {
        #Get auth user
        $user = auth()->user();

        return view('user.statistics', [
            'user' => $user,
        ]);
    }

    /**
     * History view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewHistory()
    {
        #Get auth user
        $user = auth()->user();

        return view('user.history', [
            'transitions' => $user->transitions()->paginate(25),
        ]);
    }

    /**
     * Clear account historic
     *
     * @return Illuminate\Routing\Redirector
     */
    public function clearHistory()
    {
        #Get auth user
        $user = auth()->user();
        $transitions = $user->transitions()->get();

        foreach ($transitions as $transition) {
            $transition->delete();
        }

        return redirect()->route('history');
    }

    /**
     * Settings view
     *
     * @return Illuminate\Suport\Facades\View
     */
    public function viewSettings()
    {
        return view('user.settings');
    }

    /**
     * Change avatar HTTP request
     * @param  ChangeAvatarRequest $request
     *
     * @return App\Http\Requests\User\Settings\ChangeAvatarRequest
     */
    public function putChangeAvatar(ChangeAvatarRequest $request)
    {
        try {
            return $request->change();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Change password HTTP request
     * @param  ChangePasswordRequest $request
     *
     * @return App\Http\Requests\User\Settings\ChangePasswordRequest
     */

    public function putChangePassword(ChangePasswordRequest $request)
    {
        try {
            return $request->change();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function saveDescription(ChangeDescriptionRequest $request)
    {
        try {
            return $request->save();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Change PIN HTTP request
     * @param  ChangePINRequest $request
     *
     * @return App\Http\Requests\User\Settings\ChangePINRequest
     */
    public function putChangePIN(ChangePINRequest $request)
    {
        try {
            return $request->change();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Change currency HTTP request
     * @param Request $request
     *
     * @return Illuminate\Routing\Redirector
     */
    public function postChangeCurrency(Request $request)
    {
        #Get auth user
        $user = auth()->user();

        if (in_array($request->currency, config('currencies'))) {
            session()->flash(
                'success',
                'You have successfully changed your Currency!'
            );
            $user->currency = $request->currency;
            $user->save();
        }

        return redirect()->route('settings');
    }

    /**
     * Change wallet HTTP request
     * @param  ChangeWalletRequest $request
     *
     * @return App\Http\Requests\User\Settings\ChangeWalletRequest
     */
    public function putChangeBackupWallet(ChangeBackupWalletRequest $request)
    {
        try {
            return $request->change();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Change PGP key|Create requisition HTTP request
     * @param  ChangePGPKeyRequest $request
     *
     * @return App\Http\Requests\User\Settings\ChangePGPKeyRequest
     */
    public function postChangePGPKey(ChangePGPKeyRequest $request)
    {
        try {
            return $request->createRequisition();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->route('pgp');
        }
    }

    /**
     * Change PGP key|Change HTTP request
     * @param  ChangePGPKeyRequest $request
     *
     * @return App\Http\Requests\User\Settings\ChangePGPKeyRequest
     */
    public function putChangePGPKey(ChangePGPKeyRequest $request)
    {
        try {
            return $request->change();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Cancel PGP key change HTTP request
     *
     * @return Illuminate\Routing\Redirector
     */
    public function cancelPGPKeyChange()
    {
        if (
            session()->has('verification_name') and
            session()->get('verification_name') === 'confirm_new_pgp_key'
        ) {
            #Destroy verification sessions
            session()->forget([
                'pgp_key',
                'verification_name',
                'encrypted_message',
                'verification_code',
            ]);
        }

        return redirect()->route('pgp');
    }

    /**
     * View account index
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewAccountIndex()
    {
        #Get auth user
        $user = auth()->user();

        return view('user.index', [
            'wallet' => $user->monero_wallet,
        ]);
    }

    public function view2FAsetting()
    {
        return view('user.2fa-settings');
    }

    public function enable2FA()
    {
        #Get auth user
        $user = auth()->user();

        // if (is_null($user->pgp_key)) {
        //     throw new \Exception(
        //         'You must have a pgp key linked to enable 2FA!'
        //     );
        // }
        if (is_null($user->pgp_key)) {
            session()->flash(
                'error',
                'You must have a pgp key linked to enable 2FA!'
            );
            return redirect()->back();
        }
        $user->two_factor = '1';
        $user->save();

        $livefeed = new Livefeeds();
        $livefeed->event = $user->username . ' has activated 2FA.';
        $livefeed->type = '2fa';
        $livefeed->save();

        session()->flash('success', 'You have successfully enabled 2FA!');
        return redirect()->back();
    }

    public function disable2FA()
    {
        #Get auth user
        $user = auth()->user();
        $user->two_factor = '0';
        $user->save();

        session()->flash('success', 'You have successfully disabled 2FA!');
        return redirect()->back();
    }
    public function putTwoFactorAuthentication()
    {
        // return abort(404);
    }

    /**
     * Transfer HTTP request
     * @param  TransferRequest $request
     *
     * @return App\Http\Requests\User\Balance\TransferRequest
     */
    public function postTransfer(TransferRequest $request)
    {
        try {
            return $request->transfer();
        } catch (\Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Withdraw HTTP request
     * @param  WithdrawRequest $request
     *
     * @return App\Http\Requests\User\Balance\WithdrawRequest
     */

    public function viewWallet()
    {
        return view('user.payment');
    }

    public function viewExchange()
    {
        return view('user.exchange');
    }

    public function postWithdraw(WithdrawRequest $request)
    {
        try {
            return $request->withdraw();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function viewWalletSettings()
    {
        return view('user.paymentsettings');
    }
    /**
     * Affiliate view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewAffiliate()
    {
        #Get auth user
        $user = auth()->user();

        return view('user.affiliate', [
            'reference' => $user->reference,
        ]);
    }

    /**
     * Checks whether the user is part of the conversation and whether they can see or send a message
     * @param  Conversation $conversation
     *
     * @return \Illuminate\Http\Response
     */
    private function checkConversation(Conversation $conversation)
    {
        if (Gate::denies('conversation', $conversation)) {
            return abort(404);
        }
    }

    /**
     * Conversations view
     * @param  Request $request
     *
     * @return Illuminate\Support\Facades\View
     */

    public function viewConversations()
    {
        return view('user.conversations');
    }

    public function openConversationMessages(
        OpenConversationMessagesRequest $request,
        Conversation $selectedconv
    ) {
        try {
            return $request->open($selectedconv);
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    public function viewConversationMessages(Conversation $conversation)
    {
        $conversation->markMessagesAsRead();
        return view('user.conversationmessages', [
            'conversations' => Conversation::myMessages(),
            'selectedconv' => $conversation,
        ]);
    }

    public function createNewConversation(User $vendor)
    {
        $conv = Conversation::where('receiver_id', $vendor->id)->where(
            'issuer_id',
            auth()->user()->id
        );

        if ($conv->count() != 0) {
            return view('user.conversations');
        }
        $conversation = new Conversation();
        $conversation->issuer_id = auth()->user()->id;
        $conversation->receiver_id = $vendor->id;
        $conversation->save();

        return view('user.conversations');
    }

    /**
     * New conversation
     * @param  NewConversationRequest $request
     *
     * @return App\Http\Requests\User\Conversation\NewConversationRequest
     */
    public function postNewConversation(NewConversationRequest $request)
    {
        try {
            return $request->new();
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Conversation messages view
     * @param  Conversation $request
     *
     * @return Illuminate\Support\Facades\View
     */
    // public function viewConversationMessages(Conversation $conversation)
    // {
    //     $this->checkConversation($conversation);

    //     #Mark unread messages from the conversation as read
    //     $conversation->markMessagesAsRead();

    //     return view('user.conversationmessages', [
    //         'conversation' => $conversation,
    //         'conversationMessages' => $conversation
    //             ->conversationMessages()
    //             ->paginate(10),
    //     ]);
    // }

    /**
     * New conversation message
     * @param  NewConversationMessageRequest $request
     * @param  Conversation 				 $conversation
     *
     * @return App\Http\Requests\User\Conversation\NewConversationMessageRequest
     */
    public function postNewConversationMessage(
        NewConversationMessageRequest $request,
        Conversation $conversation
    ) {
        $this->checkConversation($conversation);

        try {
            return $request->new($conversation);
        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Favorites view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewFavorites()
    {
        #Get auth user
        $user = auth()->user();

        return view('user.favorites', [
            'favorites' => $user->favorites()->paginate(10),
        ]);
    }

    /**
     * Favorites HTTP request
     * @param  Product $product
     *
     * @return Illuminate\Routing\Redirector
     */
    public function postFavorites(Product $product)
    {
        #Get auth user
        $user = auth()->user();

        #Check whether the product is a favorite or not
        $favorite = Favorite::where('product_id', $product->id)
            ->where('user_id', $user->id)
            ->first();

        if (is_null($favorite)) {
            $favorite = new Favorite();
            $favorite->product_id = $product->id;
            $favorite->user_id = $user->id;
            $favorite->save();
            session()->flash(
                'success',
                'You have successfully added to Wishlist!'
            );
        } else {
            $favorite->delete();
            session()->flash(
                'success',
                'You have successfully removed to Wishlist!'
            );
        }

        return redirect()->back();
    }

    /**
     * All orders view
     * @param  $status
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewOrders($status)
    {
        #Get auth user
        $user = auth()->user();

        if (
            !is_null($status) and
            in_array($status, config('general.order_status'))
        ) {
            return view('user.orders', [
                'status' => $status,
                'user' => $user,
                'orders' => $user
                    ->orders()
                    ->where('status', $status)
                    ->paginate(25),
            ]);
        } elseif ($status === 'all') {
            return view('user.orders', [
                'status' => $status,
                'user' => $user,
                'orders' => $user->orders()->paginate(25),
            ]);
        } else {
            return abort(404);
        }
    }

    /**
     * Notifications view
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewNotifications()
    {
        #Get auth user
        $user = auth()->user();

        \App\Models\Notification::markNotificationAsRead();

        return view('user.notifications', [
            'notifications' => $user->notifications()->paginate(25),
        ]);
    }

    /**
     * Clear notifications
     *
     * @return Illuminate\Routing\Redirector
     */
    public function deleteNotifications()
    {
        #Get auth user
        $user = auth()->user();

        #Get user notifications
        $notifications = $user->notifications()->get();

        foreach ($notifications as $notification) {
            $notification->delete();
        }

        return redirect()->route('notifications');
    }

    /**
     * Returns the pgp key of the authenticated user
     *
     * @return Illuminate\Support\Facades\View
     */
    public function viewPgpKey()
    {
        return view('user.pgpkey', [
            'key' => auth()->user()->pgp_key,
        ]);
    }
}