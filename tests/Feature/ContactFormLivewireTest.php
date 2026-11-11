<?php

namespace Tests\Feature;

use App\Livewire\ContactForm;
use App\Models\ContactMessage;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormLivewireTest extends TestCase
{
    public function test_contact_form_validates_required_fields(): void
    {
        Livewire::test(ContactForm::class)
            ->call('submit')
            ->assertHasErrors(['name', 'email', 'municipality', 'profession', 'message']);
    }

    public function test_contact_form_submits_message_successfully(): void
    {
        Livewire::test(ContactForm::class)
            ->set('name', 'Dra. Ana Silva')
            ->set('email', 'ana.silva@saude.mt.gov.br')
            ->set('phone', '65999887766')
            ->set('municipality', 'Sinop')
            ->set('profession', 'Médica de Família e Comunidade')
            ->set('subject', 'Adesão ao IntegraSUS Digital MT')
            ->set('message', 'Gostaria de solicitar treinamento e implantação do retinógrafo no nosso polo regional.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('sent', true);

        $this->assertDatabaseHas('contact_messages', [
            'name' => 'Dra. Ana Silva',
            'email' => 'ana.silva@saude.mt.gov.br',
            'municipality' => 'Sinop',
        ]);
    }
}
