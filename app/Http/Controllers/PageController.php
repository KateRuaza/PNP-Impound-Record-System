<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;

class PageController extends Controller {

	public function home()
	{
		$vehicleCount = Vehicle::count();
		$releasedCount = Vehicle::where('status', 'released')->count();
		$suspendedCount = Vehicle::where('status', 'suspended')->count();

		$typeCounts = Vehicle::selectRaw('type, COUNT(*) as count')
					->groupBy('type')
					->get();

		$vehicleCounts = [
			['label' => 'Vehicles', 'count' => $vehicleCount],
			['label' => 'Released', 'count' => $releasedCount],
			['label' => 'Suspended', 'count' => $suspendedCount],
		];

		return inertia('Home', compact('vehicleCounts', 'typeCounts'));
	}
}