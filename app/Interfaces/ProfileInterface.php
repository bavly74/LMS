<?php

namespace App\Interfaces;

interface ProfileInterface
{
    public function index($guard);
    public function update($request , $user);
}
