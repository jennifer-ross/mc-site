<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request, string $filename)
	{
		$path = public_path("video/{$filename}");

		if (!file_exists($path)) {
			abort(404, 'Видео не найдено.');
		}

		$size = filesize($path);
		$stream = fopen($path, 'rb');

		if (!$stream) {
			abort(500, 'Не удалось открыть видео файл.');
		}

		$range = $request->header('Range');
		$start = 0;
		$length = $size;

		if ($range) {
			// Parse the range header
			if (preg_match('/bytes=(\d+)-(\d+)?/', $range, $matches)) {
				$start = intval($matches[1]);
				$end = $matches[2] ?? $size - 1;
				$length = $end - $start + 1;

				fseek($stream, $start);
			}
		}

		$headers = [
			'Content-Type' => mime_content_type($path),
			'Content-Length' => $length,
		];

		if ($range) {
			$headers['Content-Range'] = "bytes $start-" . ($start + $length - 1) . "/$size";
		}

		return response()->stream(function () use ($stream, $length) {
			$chunkSize = 1024 * 1024; // 1MB chunks
			$bytesSent = 0;

			while (!feof($stream) && $bytesSent < $length) {
				$bytesToSend = min($chunkSize, $length - $bytesSent);
				echo fread($stream, $bytesToSend);
				$bytesSent += $bytesToSend;
				flush();
			}

			fclose($stream);
		}, $range ? 206 : 200, $headers);
	}
}
