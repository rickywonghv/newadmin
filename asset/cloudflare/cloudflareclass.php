<?php
/**
 * MusixCloud CloudFlare Class
 */
 require_once "cloudflareapi.php";
class musixcloudflare extends cloudflare_api
{
  private $email="admin@musixcloud.xyz";
  private $token="9a32dece3f229fef764a24498413158e5706e";

  public  function __construct(){
    $this->setEmail($this->email);
    $this->setToken($this->token);
  }

}

 ?>
