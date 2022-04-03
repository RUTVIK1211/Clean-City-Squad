<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resource;

class complaint extends Model
{
    protected $fillable = ['address_line_1','address_line_2','description','user_id','latitude','longitude','area_id','complaint_type_id'];

    public function Resources()
    {
        return $this->hasMany(Resource::class, "complaint_id");
    }
}


