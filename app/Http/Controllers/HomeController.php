<?php

namespace App\Http\Controllers;

use App\Models\User as ModelsUser;
use DateTime;
use Illuminate\Http\Request;
use TomorrowIdeas\Plaid\Entities\User;
use TomorrowIdeas\Plaid\Plaid;


class HomeController extends Controller
{
    public $plaid;

    public function __construct() {
        $this->plaid = new Plaid( "60a8d74c2dd19f0010a1acdf", "0e5c4e3159daa2170f5a8712b11719", "sandbox");
    }

    public function createLinkToken()
    {
        $user = new User(ModelsUser::find(1)->id);
        $response = $this->plaid->tokens->create("Plaid Test App", "en", ["US"], $user, ["auth", "transactions"]);

        return response()->json($response);
    }

    public function getAccessToken($publicToken)
    {
        return $this->plaid->items->exchangeToken($publicToken)->access_token;
    }

    public function accounts(Request $request)
    {
        $public_token = $request->publicToken;
        $access_token = $this->getAccessToken($public_token);
        return response()->json($this->plaid->accounts->list($access_token));
    }

    public function transactions(Request $request)
    {
        $public_token = $request->publicToken;
        $access_token = $this->getAccessToken($public_token);
        $start_date = new DateTime();
        $start_date->modify("-7 day");
        $end_date = new DateTime();

        return response()->json($this->plaid->transactions->list($access_token, $start_date, $end_date));
    }
}
// public-sandbox-e29f494b-bc80-436e-b338-2088677ccdb2