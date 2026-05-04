<?php 
namespace App;
use Illuminate\Database\Eloquent\Model;
class Stats extends Model
{
	public function totalRescuePending()
	{
		return User::where('status', 'pending')->where('role_id', [0])->count(); 
	}

	public function totalCitizenPending()
	{
		return Guardian::where('status', 'pending')->count(); 
	}
}
