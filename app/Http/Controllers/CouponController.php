<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(): View
    {
        return view('coupons.list', [
            'coupons' => Coupon::all()
        ]);
    }

    public function create(): View
    {
        return view('coupons.form');
    }

    public function store(Request $request): RedirectResponse
    {
        $coupon = new Coupon();
        $coupon->fill($request->all());
        $coupon->is_active = $request->exists('is_active');
        $coupon->is_percentage = $request->exists('is_active');
        $coupon->save();

        return redirect()->route('coupons');
    }

    public function edit(int $id): View
    {
        return view('coupons.form', [
            'coupon' => Coupon::query()->findOrFail($id),
        ]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $coupon = Coupon::query()->findOrFail($id);
        $coupon->fill($request->all());
        $coupon->is_active = $request->exists('is_active');
        $coupon->is_percentage = $request->exists('is_active');
        $coupon->save();

        return redirect()->route('coupons');
    }

    public function delete(int $id): RedirectResponse
    {
        Coupon::destroy($id);
        return redirect()->route('coupons');
    }
}
