<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\User;
use App\Models\Pet;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Brooming;
use App\Models\RescueAnimal;
use App\Models\EventRegistration;
use App\Models\Rating;
use App\Models\Subscription;
use App\Models\OrderItem;
use App\Models\Service;
use App\Models\Adoption;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Collect statistics from models
        $veterinariansCount = User::where('role_id', 3)->count();
        $registeredPetsCount = Pet::count();
        $servicesProvidedCount = Service::count();
        $adoptionsCount = Adoption::count();
        $appointmentsCount = Appointment::count();
        $roomBookingsCount = Booking::count();
        $groomingSessionsCount = Brooming::count();
        $productsSoldCount = OrderItem::sum('quantity');
        $donationsCount = Donation::sum('amount'); // adjust column name if necessary
        $eventRegistrationsCount = EventRegistration::count();
        $activeSubscriptionsCount = Subscription::count();
        $feedbackCount = Rating::count(); // or Notification if it represents feedback

        // Return view with statistics
        return view('Admin.dashboard', compact(
            'veterinariansCount',
            'registeredPetsCount',
            'servicesProvidedCount',
            'adoptionsCount',
            'appointmentsCount',
            'roomBookingsCount',
            'groomingSessionsCount',
            'productsSoldCount',
            'donationsCount',
            'eventRegistrationsCount',
            'activeSubscriptionsCount',
            'feedbackCount'
        ));
    }


}
