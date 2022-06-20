<?php

namespace App\Http\Controllers;

use App\Actions\CustomerCreateAction;
use App\Actions\CustomerUpdateAction;
use App\DTO\CustomerDTO;
use App\Http\Requests\CustomerRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CustomerController extends Controller
{

    public function index()
    {
        checkPermission('customer_view');
        $customers = User::query()->role('customer')->latest('created_at')->get();

        return view('customer.index', compact('customers'));
    }


    public function create()
    {
        checkPermission('customer_create');

        return view('customer.create');
    }


    public function store(CustomerRequest $request, CustomerCreateAction $action)
    {
        checkPermission('customer_create');
        try {
            $action(CustomerDTO::create($request));
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => __('Customer Created!'),
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => __('Failed To Create Customer!'),
            ]);
        }

        return redirect()->route('customers.index');
    }


    public function show($id)
    {
        checkPermission('customer_view');
    }


    public function edit($id)
    {
        checkPermission('customer_edit');
        $customer = User::query()->role('customer')->findOrFail($id);

        return view('customer.edit', compact('customer'));
    }


    public function update(CustomerRequest $request, $id, CustomerUpdateAction $action)
    {
        checkPermission('customer_edit');
        $customer = User::query()->role('customer')->findOrFail($id);
        try {
            $action(CustomerDTO::create($request), $customer);
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => __('Customer Updated!'),
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => __('Failed To Update Customer!'),
            ]);
        }

        return redirect()->route('customers.edit', $customer->id);
    }


    public function destroy($id)
    {
        checkPermission('customer_delete');
        $customer = User::query()->role('customer')->findOrFail($id);
        try {
            if ( ! $customer->is_deletable) {
                throw new \Exception();
            }
            $customer->delete();
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => __('Customer Deleted!'),
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => __('Failed To Delete Customer!'),
            ]);
        }

        return redirect()->route('customers.index');
    }
}
