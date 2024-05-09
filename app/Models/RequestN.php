<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestN extends Model
{
    use HasFactory;

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
    public function supplyTool1()
    {
        return $this->belongsTo(SupplyType::class, 'supply_tool1');
    }
    public function supplyTool2()
    {
        return $this->belongsTo(SupplyType::class, 'supply_tool2');
    }

    public function supplySeedling()
    {
        return $this->belongsTo(SupplyType::class, 'supply_seedling');
    }
    public function supplySeedling1()
    {
        return $this->belongsTo(SupplyType::class, 'supply_seedling1');
    }
    public function supplySeedling2()
    {
        return $this->belongsTo(SupplyType::class, 'supply_seedling2');
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

}
