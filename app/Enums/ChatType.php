<?php


namespace App\Enums;

enum ChatType: string
{
	case PrivateChat = 'private';
	case GroupChat = 'group';
	case CourtChat = 'court';
}
