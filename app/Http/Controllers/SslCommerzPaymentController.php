<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use App\Payment;
use App\ThemeSetting;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PaymentComplete;
use App\Library\SslCommerz\SslCommerzNotification;

class SslCommerzPaymentController extends Controller
{

    public function exampleEasyCheckout()
    {
        return view('exampleEasycheckout');
    }

    public function exampleHostedCheckout()
    {
        return view('exampleHosted');
    }

    public function index(Request $request)
    {
        $this->validate($request,[
            'semester'=>'required',
            'fee'=>'required',
            ]);
//elseif(User::where('user_id',Auth::user()->id)->where('semester_id','<',$request->semester)){
   // Toastr::error("You can not give advanced payment",'error');
   // return redirect()->route('student.payment.history');
//}
            if(Payment::where('user_id',Auth::user()->id)->where('semester_id',$request->semester)->where('status','complete')->exists()){
                Toastr::info("You are already paied in this semester",'Repaid');
                return redirect()->route('student.payment.history');
            }else{

            # Here you have to receive all the order data to initate the payment.
            # Let's say, your oder transaction informations are saving in a table called "orders"
            # In "orders" table, order unique identity is "transaction_id". "status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
            $post_data['student_name'] = Auth::user()->name;
            $post_data['student_id'] = Auth::user()->student_id;
            $post_data['user_id'] = Auth::user()->id;
            $post_data['semester'] = $request->semester;

            $theme=ThemeSetting::find(1);
            if (isset($theme->currency)) {
                $currency=$theme->currency;
            }else{
                $currency="BDT";
            }
            $post_data = array();
            $post_data['total_amount'] = $request->fee; # You cant not pay less than 10
            $post_data['currency'] = $currency;
            $post_data['tran_id'] = uniqid(); // tran_id must be unique

            # CUSTOMER INFORMATION
            $post_data['cus_name'] = Auth::user()->name;
            $post_data['cus_email'] = Auth::user()->email;
            $post_data['cus_add1'] = 'Customer Address';
            $post_data['cus_add2'] = "";
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "Bangladesh";
            $post_data['cus_phone'] = Auth::user()->mobile;
            $post_data['cus_fax'] = "";

            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "Store Test";
            $post_data['ship_add1'] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "1000";
            $post_data['ship_phone'] = "";
            $post_data['ship_country'] = "Bangladesh";

            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = "Computer";
            $post_data['product_category'] = "Goods";
            $post_data['product_profile'] = "physical-goods";

            # OPTIONAL PARAMETERS
            $post_data['value_a'] = Auth::user()->id;
            $post_data['value_b'] = Auth::user()->student_id;
            $post_data['value_c'] = $request->semester;
            $post_data['value_d'] = "ref004";

            $post_data['dept'] = Auth::user()->batch->department->id;
            $post_data['batch'] = Auth::user()->batch->id;
            #Before  going to initiate the payment order status need to insert or update as Pending.
            $update_product = DB::table('payments')
            ->updateOrInsert(['user_id'=>$post_data['value_a'],'semester_id'=>$post_data['value_c'],'status'=>'Pending'],[
                'user_id' => $post_data['value_a'],
                'student_id' => $post_data['value_b'],
                'semester_id' => $post_data['value_c'],
                'dept_id' => $post_data['dept'],
                'batch_id' => $post_data['batch'],
                'amount' => $post_data['total_amount'],
                'status' => 'Pending',
                'transaction_id' => $post_data['tran_id'],
                'currency' => $post_data['currency'],
                'created_at' => date('Y-m-d H:i:s'),
                ]);

                $sslc = new SslCommerzNotification();
                # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
                $payment_options = $sslc->makePayment($post_data, 'hosted');

                if (!is_array($payment_options)) {
                    print_r($payment_options);
                    $payment_options = array();
                }
            }
    }

