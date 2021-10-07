<?php

namespace App\Http\Controllers;

use App\Models\PaiementModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $packs = DB::table('voice_offre_financiere')->get();
        return view('admin.clients.pack',compact('packs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function post($url, $data = [], $header = [])
    {
        $strPostField = http_build_query($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $strPostField);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge($header, [
            'Content-Type: application/x-www-form-urlencoded;charset=utf-8',
            'Content-Length: ' . mb_strlen($strPostField)
        ]));

        return curl_exec($ch);
    }
    function buy(Request $request){

        $transactionInfos = array();
        $transactionInfos['price'] = $request->get('price');
        $transactionInfos['pack'] =  $request->get('pack');
        $transactionInfos['client'] = DB::table('voice_uprofil')->selectRaw('user')->where('voice_uprofil.id','=',$_SESSION['profil']);
        $transactionInfos['ref'] =  uniqid("PAY" . date('Ym') . "PI");



        $postfields = array(
            "item_name"    =>  'forfait mloumaPV',
            "item_price"   =>   intval(10), //$transactionInfos['price'],
            "currency"     =>  "xof",
            "ref_command"  =>  strval( $transactionInfos['ref']),
            "command_name" =>  $transactionInfos['pack'],
            "env"          =>  'prod',
            "success_url"  =>  'http://voicev2.mlouma.com/admin/packs/retourpaiement',
            "ipn_url"	   =>  'https://voicev2.mlouma.com/admin/packs/retourpaiement',
            "cancel_url"   =>  'https://meteombay.mlouma.com',
            "custom_field" =>   ''
    );
        $api_key="e4ce12d2898f171c44bf088ba5679218ef228c05f76e4689a83c73cd59374797";
        $api_secret="c702ca10f972824335303837fb7f1b05d343754541977a2070c6f9620774b58e";
        $jsonResponse = $this->post('https://paytech.sn/api/payment/request-payment', $postfields, [
            "API_KEY: ".$api_key,
            "API_SECRET: ".$api_secret
        ]);

        die($jsonResponse);

    }

    function retourpaiement(Request $request){
        
        $transaction = array();
        $transaction['price'] = $request->input('item_price');
        $transaction['pack'] =  $request->input('command_name');
        $transaction['client'] = DB::table('voice_uprofil')->selectRaw('user')->where('voice_uprofil.id','=',$_SESSION['profil']);
        $transaction['ref'] =  $request->input('ref_command');

        $operation = new PaiementModel([
            'id_offre_financiere' => $transaction['pack'],
            'reference' => $transaction['ref'],
            'client' => $transaction['client']
        ]);
        $operation->save();


        return redirect('/admin');
    }

}

