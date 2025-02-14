<?php


namespace App\Enums;

enum MessageType: string
{
	case VoiceCall = 'voice_call';
	case Text = 'text';
}
