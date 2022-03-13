<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\AuthMailList
 *
 * @property int $id
 * @property int $user_id
 * @property string $type 타입
 * @property int $is_send 메일 전송 상태
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMailList newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMailList newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMailList query()
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMailList whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMailList whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMailList whereIsSend($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMailList whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMailList whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AuthMailList whereUserId($value)
 * @mixin \Eloquent
 */
class AuthMailList extends Model
{
    use HasFactory;

    public function getUser(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function getTypeRegister(): string
    {
        return 'register';
    }

    public function getTypePasswordReset(): string
    {
        return 'password-reset';
    }

    public function addSandList($user_id, $type): static
    {
        $this->user_id = $user_id;
        $this->type = $type;
        $this->save();

        return $this;
    }
}
