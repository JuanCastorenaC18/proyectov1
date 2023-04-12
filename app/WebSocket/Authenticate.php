namespace App\WebSocket;

use App\Events\UserAuthenticated;
use BeyondCode\LaravelWebSockets\WebSockets\Channels\ChannelManager;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Auth\Authenticatable;

class Authenticate
{
    protected $auth;

    protected $channelManager;

    public function __construct(AuthManager $auth, ChannelManager $channelManager)
    {
        $this->auth = $auth;
        $this->channelManager = $channelManager;
    }

    public function auth($request)
    {
        if (! $sessionId = $request->session_id) {
            return false;
        }

        if (! $user = $this->getUserBySessionId($sessionId)) {
            return false;
        }

        $this->auth->guard('web')->login($user);

        broadcast(new UserAuthenticated($user))->toOthers();

        return true;
    }

    protected function getUserBySessionId($sessionId)
    {
        return $this->channelManager->find($sessionId)->user ?? null;
    }
}