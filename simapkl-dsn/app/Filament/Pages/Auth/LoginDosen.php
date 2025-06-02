<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Login;
use Filament\Pages\Page;
use Illuminate\Validation\ValidationException;

class LoginDosen extends Login
{

    public function mount(): void
    {
        parent::mount();

        if (app()->environment('local')) {
            $this->form->fill([
                'password' => 'password',
                'remember' => true,
            ]);
        }
    }

    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getLoginFormComponent(),
                        $this->getPasswordFormComponent(),
                        $this->getRememberFormComponent(),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('login')
            ->label(__('NIP'))
            ->required()
            ->autocomplete()
            ->autofocus();
    }

    protected function getUserModel(): string
    {
        return \App\Models\Dospem::class;
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $loginType = 'nip';

        return [
            $loginType => $data['login'],
            'password' => $data['password'],
        ];
    }

    protected function throwFailureValidationException(): never
    {
        throw ValidationException::withMessages([
            'data.nip' => __('filament-panels::pages/auth/login.messages.failed'),
        ]);
    }

    protected function getAuthGuard(): string
    {
        return 'dospem';
    }
}
