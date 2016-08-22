<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Session;
use Aacotroneo\Saml2\Events\Saml2LoginEvent;
use App\User;
use App\UserRole;
use App\Role;
use Auth;

class Saml2LoginListener
{
    const CLAIM_USERNAME = "username";
    const CLAIM_EMAIL_ADDRESS = "email";
    const CLAIM_ROLE = "role";
    const CLAIM_ORGANIZATION = "organization";
    const CLAIM_ADDRESS = "address";
    const CLAIM_LASTNAME = "lastname";
    const CLAIM_IM = "im";
    const CLAIM_URL = "url";
    const CLAIM_COUNTRY = "country";
    const CLAIM_MOBILE = "mobile";
    const CLAIM_TELEPHONE = "telephone";
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function getClaimOrDefault($attributes, $claimKey, $default = 'N/A')
    {
        if (array_key_exists($claimKey, $attributes)) {
            return $attributes[$claimKey][0];
        }
        return $default;
    }
      
    /**
     * Handle the event.
     *
     * @param  Saml2LoginEvent  $event
     * @return void
     */
    public function handle(Saml2LoginEvent $event)
    {
        $user = $event->getSaml2User();
        $attributes = $user->getAttributes();
        preg_match('/WSO2.ORG\/(.*?)@(.*)/',$user->getUserId(),$matches);
        
        $roles = explode(',', $this->getClaimOrDefault($attributes, self::CLAIM_ROLE));

        $profile = array(
          'saml_id' => $user->getUserId(),
          'email' => $this->getClaimOrDefault($attributes, self::CLAIM_EMAIL_ADDRESS),
          'organization' => $this->getClaimOrDefault($attributes, self::CLAIM_ORGANIZATION),
          'address' => $this->getClaimOrDefault($attributes, self::CLAIM_ADDRESS),
          'lastname' => $this->getClaimOrDefault($attributes, self::CLAIM_LASTNAME),
          'im' => $this->getClaimOrDefault($attributes, self::CLAIM_IM),
          'url' => $this->getClaimOrDefault($attributes, self::CLAIM_URL),
          'country' => $this->getClaimOrDefault($attributes, self::CLAIM_COUNTRY),
          'mobile' => $this->getClaimOrDefault($attributes, self::CLAIM_MOBILE),
          'telephone' => $this->getClaimOrDefault($attributes, self::CLAIM_MOBILE),
          // 'role' => $this->getClaimOrDefault($attributes, self::CLAIM_ROLE),
          'session_index' => $user->getSessionIndex(),
          'name' => $user->getUserId()
        );
        // dd($profile);

        $laravelUser = User::updateOrCreate(array('email' => $profile['email']), $profile);
        // dd($laravelUser);
        foreach ($roles as $role) {
          $createdRole = Role::firstOrNew(array('name' => $role));
          $createdRole->save();
          // $laravelUser->roles()->attach($createdRole->id);
          UserRole::firstOrCreate(array('user_id' => $laravelUser->id, 'role_id' => $createdRole->id));
        }

        Session::put('session_index', $user->getSessionIndex());

        Auth::login($laravelUser);
    }
}
