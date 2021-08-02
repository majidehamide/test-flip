<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Disbursement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Libraries\Api\SlightlyBigFlipApi;
use Illuminate\Support\Facades\Validator;

class DisbursementController extends Controller
{
    protected $slightlyBigFlipApi;

    public function __construct(SlightlyBigFlipApi $slightlyBigFlipApi)
    {
        $this->slightlyBigFlipApi = $slightlyBigFlipApi;
    }

    /**
     * method access homepage
     */

    public function homePage()
    {
        $disbursements = DB::table('disbursements')->get();
        return view('home-page')->with(compact('disbursements'));
    }

    /**
     * method access form disbursement
     */
    public function formDisbursement()
    {
        return view('form-disbursement');
    }

    /**
     * method send data disbursement to 3rd Party slightly-Big Flip
     */
    public function sendDisbursement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank_code' => 'required',
            'account_number' => 'required',
            'amount' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $response = $this->slightlyBigFlipApi->accessApi('POST', '/disburse', $request, $request->all());
        if ($response['code'] == 200) {
            $inputDisbursement = $response['data'];
            if ($inputDisbursement['time_served'] == '0000-00-00 00:00:00') {
                unset($inputDisbursement["time_served"]);
            }

            Disbursement::create($inputDisbursement);
            return redirect()->route('home')->with('success', 'Berhasil tambah disbursement');
        } else {
            return $this->responseBystatusCode($response);
        }
    }
    /**
     * method check data disbursement to 3rd Party slightly-Big Flip
     */
    public function checkDisbursement(Request $request, $id)
    {

        $disbursement = Disbursement::find($id);
        $response = $this->slightlyBigFlipApi->accessApi('GET', '/disburse/' . $id, $request);
        if ($response['code'] == 200) {
            $inputDisbursement = $response['data'];
            if ($inputDisbursement['time_served'] == '0000-00-00 00:00:00') {
                unset($inputDisbursement["time_served"]);
            }
            $disbursement->update($inputDisbursement);
            return redirect()->route('home')->with('success', 'Berhasil cek disbursement dengan nomor id ' . $id);
        } else {
            return $this->responseBystatusCode($response);
        }
    }


    /**
     * method send to front end depend on status code response form 3rd party
     */
    public function responseBystatusCode($response)
    {
        $status = 'error';
        $message = 'Terjadi kesalahan sistem, 500';
        switch ($response['code']) {
            case 401:
                $status = 'error';
                $message = $response['data']['message'] . ', ' . $response['code'];
                break;
        }

        return redirect()->route('home')->with($status, $message);
    }
}
