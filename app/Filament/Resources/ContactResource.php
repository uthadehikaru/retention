<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('invoice_agent_id')
                    ->label('Invoice')
                    ->relationship('invoiceAgent', 'invoices.invoice_no', function($query){
                        $query->join('invoices','invoices.id','invoice_agents.invoice_id');
                        if(Auth::user()->agent)
                            $query->where('agent_id',Auth::user()->agent->id);
                    })
                    ->required(),
                Forms\Components\DateTimePicker::make('call_time')
                    ->required(),
                Forms\Components\Select::make('call_type')
                    ->required()
                    ->options(Contact::CALL_TYPE),
                Forms\Components\Select::make('call_result')
                    ->required()
                    ->options(Contact::CALL_RESULT),
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
                Tables\Columns\TextColumn::make('invoiceAgent.invoice.invoice_no')
                    ->sortable(),
                Tables\Columns\TextColumn::make('invoiceAgent.agent.name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('call_time')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('call_type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('call_result')
                    ->searchable(),
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
}
