<?php
namespace App\Repositories\AuthRepo;



use  Illuminate\Http\Request;

interface AuthInterface
{
 public function credentials(Request $request);
 public function Authorize(Request $request);

}
