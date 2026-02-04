<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Push extends CI_Controller {

 private $SERVER_KEY="YOUR_FIREBASE_SERVER_KEY";

 public function __construct(){
  parent::__construct();
  $this->load->database();
 }

 public function save_token(){

  $data=json_decode(file_get_contents("php://input"),true);

  if(empty($data['token'])){
   echo "no token";
   return;
  }

  $token=$data['token'];

  if(!$this->db->get_where('push_tokens',['token'=>$token])->row()){
   $this->db->insert('push_tokens',['token'=>$token]);
  }

  echo "saved";
 }

 public function send(){

  $tokens=$this->db->get('push_tokens')->result();

  foreach($tokens as $t){

   $msg=[
    "to"=>$t->token,
    "notification"=>[
      "title"=>"New Task",
      "body"=>"Task Assigned",
      "icon"=>"http://localhost/framework/assets/remove.png"
    ]
   ];

   $ch=curl_init("https://fcm.googleapis.com/fcm/send");

   curl_setopt($ch,CURLOPT_HTTPHEADER,[
    "Authorization:key=".$this->SERVER_KEY,
    "Content-Type:application/json"
   ]);

   curl_setopt($ch,CURLOPT_POST,true);
   curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
   curl_setopt($ch,CURLOPT_POSTFIELDS,json_encode($msg));

   curl_exec($ch);
   curl_close($ch);
  }

  echo "sent";
 }
}
