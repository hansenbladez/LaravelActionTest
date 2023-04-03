<?php

namespace App\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\EmailVerificationRequest;

class EmailAction{

    public function store_verification(Request $request){
        return $request->user()->hasVerifiedEmail();
    }
    public function store_sendEmail(Request $request){
        
        $request->user()->sendEmailVerificationNotification();
    }

    public function invoke(Request $request){return $request->user()->hasVerifiedEmail();}
    public function invoke_mark(EmailVerificationRequest $request){return $request->user()->markEmailAsVerified();}

}