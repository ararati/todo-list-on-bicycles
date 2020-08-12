<?php

namespace App\Models;

class Task extends Model
{
    protected const table = 'tasks';

    public function create(string $username, string $mail, string $text)
    {
        $cols = [
            'author' => $username,
            'mail' => $mail,
            'text' => $text,
        ];

        $this->insert($cols, self::table);
    }

    public function updateTask(int $id, array $values)
    {
        $currentTask = $this->findById($id);
        $changed = (int)$currentTask['changed'];

        if($changed === 0 && $currentTask['text'] !== $values['text']) {
            $values['changed'] = 1;
        }

        $this->updatedById($id, static::table, $values);
    }
}