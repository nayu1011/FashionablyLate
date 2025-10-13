<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Contact;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_displays_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('お問い合わせ');
    }

    public function test_contact_form_validation_requires_fields(): void
    {
        $response = $this->post('/confirm', []);

        $response->assertSessionHasErrors([
            'first_name',
            'last_name',
            'gender',
            'email',
            'tel',
            'address',
            'content',
        ]);
    }

    public function test_contact_form_submits_successfully(): void
    {
        $contactData = [
            'first_name' => '山田',
            'last_name' => '太郎',
            'gender' => 1,
            'email' => 'test@example.com',
            'tel' => '080-1234-5678',
            'address' => '東京都渋谷区千駄ヶ谷1-2-3',
            'building' => '千駄ヶ谷マンション101',
            'content' => 'お問い合わせのテストです。',
        ];

        $response = $this->post('/confirm', $contactData);
        $response->assertStatus(200);
        $response->assertSee('内容確認');

        $response = $this->post('/thanks', $contactData);
        $response->assertRedirect('/thanks');

        $this->assertDatabaseHas('contacts', [
            'email' => 'test@example.com',
            'first_name' => '山田',
            'last_name' => '太郎',
        ]);
    }
}
