<?php

declare(strict_types=1);

namespace App\Http\Controllers\LINE;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function __construct(private \App\Services\LINE\LoginServices $service)
    {
    }

    /**
     * 認証処理
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function credential(): \Illuminate\Http\RedirectResponse
    {
        $url = $this->service->createCredentialUrl();

        return redirect($url);
    }

    /**
     * callback処理
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->service->login($request->code);

        return redirect()->route('top');
    }
}