            public function payViaAjax(Request $request)
            {

                # Here you have to receive all the order data to initate the payment.
                # Lets your oder trnsaction informations are saving in a table called "orders"
                # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.

                $post_data = array();
                $post_data['total_amount'] = '10'; # You cant not pay less than 10
                $post_data['currency'] = "BDT";
                $post_data['tran_id'] = uniqid(); // tran_id must be unique

                # CUSTOMER INFORMATION
                $post_data['cus_name'] = 'Customer Name';
                $post_data['cus_email'] = 'customer@mail.com';
                $post_data['cus_add1'] = 'Customer Address';
                $post_data['cus_add2'] = "";
                $post_data['cus_city'] = "";
                $post_data['cus_state'] = "";
                $post_data['cus_postcode'] = "";
                $post_data['cus_country'] = "Bangladesh";
                $post_data['cus_phone'] = '8801XXXXXXXXX';
                $post_data['cus_fax'] = "";

                # SHIPMENT INFORMATION
                $post_data['ship_name'] = "Store Test";
                $post_data['ship_add1'] = "Dhaka";
                $post_data['ship_add2'] = "Dhaka";
                $post_data['ship_city'] = "Dhaka";
                $post_data['ship_state'] = "Dhaka";
                $post_data['ship_postcode'] = "1000";
                $post_data['ship_phone'] = "";
                $post_data['ship_country'] = "Bangladesh";

                $post_data['shipping_method'] = "NO";
                $post_data['product_name'] = "Computer";
                $post_data['product_category'] = "Goods";
                $post_data['product_profile'] = "physical-goods";

                # OPTIONAL PARAMETERS
                $post_data['value_a'] = "ref001";
                $post_data['value_b'] = "ref002";
                $post_data['value_c'] = "ref003";
                $post_data['value_d'] = "ref004";


                #Before  going to initiate the payment order status need to update as Pending.
                $update_product = DB::table('payments')
                ->where('transaction_id', $post_data['tran_id'])
                ->updateOrInsert([
                    'name' => $post_data['cus_name'],
                    'email' => $post_data['cus_email'],
                    'phone' => $post_data['cus_phone'],
                    'amount' => $post_data['total_amount'],
                    'status' => 'Pending',
                    'address' => $post_data['cus_add1'],
                    'transaction_id' => $post_data['tran_id'],
                    'currency' => $post_data['currency']
                    ]);

                    $sslc = new SslCommerzNotification();
                    # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
                    $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');

                    if (!is_array($payment_options)) {
                        print_r($payment_options);
                        $payment_options = array();
                    }

            }

