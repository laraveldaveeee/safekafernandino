<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;
class Stats extends Model
{
	public function totalRescuePending()
	{
		return Rescuer::where('status', 'pending')->count(); 
	}

	public function totalCitizenPending()
	{
		return Guardian::where('status', 'pending')->count(); 
	}
}
