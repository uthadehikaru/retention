<?php

namespace App\Filament\Agent\Resources;

use App\Filament\Agent\Resources\ContactResource\Pages;
use App\Filament\Agent\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('invoice_id')
                    ->relationship('invoice', 'invoice_no')
                    ->required(),
                Forms\Components\DateTimePicker::make('call_time')
                    ->required(),
                Forms\Components\Select::make('call_type')
                    ->options(Contact::CALL_TYPE)
                    ->required(),
                Forms\Components\Select::make('call_result')
                ->options(Contact::CALL_RESULT)
                    ->required(),
                Forms\Components\Textarea::make('detail')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('call_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('invoice.invoice_no')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('call_type')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('call_result')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
        ->whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('invoices')
                  ->join('customers','invoices.customer_id','customers.id')
                  ->whereColumn('contacts.invoice_id', 'invoices.id')
                  ->where('customers.agent_id', Auth::user()->agent?->id);
        })
        ;
    }
}
