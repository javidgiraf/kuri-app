<?php

namespace App\Exports;

use App\Models\Setting;
use App\Models\UserSubscription;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserSubscriptionExport implements FromQuery, WithHeadings, WithMapping
{
    protected $userFilter;
    protected $schemeFilter;
    protected $maturityStatusFilter;
    protected $statusFilter;
    protected $startDateFilter;
    protected $endDateFilter;

    // Pass filters to the constructor
    public function __construct($user = null, $scheme = null, $maturityStatusFilter = null, $status = null, $startDate = null, $endDate = null)
    {
        $this->userFilter = $user;
        $this->schemeFilter = $scheme;
        $this->maturityStatusFilter = $maturityStatusFilter;
        $this->statusFilter = $status;
        $this->startDateFilter = $startDate;
        $this->endDateFilter = $endDate;
    }

    /**
     * Query to fetch data for the export.
     */
    public function query()
    {
        $query = UserSubscription::query();

        if($this->userFilter) {
            $query->where('user_id', $this->userFilter);
        }

        if($this->schemeFilter) {
            $query->where('scheme_id', $this->schemeFilter);
        }

        if ($this->maturityStatusFilter) {
            $query->where('is_closed', $this->maturityStatusFilter);
        }

        if ($this->statusFilter) {
            $query->where('status', $this->statusFilter);
        }

        if ($this->startDateFilter && $this->endDateFilter) {
            $query->whereBetween('start_date', [$this->startDateFilter, $this->endDateFilter]);
        } elseif ($this->startDateFilter) {
            $query->where('start_date', '>=', $this->startDateFilter);
        } elseif ($this->endDateFilter) {
            $query->where('start_date', '<=', $this->endDateFilter);
        }
        
        return $query->with('user', 'scheme', 'deposits')->latest();
    }

    /**
     * Map the data for each row in the export.
     */
    public function map($userSubscription): array
    {
        $collectedAmount = collect($userSubscription->deposits)->reduce(function ($total, $deposit) {
            return $deposit->status ? $total + $deposit->final_amount : $total;
        }, 0);

        $status = match ($userSubscription->status) {
            UserSubscription::STATUS_ACTIVE => __('Active'),
            UserSubscription::STATUS_INACTIVE => __('Inactive'),
            UserSubscription::STATUS_DISCONTINUE => __('Discontinue'),
            UserSubscription::STATUS_ONHOLD => __('On Hold'),
        };

        return [
            $userSubscription->id,
            $userSubscription->user->name ?? 'N/A',         
            $userSubscription->scheme->title ?? 'N/A',    
            Setting::CURRENCY. ' ' .number_format($userSubscription->subscribe_amount, 2) ?? 0,       
            Setting::CURRENCY. ' ' .number_format($collectedAmount, 2),                     
            date('d-m-Y', strtotime($userSubscription->start_date)) ?? 'N/A',       
            date('d-m-Y', strtotime($userSubscription->end_date)) ?? 'N/A',         
            $userSubscription->is_closed ? 'Closed' : 'Open',
            $status                                    
        ];
    }

    /**
     * Add column headers to the export.
     */
    public function headings(): array
    {
        return [
            '#',
            'User',
            'Scheme',
            'Scheme Amount',
            'Collected Amount',
            'Start Date',
            'End Date',
            'Closing Status',
            'Status',
        ];
    }
    
}
