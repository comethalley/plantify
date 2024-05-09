<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\User;
class RequestN extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table = 'request_tbl';
    protected $fillable = [
        'id',
        'farm_id',
        'supply_tool',
        'supply_tool1',
        'supply_tool2',
        'supply_seedling',
        'supply_seedling1',
        'supply_seedling2',
        'count_tool',
        'count_tool1',
        'count_tool2',
        'count_seedling',
        'count_seedling1',
        'count_seedling2',
        'letter_content',
        'requested_by',
        'status',
        'picked_date',
        'date_return',
    ];

    public function farm()
    {
        return $this->belongsTo(Farm::class);
    }

    public function supplyTool()
    {
        return $this->belongsTo(SupplyType::class, 'supply_tool');
    }

    public function supplySeedling()
    {
        return $this->belongsTo(SupplyType::class, 'supply_seedling');
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
    public function user()
    {
        // Assuming the foreign key is user_id in the requests table
        return $this->belongsTo(User::class, 'user_id');
    }
}
