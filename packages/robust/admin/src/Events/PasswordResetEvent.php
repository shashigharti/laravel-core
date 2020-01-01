<?php
namespace Robust\Admin\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\InteractsWithSockets;
use Robust\Admin\Models\User;
use Robust\Core\Helpage\Site;

/**
 * Class UserCreatedEvent
 * @package Robust\Admin\Events
 */
class PasswordResetEvent
{
    use InteractsWithSockets, SerializesModels;

    public $user;
    public $token;

    /**
     * UserCreatedEvent constructor.
     */
    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }
}