<?php

namespace Modules\Chats\Entities;

use AhmedAliraqi\LaravelMediaUploader\Entities\Concerns\HasUploader;
use App\Helpers\Selectable;
use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Modules\Chats\Entities\Helpers\ChatHelpers;
use Modules\Chats\Database\factories\ChatFactory;
use Modules\Chats\Entities\Relations\ChatRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @property int $id
 * @property int $receiver_id
 * @property int $sender_id
 * @property string $message
 * @property \Carbon\Carbon $read_at
 */
class Chat extends Model implements HasMedia
{
    use HasFactory,
        ChatRelations,
        ChatHelpers,
        Filterable,
        Selectable,
        HasUploader,
        InteractsWithMedia,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'receiver_id',
        'sender_id',
        'message'
    ];

    protected static function newFactory(): ChatFactory
    {
        return ChatFactory::new();
    }
}
