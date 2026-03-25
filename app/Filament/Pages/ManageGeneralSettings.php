<?php

namespace App\Filament\Pages;

use App\Services\SettingService;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;

class ManageGeneralSettings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'System';
    protected static ?string $title = 'General Settings';
    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.manage-general-settings';

    public ?array $data = [];

    public function mount(SettingService $settings): void
    {
        $this->form->fill([
            'site_name' => $settings->get('site_name'),
            'site_tagline' => $settings->get('site_tagline'),
            'site_description' => $settings->get('site_description'),
            'primary_email' => $settings->get('primary_email'),
            'hero_title' => $settings->get('hero_title'),
            'hero_highlight_text' => $settings->get('hero_highlight_text', '{Full Stack}'),
            'hero_highlight_color' => $settings->get('hero_highlight_color', '#22c55e'),
            'hero_title_cursor_color' => $settings->get('hero_title_cursor_color', '#ec4899'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Site Settings')->schema([
                    TextInput::make('site_name'),
                    TextInput::make('site_tagline'),
                    Textarea::make('site_description'),
                    TextInput::make('primary_email')->email(),
                ])->columns(2)
            ])
            ->statePath('data');
    }

    public function save(SettingService $settings): void
    {
        $state = $this->form->getState();
        
        foreach ($state as $key => $value) {
            $settings->set($key, $value);
        }

        Notification::make()
            ->title('Settings saved successfully.')
            ->success()
            ->send();
    }
}
