<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    /**
     * protected クラスの中の変数
     * $fillable 埋め込める
     * ['user_id', 'name']; 埋め込める値（テーブルのカラム名'user_id', 'name'）
     */

    /**
     * タスクを保持するユーザーの取得
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
