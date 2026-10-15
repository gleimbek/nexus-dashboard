<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminUserManagementTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        $admin = User::factory()->create();
        $admin->forceFill(['role' => 'admin'])->save();

        return $admin;
    }

    private function regularUser(): User
    {
        return User::factory()->create();
    }

    // --- Guests ---

    public function test_guests_are_sent_to_login(): void
    {
        $other = $this->regularUser();

        $this->get('/admin/users')->assertRedirect('/login');
        $this->get("/admin/users/{$other->id}/edit")->assertRedirect('/login');
        $this->put("/admin/users/{$other->id}", ['name' => 'X', 'email' => 'x@example.com'])->assertRedirect('/login');
        $this->delete("/admin/users/{$other->id}")->assertRedirect('/login');
    }

    // --- Regular users get 403 everywhere and change nothing ---

    public function test_regular_user_cannot_list_users(): void
    {
        $this->actingAs($this->regularUser())->get('/admin/users')->assertForbidden();
    }

    public function test_regular_user_cannot_open_edit_form(): void
    {
        $other = $this->regularUser();

        $this->actingAs($this->regularUser())->get("/admin/users/{$other->id}/edit")->assertForbidden();
    }

    public function test_regular_user_cannot_change_another_users_email(): void
    {
        $victim = $this->regularUser();

        $this->actingAs($this->regularUser())
            ->put("/admin/users/{$victim->id}", ['name' => 'Hijacked', 'email' => 'attacker@example.com'])
            ->assertForbidden();

        $this->assertSame($victim->email, $victim->fresh()->email);
    }

    public function test_regular_user_cannot_delete_another_user(): void
    {
        $victim = $this->regularUser();

        $this->actingAs($this->regularUser())->delete("/admin/users/{$victim->id}")->assertForbidden();

        $this->assertNotNull($victim->fresh());
    }

    public function test_users_link_is_hidden_from_regular_users(): void
    {
        $this->actingAs($this->regularUser())->get('/dashboard')->assertOk()->assertDontSee('/admin/users');
    }

    // --- Admins ---

    public function test_admin_sees_every_user_with_their_own_actions(): void
    {
        $admin = $this->admin();
        $a = $this->regularUser();
        $b = $this->regularUser();

        $this->actingAs($admin)->get('/admin/users')
            ->assertOk()
            ->assertSee($a->email)
            ->assertSee($b->email)
            ->assertSee(route('admin.users.edit', $a), false)
            ->assertSee(route('admin.users.edit', $b), false)
            ->assertSee(route('admin.users.destroy', $a), false)
            ->assertSee(route('admin.users.destroy', $b), false);
    }

    public function test_admin_can_update_a_user(): void
    {
        $admin = $this->admin();
        $user = $this->regularUser();

        $this->actingAs($admin)
            ->put("/admin/users/{$user->id}", ['name' => 'New Name', 'email' => 'new@example.com'])
            ->assertRedirect('/admin/users');

        $this->assertSame('New Name', $user->fresh()->name);
        $this->assertSame('new@example.com', $user->fresh()->email);
    }

    public function test_admin_cannot_give_a_user_an_email_that_is_already_taken(): void
    {
        $admin = $this->admin();
        $user = $this->regularUser();
        $other = $this->regularUser();

        $this->actingAs($admin)
            ->from("/admin/users/{$user->id}/edit")
            ->put("/admin/users/{$user->id}", ['name' => $user->name, 'email' => $other->email])
            ->assertSessionHasErrors('email');
    }

    public function test_admin_can_keep_the_same_email_when_editing(): void
    {
        $admin = $this->admin();
        $user = $this->regularUser();

        $this->actingAs($admin)
            ->put("/admin/users/{$user->id}", ['name' => 'Renamed', 'email' => $user->email])
            ->assertSessionHasNoErrors();
    }

    public function test_admin_can_delete_another_user(): void
    {
        $admin = $this->admin();
        $user = $this->regularUser();

        $this->actingAs($admin)->delete("/admin/users/{$user->id}")->assertRedirect('/admin/users');

        $this->assertNull($user->fresh());
    }

    public function test_admin_cannot_delete_themselves_from_the_list(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->delete("/admin/users/{$admin->id}")->assertRedirect('/admin/users');

        $this->assertNotNull($admin->fresh());
    }
}
