<?php

namespace App\Http\Controllers;

use App\Models\CreditClientModel;
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
        $transactionInfos['id_pack'] =  $request->get('idPack');
        $transactionInfos['nb_minute']  = $request->get('nb_minute');
        $transactionInfos['client'] =DB::table('voice_uprofil')->selectRaw('user')->where('voice_uprofil.id','=',$_SESSION['profil']);
        $transactionInfos['ref'] =  uniqid("PAY" . date('Ym') . "PI");

        $postfields = array(
            "item_name"    =>   $transactionInfos['pack'],
            "item_price"   =>   intval(10), //$transactionInfos['price'],
            "currency"     =>  "xof",
            "ref_command"  =>  strval( $transactionInfos['ref']),
            "command_name" =>  $transactionInfos['pack'],
            "env"          =>  'prod',
            "success_url"  =>  "https://voicev2.mlouma.com/admin/packs/retourpaiement?idPack=".$transactionInfos['id_pack']."&item_name=".$transactionInfos['pack']."&item_price=".$transactionInfos['price']."&nb_minute=".$transactionInfos['nb_minute']."&ref_command=".$transactionInfos['ref'],
            "ipn_url"	   =>  'https://voicev2.mlouma.com/admin/packs/retourpaiement',
            //"success_url"  =>  "http://127.0.0.1/admin/packs/retourpaiement?idPack=".$transactionInfos['id_pack']."&item_name=".$transactionInfos['pack']."&item_price=".$transactionInfos['price']."&nb_minute=".$transactionInfos['nb_minute']."&ref_command=".$transactionInfos['ref'],
           // "ipn_url"	   =>  'http://127.0.0.1/admin/packs/retourpaiement',
            "cancel_url"   =>  'https://meteombay.mlouma.com',
            "custom_field" =>   ''
    );
        $api_key="e4ce12d2898f171c44bf088ba5679218ef228c05f76e4689a83c73cd59374797";
        $api_secret="c702ca10f972824335303837fb7f1b05d343754541977a2070c6f9620774b58e";
        $jsonResponse = $this->post('https://paytech.sn/api/payment/request-payment', $postfields, [
            "API_KEY: ".$api_key,
            "API_SECRET: ".$api_secret
        ]);
        // return view('admin.retourPaiement',compact('jsonResponse'));
        die($jsonResponse);

    }

    function retourpaiement(Request $request){
        $transaction= array() ;
        $transaction['ref_command'] = $request->get('ref_command');
        $transaction['id_pack'] = $request->get('idPack');
        $transaction['item_name'] = $request->get('item_name');
        $transaction['item_price'] = $request->get('item_price');
        // $user = DB::select('select * voice_uProfil where voice_uprofil.user='.$_SESSION['profil']);
        $transaction['client'] = $_SESSION['user'];
        $operation = new PaiementModel([
            'id_offre_financiere' => $transaction['item_name'],
            'reference' => $transaction['ref_command'],
            'prix' => $transaction['item_price'],
            'id_client' => $transaction['client']
        ]);
        if ($operation->save()) {
            # code...
            $structure = DB::table('voice_uprofil')->where('user',$_SESSION['user'])->get();
            $offres = DB::table('voice_offre_financiere')->where('id',$transaction['item_name'])->get();
            foreach($offres as $offre){
                $transaction['forfait'] = $offre->forfait;
                $transaction['nb_minute'] = $offre->nb_minute;
                $transaction['desc'] = $offre->description;
            }
            $ifBalanceAccount = CreditClientModel::where('structure',$structure[0]->client)->get();
            if(!empty($ifBalanceAccount[0])){
                $nouveauSolde = $ifBalanceAccount[0]->credit_total + intval($transaction['nb_minute']) ;
                // $creditClient = CreditClientModel::findOrFail($ifBalanceAccount[0]->id);
                // $creditClient->credit_total = $nouveauSolde;
                $req = DB::update('update voice_credit_client set credit_total = ? where id = ?', [intval($nouveauSolde),$ifBalanceAccount[0]->id]);;
                if($req) {
                    # code...
                    $transaction['total'] = $nouveauSolde ;
                    $_SESSION['total']=$transaction['total'] ;
                    $_SESSION['ref_command']=$transaction['ref_command'] ;
                    $_SESSION['forfait']=$transaction['forfait']  ;
                    $_SESSION['nb_minute']=$transaction['nb_minute'] ;
                    $_SESSION['desc']=$transaction['desc'] ;
                    return redirect('admin/packs/detailPaiement');
                }
                else{
                    return redirect('/admin');
                }
            }
            else{
                $solde = new CreditClientModel([
                    'structure' => $structure[0]->client,
                    'credit_total' => $transaction['nb_minute']
                ]);
                if($solde->save()){
                    $transaction['total'] = $transaction['nb_minute'];
                    $_SESSION['total']=$transaction['total'] ;
                    $_SESSION['forfait']=$transaction['forfait']  ;
                    $_SESSION['nb_minute']=$transaction['nb_minute'] ;
                    $_SESSION['desc']=$transaction['desc'] ;
                    return view('admin.detailPaiement');

                }
                else{
                    return redirect('/historique');
                }
            }
        }
        else{
            return redirect('/packs');
        }

    }
    function detailPaiement(){
        return view('admin.detailPaiement');
    }

}

