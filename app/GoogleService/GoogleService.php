<?php
namespace App\GoogleService;

use Google_Client;

class GoogleService
{
    public function __construct(){ //el construtor tambien puede ser el mismo nombre de la clase
		$this->delegateAdmin = 'soporte' . env('CORREO');

		$this->scopes =  array(
            'https://www.googleapis.com/auth/admin.directory.user',
            'https://www.googleapis.com/auth/admin.directory.group',
			'https://www.googleapis.com/auth/admin.directory.group.member');

		$this->token_user = (env('CORREO') == '@vonneumann.pe') ? 'token/token_von.json' : 'token/token_rs.json';
	}
}