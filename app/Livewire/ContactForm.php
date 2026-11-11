<?php

namespace App\Livewire;

use App\Models\ContactMessage;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $phone = '';
    public string $municipality = '';
    public string $profession = '';
    public string $subject = 'Dúvida Geral / Informações';
    public string $message = '';

    public bool $sent = false;

    protected $rules = [
        'name' => 'required|min:3|max:120',
        'email' => 'required|email|max:150',
        'phone' => 'nullable|min:8|max:20',
        'municipality' => 'required|string|max:100',
        'profession' => 'required|string|max:100',
        'subject' => 'required|string|max:150',
        'message' => 'required|min:10|max:2000',
    ];

    protected $messages = [
        'name.required' => 'Por favor, informe seu nome completo.',
        'email.required' => 'O endereço de e-mail institucional ou pessoal é obrigatório.',
        'email.email' => 'Informe um e-mail válido.',
        'municipality.required' => 'Informe o município de atuação em Mato Grosso.',
        'profession.required' => 'Informe sua profissão ou função no SUS.',
        'message.required' => 'Descreva sua mensagem ou dúvida.',
        'message.min' => 'A mensagem deve conter ao menos 10 caracteres.',
    ];

    public function submit()
    {
        $this->validate();

        ContactMessage::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'municipality' => $this->municipality,
            'profession' => $this->profession,
            'subject' => $this->subject,
            'message' => $this->message,
            'is_read' => false,
        ]);

        $this->reset(['name', 'email', 'phone', 'municipality', 'profession', 'message']);
        $this->sent = true;
    }

    public function resetForm()
    {
        $this->sent = false;
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
