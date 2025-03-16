<?php


namespace App\Enums;

enum ChatVisibility: string
{
	case PrivateVisibility = 'private';
	case PublicVisibility = 'public';
}
