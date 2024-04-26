<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumReply extends Model
{
    use HasFactory;
    protected $table = 'forum_replys';

    protected $fillable = ['comment_id', 'replied_by', 'reply_content', 'image'];
}
