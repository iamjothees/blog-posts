<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Livewire\Component;

class Register extends Component implements HasForms
{
    use InteractsWithForms;

    public array $data = [];

    protected function form(Form $form): Form
    {
        return $form
            ->model(User::class)
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255)
                    ->unique('users', 'email'),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('filament.pages.register');
    }

    public function register()
    {
        $data = $this->form->getState();

        $user = User::create($data);
        
        auth()->login($user);
        return redirect()->route('filament.admin.pages.dashboard');
    }
}
