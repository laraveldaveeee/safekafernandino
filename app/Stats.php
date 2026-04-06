<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;
class Stats extends Model
{
	public function totalRescuePending()
	{
		return Rescuer::where('status', 'pending')->count(); 
	}
}
