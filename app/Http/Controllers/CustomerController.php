<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Mail\TestMail;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerController extends Controller
{
    public function list_customer()
    {
        $customers = Customer::get();
        return response()->json(['customers' => $customers]);
    }
    public function add_customer(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:customers,email',
                'phone' => 'required|numeric',
                'comment' => 'required',
            ],
            [
                'name.required' => 'Không được để trống tên',
                'email.required' => 'Không được để trống email',
                'email.unique' => 'Email đã được sử dụng',
                'phone.required' => 'Không được để trống số điện thoại',
                'comment.required' => 'Không được để trống nội dung',
            ]
        );
        $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $combLen = strlen($comb) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $combLen);
            $pass[] = $comb[$n];
        }
        $password = implode($pass);
        $name = $request['name'];
        $email = $request['email'];

        $data = [
            'name' => $name,
            'password' =>  $password,
        ];
        Mail::to($email)->send(new TestMail($data));

        Customer::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'comment' => $request['comment'],
            'password' => $password,
        ]);
    }
    public function send_email(Request $request)
    {
        $customers = Customer::get();
        $email = [];
        foreach ($customers as $key => $customer) {
            $data = [
                'name' => $customer->name,
            ];
            $email[] = $customer->email;
        }
        Mail::to($email)->send(new SendEmail($data));
    }
    public function delete_customer(Request $request, $id)
    {
        Customer::where('id', $id)->delete();
    }
}