                public function success(Request $request)
                {
                    echo "Transaction is Successful";

                    $tran_id = $request->input('tran_id');
                    $amount = $request->input('amount');
                    $currency = $request->input('currency');
                    $tran_date = $request->input('tran_date');
                    $card_type = $request->input('card_type');

                    $sslc = new SslCommerzNotification();

                    #Check order status in order tabel against the transaction id or order id.
                    $order_detials = DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->select('transaction_id', 'status', 'currency', 'amount')->first();
                    if ($order_detials->status == 'Pending') {
                        $validation = $sslc->orderValidate($request->all(),$tran_id, $amount, $currency);

                        if ($validation == TRUE) {
                            /*
                            That means IPN did not work or IPN URL was not set in your merchant panel. Here you need to update order status
                            in order table as Processing or Complete.
                            Here you can also sent sms or email for successfull transaction to customer
                            */
                            $payment = Payment::where('transaction_id', $tran_id)->first();
                            $payment->status='Complete';
                            $payment->updated_at= $tran_date ;
                            $payment->payment_type= $card_type;
                            $payment->save();

                            $payment->user->notify(new PaymentComplete($payment));
                           // echo "<br >Transaction is successfully Completed";
                            Toastr::success('Transaction is successfully Completed','success');
                            return redirect()->route('student.payment');
                        } else {
                            /*
                            That means IPN did not work or IPN URL was not set in your merchant panel and Transation validation failed.
                            Here you need to update order status as Failed in order table.
                            */
                            $update_product = DB::table('payments')
                            ->where('transaction_id', $tran_id)
                            ->update(['status' => 'Failed']);
                            //echo "validation Fail";
                            Toastr::error('validation Fail','error');
                            return redirect()->route('student.payment');
                        }
                    } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
                        /*
                        That means through IPN Order status already updated. Now you can just show the customer that transaction is completed. No need to udate database.
                        */
                        //echo "Transaction is successfully Completed";
                        Toastr::success('Transaction is successfully Completed','success');
                        return redirect()->route('student.payment');
                    } else {
                        #That means something wrong happened. You can redirect customer to your product page.
                        //echo "Invalid Transaction";
                        Toastr::error('Invalid Transaction','error');
                        return redirect()->route('student.payment');
                    }


                }

                public function fail(Request $request)
                {
                    $tran_id = $request->input('tran_id');

                    $order_detials = DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->select('transaction_id', 'status', 'currency', 'amount')->first();

                    if ($order_detials->status == 'Pending') {
                        $update_product = DB::table('payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Failed']);
                        Toastr::error('Transaction is Failed');
                        return redirect()->route('student.payment');
                    } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
                        echo "Transaction is already Successful";
                    } else {
                        // echo "Transaction is Invalid";
                        Toastr::error('Transaction is Invalid');
                        return redirect()->route('student.payment');
                    }

                }

                public function cancel(Request $request)
                {
                    $tran_id = $request->input('tran_id');

                    $order_detials = DB::table('payments')
                    ->where('transaction_id', $tran_id)
                    ->select('transaction_id', 'status', 'currency', 'amount')->first();

                    if ($order_detials->status == 'Pending') {
                        $update_product = DB::table('payments')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Canceled']);
                        Toastr::error('Transaction is Cancel');
                        return redirect()->route('student.payment');
                    } else if ($order_detials->status == 'Processing' || $order_detials->status == 'Complete') {
                        Toastr::error('Transaction is already Successful');
                        return redirect()->route('student.payment');
                    } else {
                        Toastr::error('Transaction is Invalid');
                        return redirect()->route('student.payment');
                    }


                }

                public function ipn(Request $request)
                {
                    #Received all the payement information from the gateway
                    if ($request->input('tran_id')) #Check transation id is posted or not.
                    {

                        $tran_id = $request->input('tran_id');

                        #Check order status in order tabel against the transaction id or order id.
                        $order_details = DB::table('payments')
                        ->where('transaction_id', $tran_id)
                        ->select('transaction_id', 'status', 'currency', 'amount')->first();

                        if ($order_details->status == 'Pending') {
                            $sslc = new SslCommerzNotification();
                            $validation = $sslc->orderValidate($tran_id, $order_details->amount, $order_details->currency, $request->all());
                            if ($validation == TRUE) {
                                /*
                                That means IPN worked. Here you need to update order status
                                in order table as Processing or Complete.
                                Here you can also sent sms or email for successful transaction to customer
                                */
                                $update_product = DB::table('payments')
                                ->where('transaction_id', $tran_id)
                                ->update(['status' => 'Processing']);

                                echo "Transaction is successfully Completed";
                                Toastr::success('Transaction is successfully Completed','success');
                                return redirect()->route('student.payment');
                            } else {
                                /*
                                That means IPN worked, but Transation validation failed.
                                Here you need to update order status as Failed in order table.
                                */
                                $update_product = DB::table('payments')
                                ->where('transaction_id', $tran_id)
                                ->update(['status' => 'Failed']);

                                // echo "validation Fail";
                                Toastr::error('validation Fail');
                                return redirect()->route('student.payment');

                            }

                        } else if ($order_details->status == 'Processing' || $order_details->status == 'Complete') {

                            #That means Order status already updated. No need to udate database.

                            echo "Transaction is already successfully Completed";
                        } else {
                            #That means something wrong happened. You can redirect customer to your product page.

                            // echo "Invalid Transaction";
                            Toastr::error('Invalid Transaction');
                            return redirect()->route('student.payment');
                        }
                    } else {
                        // echo "Invalid Data";
                        Toastr::error('Invalid Data');
                        return redirect()->route('student.payment');
                    }
                }

}
