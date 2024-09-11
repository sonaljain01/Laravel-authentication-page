<?php

namespace App\Services;

use SessionHandlerInterface;
use DB;

class CustomSessionHandler implements SessionHandlerInterface
{
    public function open($savePath, $sessionName)
    {
        return true;
    }

    public function close()
    {
        return true;
    }

    public function read($sessionId)
    {
        $session = DB::table('sessions')->where('id', $sessionId)->first();
        if ($session) {
            return $session->data;
        }
        return '';
    }

    public function write($sessionId, $data)
    {
        DB::table('sessions')->insert([
            'id' => $sessionId,
            'data' => $data, 'last_activity' => now(),
        ]);
        return true;
    }

    public function destroy($sessionId)
    {
        DB::table('sessions')->where('id', $sessionId)->delete();
        return true;
    }

    public function gc($maxlifetime)
    {
        DB::table('sessions')->where('last_activity', '<', now()->subSeconds($maxlifetime))->delete();
        return true;
    }
}
