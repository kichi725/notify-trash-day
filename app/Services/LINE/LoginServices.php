<?php



namespace App\Services\LINE;

use Illuminate\Support\Facades\Http;

/**
 * @package App\Services\LINE\LoginServices
 */
class LoginServices
{
    public function __construct(private \App\Repositories\LINE\LoginRepositoryInterface $repository)
    {
    }

    /**
     * 認証URL生成
     *
     * @return string
     */
    public function createCredentialUrl(): string
    {
        $uri  = 'https://access.line.me/oauth2/v2.1/authorize';
        $data = [
            'response_type' => 'code',
            'client_id'     => config('services.line.client_id'),
            'redirect_uri'  => config('services.line.redirect'),
            'state'         => $this->randomString(),
            'scope'         => 'openid profile',
            'prompt'        => 'cnsent',
            'nonce'         => $this->randomString(),
        ];

        $query = http_build_query($data, '', null, PHP_QUERY_RFC3986);

        return "{$uri}?{$query}";
        // return "{$uri}?response_type=code&client_id={$client_id}&redirect_uri={$redirect_uri}&state={$state}&scope=openid%20profile&prompt=cnsent&nonce={$nonce}";
    }

    /**
     * ランダム文字列生成
     *
     * @return string
     */
    private function randomString(): string
    {
        return \Illuminate\Support\Str::random(32);
    }

    /**
     * アクセストークンを取得
     *
     * @param string $code
     * @return string
     */
    public function getAccessToken(string $code): string
    {
        $uri  = 'https://api.line.me/oauth2/v2.1/token';
        $data = [
          'grant_type'    => 'authorization_code',
          'code'          => $code,
          'redirect_uri'  => config('services.line.redirect'),
          'client_id'     => config('services.line.client_id'),
          'client_secret' => config('services.line.client_secret'),
        ];

        // 'Content-Type: application/x-www-form-urlencoded'で通信
        $response = Http::asForm()->post($uri, $data);

        $content = json_decode($response->getBody()->getContents(), true);

        info('json_decode', $content);

        return $content['access_token'];
    }

    /**
     * プロフィールを取得
     *
     * @param string $access_token
     * @return array
     */
    public function getProfile(string $access_token): array
    {
        $uri = 'https://api.line.me/v2/profile';

        $response = Http::withToken($access_token)->get($uri);

        $profile = json_decode($response->getBody()->getContents(), true);

        info('profile', ['profile' => $profile]);

        return $profile;
    }

    /**
     * ログイン処理
     *
     * @param string $code
     * @return void
     */
    public function login(string $code): void
    {
        $access_token = $this->getAccessToken($code);

        $profile = $this->getProfile($access_token);

        info('accesstoken', ['token' => $access_token]);

        $user = $this->repository->getUser($profile['userId']);

        if (is_null($user)) {
            $this->repository->store($profile);
        }

        auth()->login($user);
    }
}
