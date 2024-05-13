<?php

namespace App\Filament\Agent\Resources;

use App\Filament\Agent\Resources\ContactResource\Pages;
use App\Filament\Agent\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
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
                Forms\Components\Select::make('invoice_agent_id')
                    ->label('Invoice')
                    ->relationship('invoiceAgent', 'invoices.invoice_no', function($query){
                        $query->join('invoices','invoices.id','invoice_agents.invoice_id')
                        ->where('agent_id',Auth::user()->agent->id)
                        ->whereDate('start_date','<=',Carbon::now())
                        ->whereDate('end_date','>=',Carbon::now());
                    })
                    ->required(),
                Forms\Components\DateTimePicker::make('call_time')
                    ->required(),
                Forms\Components\Select::make('call_type')
                    ->required()
                    ->options(Contact::CALL_TYPE),
                Forms\Components\Select::make('call_result')
                    ->required()
                    ->options(Contact::CALL_RESULT)
                    ->live(),
                Forms\Components\Textarea::make('notes')
                    ->maxLength(65535),
                Forms\Components\Select::make('detail')
                    ->options(fn (Get $get): array => match ($get('call_result')) {
                        Contact::CALL_RESULT_CONTACTED => Contact::CALL_RESPONSE_CONTACTED,
                        Contact::CALL_RESULT_UNCONTACTED => Contact::CALL_RESPONSE_UNCONTACTED,
                        default => [],
                    })
                    ->hidden(fn (Get $get): bool => !$get('call_result') || $get('call_result')==Contact::CALL_RESULT_DELIVERED),
                Forms\Components\Select::make('promo_id')
                    ->label('Promo')
                    ->relationship(name: 'promo', titleAttribute: 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('call_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('invoiceAgent.invoice.invoice_no')
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
        ->whereHas('invoiceAgent', function($query){
            $query->assigned();
        })
        ;
    }
}
