<?php

namespace App\Http\Controllers\Admin;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\Brooming;
use App\Models\TaxiRequest;
use App\Models\AnimalSubscription;
use App\Models\Order;
use App\Models\Adoption;
use App\Http\Controllers\Controller;


class RequestController extends Controller
{
    public function AppointmentRequest()
    {
        // جلب جميع مواعيد الطبيب
        $appointments = Appointment::with(['user', 'pet', 'doctor', 'service'])->get();

        return view('Admin.requests.doctor_appointments', compact('appointments'));
    }

    public function AppApprove($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->status = 'approved';
    $appointment->save();

    return redirect()->route('admin.appointments.request')->with('success', 'Appointment approved successfully.');
}

public function AppReject($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->status = 'rejected';
    $appointment->save();

    return redirect()->route('admin.appointments.request')->with('success', 'Appointment rejected successfully.');
}

public function AppPending($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->status = 'pending';
    $appointment->save();

    return redirect()->route('admin.appointments.request')->with('success', 'Appointment status set to pending.');
}

public function BookingRequest()
    {
        // جلب جميع حجوزات الغرف
        $bookings = Booking::with(['user', 'pet', 'room'])->get();

        return view('Admin.requests.bookings', compact('bookings'));
    }

    public function BookApprove($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'approved';
        $booking->save();

        return redirect()->route('admin.bookings.request')->with('success', 'Booking approved successfully.');
    }

    public function BookReject($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        return redirect()->route('admin.bookings.request')->with('success', 'Booking rejected successfully.');
    }

    public function BookPending($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'pending';
        $booking->save();

        return redirect()->route('admin.bookings.request')->with('success', 'Booking status set to pending.');
    }

    public function GroomingRequest()
    {
        // جلب جميع حجوزات الحلاقة
        $groomings = Brooming::with(['user', 'pet'])->get();

        return view('Admin.requests.groomings', compact('groomings'));
    }

    public function GroomingApprove($id)
    {
        $grooming = Brooming::findOrFail($id);
        $grooming->status = 'approved';
        $grooming->save();

        return redirect()->route('admin.groomings.request')->with('success', 'Grooming approved successfully.');
    }

    public function GroomingReject($id)
    {
        $grooming = Brooming::findOrFail($id);
        $grooming->status = 'rejected';
        $grooming->save();

        return redirect()->route('admin.groomings.request')->with('success', 'Grooming rejected successfully.');
    }

    public function GroomingPending($id)
    {
        $grooming = Brooming::findOrFail($id);
        $grooming->status = 'pending';
        $grooming->save();

        return redirect()->route('admin.groomings.request')->with('success', 'Grooming status set to pending.');
    }

    public function OrderRequest()
    {
        // جلب جميع الطلبات
        $orders = Order::with('user')->get();

        return view('Admin.requests.orders', compact('orders'));
    }

    public function OrderApprove($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();

        return redirect()->route('admin.orders.request')->with('success', 'Order marked as completed.');
    }

    public function OrderReject($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'cancelled';
        $order->save();

        return redirect()->route('admin.orders.request')->with('success', 'Order canceled successfully.');
    }

    public function OrderPending($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'pending';
        $order->save();

        return redirect()->route('admin.orders.request')->with('success', 'Order status set to pending.');
    }

    public function adoptionsRequest()
    {
        $adoptions = Adoption::all();
        return view('Admin.requests.adoptions', compact('adoptions'));
    }

    public function approveAdoption($id)
    {
        $adoption = Adoption::findOrFail($id);

        // Change status to "approved"
        $adoption->status = 'approved';
        $adoption->save();

        // Transfer pet ownership to the adopter
        $adoption->pet->update(['user_id' => $adoption->user_id]);

        return redirect()->route('admin.adoptions.request')->with('success', 'Adoption request approved and pet ownership transferred.');
    }


    public function rejectAdoption($id)
    {
        $adoption = Adoption::findOrFail($id);
        $adoption->status = 'rejected';
        $adoption->save();

        return redirect()->route('admin.adoptions.request')->with('success', 'Adoption request rejected.');
    }

    public function pendingAdoption($id)
    {
        $adoption = Adoption::findOrFail($id);
        $adoption->status = 'pending';
        $adoption->save();

        return redirect()->route('admin.adoptions.request')->with('success', 'Adoption request set to pending.');
    }

    public function subscriptionsRequest()
    {
        $subscriptions = AnimalSubscription::all();
        return view('Admin.requests.subscriptions', compact('subscriptions'));
    }

    public function approveSubscription($id)
    {
        $subscription = AnimalSubscription::findOrFail($id);
        $subscription->status = 'approved';
        $subscription->save();

        return redirect()->route('admin.subscriptions.request')->with('success', 'Subscription approved successfully.');
    }

    public function rejectSubscription($id)
    {
        $subscription = AnimalSubscription::findOrFail($id);
        $subscription->status = 'rejected';
        $subscription->save();

        return redirect()->route('admin.subscriptions.request')->with('success', 'Subscription rejected successfully.');
    }

    public function pendingSubscription($id)
    {
        $subscription = AnimalSubscription::findOrFail($id);
        $subscription->status = 'pending';
        $subscription->save();

        return redirect()->route('admin.subscriptions.request')->with('success', 'Subscription status set to pending.');
    }

    public function taxiRequests()
{
    $taxiRequests = TaxiRequest::all();
    return view('admin.requests.taxi_requests', compact('taxiRequests'));
}

public function approveTaxiRequest($id)
{
    $taxiRequest = TaxiRequest::findOrFail($id);
    $taxiRequest->status = 'approved';
    $taxiRequest->save();

    return redirect()->route('admin.taxi_requests.request')->with('success', 'Taxi request approved successfully.');
}

public function completeTaxiRequest($id)
{
    $taxiRequest = TaxiRequest::findOrFail($id);
    $taxiRequest->status = 'completed';
    $taxiRequest->save();

    return redirect()->route('admin.taxi_requests.request')->with('success', 'Taxi request marked as completed.');
}

public function pendingTaxiRequest($id)
{
    $taxiRequest = TaxiRequest::findOrFail($id);
    $taxiRequest->status = 'pending';
    $taxiRequest->save();

    return redirect()->route('admin.taxi_requests.request')->with('success', 'Taxi request status set to pending.');
}



}
