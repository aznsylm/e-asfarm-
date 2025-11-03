<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginAttemptModel extends Model
{
    protected $table = 'login_attempts';
    protected $primaryKey = 'id';
    protected $allowedFields = ['ip_address', 'email', 'attempts', 'locked_until', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function recordAttempt($email, $ipAddress)
    {
        $attempt = $this->where('email', $email)
                        ->where('ip_address', $ipAddress)
                        ->first();

        if ($attempt) {
            $this->update($attempt['id'], [
                'attempts' => $attempt['attempts'] + 1,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return $attempt['attempts'] + 1;
        } else {
            $this->insert([
                'email' => $email,
                'ip_address' => $ipAddress,
                'attempts' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            return 1;
        }
    }

    public function isLocked($email, $ipAddress)
    {
        $attempt = $this->where('email', $email)
                        ->where('ip_address', $ipAddress)
                        ->first();

        if (!$attempt) {
            return false;
        }

        if ($attempt['locked_until'] && strtotime($attempt['locked_until']) > time()) {
            return true;
        }

        return false;
    }

    public function lockAccount($email, $ipAddress, $minutes = 15)
    {
        $attempt = $this->where('email', $email)
                        ->where('ip_address', $ipAddress)
                        ->first();

        if ($attempt) {
            $this->update($attempt['id'], [
                'locked_until' => date('Y-m-d H:i:s', strtotime("+{$minutes} minutes"))
            ]);
        }
    }

    public function resetAttempts($email, $ipAddress)
    {
        $this->where('email', $email)
             ->where('ip_address', $ipAddress)
             ->delete();
    }

    public function getAttempts($email, $ipAddress)
    {
        $attempt = $this->where('email', $email)
                        ->where('ip_address', $ipAddress)
                        ->first();

        return $attempt ? $attempt['attempts'] : 0;
    }

    public function getRemainingLockTime($email, $ipAddress)
    {
        $attempt = $this->where('email', $email)
                        ->where('ip_address', $ipAddress)
                        ->first();

        if (!$attempt || !$attempt['locked_until']) {
            return 0;
        }

        $remaining = strtotime($attempt['locked_until']) - time();
        return $remaining > 0 ? ceil($remaining / 60) : 0;
    }
}
