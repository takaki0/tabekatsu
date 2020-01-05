<?php

namespace App\Http\Controllers;

use App\Area;
use App\Http\Requests\MemberRegisterRequest;
use App\Member;
use App\Prefecture;
use Illuminate\Http\Request;

class MemberController extends Controller
{

    /**
     * register a new member.
     */
    public function store(MemberRegisterRequest $request)
    {

        $member = new Member;
        $data = $request->all();
        $password = $data['password'];
        unset($data['password']);
        $member->fill($data);
        $member->set_hashed_password($password);
        $member->set_login_id();
        $saved = $member->save();
        if (!$saved) {
            $response_data = [
                'result' => 'failed',
                'message' => 'failed to register your account.',
                'data' => [],
            ];
            return response()->json($response_data, 500);
        }

        //トークン取得
        $token = Member::generate_token($member->login_id);

        $response_data = [
            'result' => 'succeed',
            'message' => 'succeed to register your account.',
            'data' => [
                'token' => $token->token,
                'start_datetime' => $token->start_datetime->format('Y-m-d h:i:s'),
                'expires' => $token->expires,
                'refresh_token' => $token->refresh_token,
            ]
        ];
        return response()->json($response_data, 200);

    }

    /**
     * refresh token.
     */
    public function refresh_token(Request $request)
    {
        $data = $request->all();
        $token = Member::refresh_token($data['refresh_token']);
        if (!$token) {
            $response_data = [
                'result' => 'failed',
                'message' => 'failed to refresh your old token.',
                'data' => []
            ];
            return response()->json($response_data, 422);
        }

        $response_data = [
            'result' => 'succeed',
            'message' => 'succeed to refresh your old token.',
            'data' => [
                'token' => $token->token,
                'start_datetime' => $token->start_datetime->format('Y-m-d h:i:s'),
                'expires' => $token->expires,
                'refresh_token' => $token->refresh_token,
            ]
        ];
        return response()->json($response_data, 200);

    }

    public function areas()
    {
        return Area::all();
    }

    public function prefectures()
    {
        return Prefecture::all();
    }

}