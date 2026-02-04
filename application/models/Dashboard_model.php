<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function get_task_counts($user_id)
    {
        $data = [];

        $statuses = ['pending', 'in_progress', 'completed'];

        foreach ($statuses as $status) {
            // IMPORTANT: using assigned_to instead of user_id
            $this->db->where('assigned_to', $user_id);
            $this->db->where('status', $status);

            $data[$status] = $this->db->count_all_results('tasks');
        }

        return $data;
    }

    public function get_today_tasks($user_id)
    {
        $today = date('Y-m-d');

        $this->db->where('assigned_to', $user_id);
        $this->db->where('DATE(created_at)', $today);

        return $this->db->count_all_results('tasks');
    }

    public function get_performance_summary()
    {
        $on_time = $this->db
            ->where('performance', 'on_time')
            ->count_all_results('task_history');

        $delayed = $this->db
            ->where('performance', 'delayed')
            ->count_all_results('task_history');

        $total = $on_time + $delayed;

        $rate = $total > 0 ? round(($on_time / $total) * 100) : 0;

        return [
            'on_time' => $on_time,
            'delayed' => $delayed,
            'rate' => $rate
        ];
    }

    public function get_user_performance()
    {
        $row = $this->db->query("
        SELECT 
            SUM(CASE WHEN performance='on_time' THEN 1 ELSE 0 END) AS on_time,
            SUM(CASE WHEN performance='delayed' THEN 1 ELSE 0 END) AS delayed_count,
            COUNT(*) AS total
        FROM task_history
    ")->row();

        $total = (int)$row->total;

        $rate = $total > 0
            ? round(($row->on_time / $total) * 100)
            : 0;

        return [
            'on_time' => (int)$row->on_time,
            'delayed' => (int)$row->delayed_count,
            'rate' => $rate
        ];
    }
}
