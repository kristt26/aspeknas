<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use Midtrans\Snap;

class Pembayaran extends BaseController
{
	use ResponseTrait;
    protected $midtrans;
    protected $pembayaran;
    public function __construct() {
        $this->midtrans = new Snap();
        $this->pembayaran = new \App\Models\PembayaranModel();
        \Midtrans\Config::$serverKey = "SB-Mid-server-0yZKfLleO5WlljNFyBhCC_ql";
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
    }
	
    public function index()
    {
        return view('welcome_message');
    }

    public function token()
    {
		$dataItem = $this->request->getJSON();
		
		// Required
		$transaction_details = array(
		  'order_id' => $dataItem->order_id,
		  'gross_amount' => $dataItem->subTotal, // no decimal allowed for creditcard
		);

		$item_details = [];
		// Optional
		foreach ($dataItem->biaya as $key => $value) {
			$item = [
				'id'=>'b'.$key+1,
				'price'=>$value->nominal,
				'quantity' => $value->qty,
		  		'name' => $value->desc
			];
			array_push($item_details, $item);
		}

		// Optional
		$customer_details = array(
		  'first_name'    => session()->get('nama')." | ".session()->get('direktur'),
		  'last_name'     => "",
		  'email'         => session()->get('email'),
		  'phone'         => session()->get('kontak')
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 30
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => 10000,
            )
        );

		try {
			$snapToken =  $this->midtrans->getSnapToken($transaction_data);
			// echo $snapToken;
			return $this->respond(["data"=>$snapToken]);
			//code...
		} catch (\Throwable $th) {
			return $this->fail($th->getMessage());
			// echo $th->getMessage();
		}
    }

    public function post()
    {
        $dataItem = $this->request->getJSON();
        $dataItem->detail = serialize($dataItem->result);
        $this->pembayaran->insert($dataItem);
        return $this->respondCreated(true);
    }
}
