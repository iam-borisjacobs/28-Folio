<?php

namespace App\Filament\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;

class ServicesBlock
{
    public static function make(): Block
    {
        return Block::make('services')
            ->label('Services / What I Do')
            ->icon('heroicon-m-squares-2x2')
            ->schema([
                TextInput::make('pre_title')
                    ->label('Pre-Title (e.g. • Cooperation)')
                    ->default('• Cooperation'),
                RichEditor::make('title')
                    ->label('Section Title (Select text to change Size or Color)')
                    ->default('<p>Designing solutions<br><strong>customized to meet your requirements</strong></p>')
                    ->required(),

                Repeater::make('services')
                    ->label('Service Cards')
                    ->schema([
                        \Filament\Forms\Components\FileUpload::make('icon')
                            ->label('Service Icon (Drag & Drop image)')
                            ->image()
                            ->directory('service-icons')
                            ->required(),
                        TextInput::make('title')
                            ->label('Service Title')
                            ->required(),
                        Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->required(),
                    ])
                    ->grid(2)
                    ->collapsible()
                    ->defaultItems(3),
                RichEditor::make('footer_text')
                    ->label('Footer Content (Select text to change Size or Color)')
                    ->default('<p>Excited to take on new projects and collaborate.</p><p><a href="#contact">Let\'s chat about your ideas. Reach out!</a></p>'),
            ]);
    }
}
