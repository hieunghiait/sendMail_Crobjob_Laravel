<?php

namespace App\Http\Controllers;
use DrewM\MailChimp\MailChimp;

class MailController extends Controller
{
    public function scheduleEmail()
    {
        $campaignData = [
            'type' => 'regular',
            'recipients' => ['list_id' => env("MAILCHIMP_LIST_ID")],
            'settings' => [
                'subject_line' => 'Template Mail',
                'from_name' => 'Le Hieu Nghia',
                'reply_to' => 'lehieunghia2402@gmail.com',
                'template_id'=>10564776,
            ],
        ];

        $apiKey = env("MAILCHIMP_API_KEY");
        $MailChimp = new MailChimp($apiKey);
        $result = $MailChimp->post('campaigns', $campaignData);
        // return $result;

        $campaignId = $result['id'];

        $sendResult = $MailChimp->post("campaigns/{$campaignId}/actions/send");
        if($sendResult){
            return response()->json(['status' => 'Success']);
        }else{
            return response()->json(['status' => 'Fail']);
        }
    }
    public function addSubcribe(){
        $apiKey = env("MAILCHIMP_API_KEY");
        $MailChimp = new MailChimp($apiKey);
        $list_id =env("MAILCHIMP_LIST_ID");
        $result = $MailChimp->post("lists/$list_id/members", [
            'email_address' => 'lehieunghia2402@gmail.com',
            'status'        => 'subscribed',
        ]);
        print_r($result);
    }
    /**
     * Summary of addListMail
     * @return array
     */
    public function addListMail(){
        $mailArray = [ 'nguyenthanhdat2002@gmail.com'];
        $results = [];
        foreach($mailArray as $mail) {
            $results[] = $this->addToMailChimpList($mail);
        }

        return $results;
    }

    public function addToMailChimpList($mail){
        $apiKey = env("MAILCHIMP_API_KEY");
        $MailChimp = new MailChimp($apiKey);
        $list_id = env("MAILCHIMP_LIST_ID");

        return $MailChimp->post("lists/$list_id/members", [
            'email_address' => $mail,
            'status'        => 'subscribed',
        ]);
    }
    public function showListMail() {
        $apiKey = env("MAILCHIMP_API_KEY");
        $MailChimp = new MailChimp($apiKey);
        $list_id = env("MAILCHIMP_LIST_ID");
        $result = $MailChimp->get("lists/$list_id/members");
        $emails = array_map(function($member) {
            return $member['email_address'];
        }, $result['members']);
        return $emails;
    }
}
