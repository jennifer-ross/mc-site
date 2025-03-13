<?php


namespace App\Enums;

enum ChatType: string
{
	case Private = 'private';
	case Group = 'group';
	case Court = 'court';
}
