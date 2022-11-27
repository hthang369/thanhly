<?php

namespace Services\ApprovalApiToken;

use App\Models\User;
use App\Services\ApprovalApiToken\ApprovalApiTokenService;
use Tests\TestCase;

class ApprovalApiTokenServiceTest extends TestCase {

    public function testDisableUser() {
        $this->actingAs(User::find(1));
        $this->get('system-admin/user-management-for-app-chat/disable-user/1');
    }
}
